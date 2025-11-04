<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolManagementRequest;
use App\Http\Requests\UpdateSchoolManagementRequest;
use App\Http\Resources\SchoolManagementResource;
use App\Models\SchoolManagement;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class SchoolManagementController extends Controller
{
    public function index()
    {
        return SchoolManagementResource::collection(
            SchoolManagement::orderBy('name')->get()
        );
    }

    public function store(StoreSchoolManagementRequest $request)
    {
        $row = SchoolManagement::create($request->validated());

        return (new SchoolManagementResource($row))
            ->additional(['message' => 'School management created'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SchoolManagement $schoolManagement)
    {
        return new SchoolManagementResource($schoolManagement);
    }

    public function update(UpdateSchoolManagementRequest $request, SchoolManagement $schoolManagement)
    {
        $schoolManagement->update($request->validated());

        return (new SchoolManagementResource($schoolManagement))
            ->additional(['message' => 'School management updated']);
    }

    public function destroy(SchoolManagement $schoolManagement)
    {
        try {
            $schoolManagement->delete();
            return response()->noContent();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                return response()->json([
                    'message' => 'Cannot delete: this management type is referenced by schools.'
                ], Response::HTTP_CONFLICT);
            }
            throw $e;
        }
    }
}
