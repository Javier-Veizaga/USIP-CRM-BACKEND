<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeProspectStatusRequest;
use App\Models\Prospect;
use App\Models\ProspectStatusHistory;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProspectStatusHistoryController extends Controller
{
    // GET /prospects/{prospect}/status-history
    public function index(Prospect $prospect)
    {
        $rows = $prospect->statusHistory()
            ->with(['status:id,status','user:id,email'])
            ->orderByDesc('id')
            ->get();

        return response()->json($rows);
    }

    // POST /prospects/{prospect}/status
    public function store(ChangeProspectStatusRequest $request, Prospect $prospect)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($prospect, $data) {
            // 1) Guardar historial
            $history = ProspectStatusHistory::create([
                'prospect_id' => $prospect->id,
                'status_id'   => $data['status_id'],
                'user_id'     => $data['user_id'], // si usas auth: auth()->id()
                'description' => $data['description'] ?? null,
            ]);

            // 2) Actualizar snapshot del prospecto
            $prospect->update(['status_id' => $data['status_id']]);

            // 3) Responder con ambos
            $prospect->load(['school','origin','executive','status']);

            return response()->json([
                'message'  => 'Status updated',
                'history'  => $history->load(['status:id,status','user:id,email']),
                'prospect' => $prospect,
            ], Response::HTTP_CREATED);
        });
    }
}
