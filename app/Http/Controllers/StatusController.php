<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller
{
    public function index()
    {
        $rows = Status::orderBy('status')->get();
        return StatusResource::collection($rows);
    }

    public function store(StoreStatusRequest $request)
    {
        $row = Status::create($request->validated());

        return (new StatusResource($row))
            ->additional(['message' => 'Status created'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Status $status)
    {
        return new StatusResource($status);
    }

    public function update(UpdateStatusRequest $request, Status $status)
    {
        $status->update($request->validated());

        return (new StatusResource($status))
            ->additional(['message' => 'Status updated']);
    }

    public function destroy(Status $status)
    {
        try {
            $status->delete();
            return response()->noContent();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                return response()->json([
                    'message' => 'Cannot delete: this status is referenced by prospects or history.'
                ], Response::HTTP_CONFLICT);
            }
            throw $e;
        }
    }
}
