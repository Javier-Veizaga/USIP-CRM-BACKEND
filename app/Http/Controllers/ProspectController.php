<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProspectRequest;
use App\Http\Requests\UpdateProspectRequest;
use App\Http\Resources\ProspectResource;
use App\Models\Prospect;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class ProspectController extends Controller
{
    // GET /prospects
    public function index(Request $request)
    {
        $q = Prospect::query()
            ->with(['school','origin','executive','status'])
            ->orderByDesc('id');

        // filtros ligeros opcionales
        if ($search = $request->input('search')) {
            $like = '%'.$search.'%';
            $q->where(function($qq) use ($like){
                $qq->where('first_name','like',$like)
                   ->orWhere('last_name','like',$like)
                   ->orWhere('maternal_last_name','like',$like)
                   ->orWhere('phone','like',$like)
                   ->orWhere('address','like',$like);
            });
        }
        if ($statusId = $request->input('status_id')) {
            $q->where('status_id', (int)$statusId);
        }
        if ($userId = $request->input('user_id')) {
            $q->where('user_id', (int)$userId);
        }

        $rows = $q->get();
        return ProspectResource::collection($rows);
    }

    // POST /prospects
    public function store(StoreProspectRequest $request)
    {
        try {
            $row = Prospect::create($request->validated());
            $row->load(['school','origin','executive','status']);

            return (new ProspectResource($row))
                ->additional(['message' => 'Prospect created'])
                ->response()->setStatusCode(Response::HTTP_CREATED);

        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                return response()->json(['message' => 'Invalid foreign key.'], 422);
            }
            if ($e->getCode() === '23505') {
                return response()->json(['message' => 'Duplicate phone.'], 409);
            }
            throw $e;
        }
    }

    // GET /prospects/{prospect}
    public function show(Prospect $prospect)
    {
        $prospect->load(['school','origin','executive','status']);
        return new ProspectResource($prospect);
    }

    // PUT/PATCH /prospects/{prospect}
    public function update(UpdateProspectRequest $request, Prospect $prospect)
    {
        $prospect->update($request->validated());
        $prospect->load(['school','origin','executive','status']);

        return (new ProspectResource($prospect))
            ->additional(['message' => 'Prospect updated']);
    }

    // DELETE /prospects/{prospect}
    public function destroy(Prospect $prospect)
    {
        $prospect->delete();
        return response()->noContent();
    }

    //! USALO PARA  selects del formulario,  RONAL
    public function meta()
    {
        return response()->json([
            'schools'   => \App\Models\School::orderBy('name')->get(['id','name']),
            'origins'   => \App\Models\DataSource::orderBy('name')->get(['id','name']),
            'users'     => \App\Models\User::orderBy('id','desc')->get(['id','email']),
            'statuses'  => \App\Models\Status::orderBy('status')->get(['id','status']),
        ]);
    }
}
