<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Http\Resources\SchoolResource;
use App\Models\School;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class SchoolController extends Controller
{
    public function index()
    {
        $rows = School::with(['management','shift','agreementType','agreementStatus'])
                      ->orderBy('id','desc')
                      ->get();

        return SchoolResource::collection($rows);
    }

    public function store(StoreSchoolRequest $request)
    {
        $row = School::create($request->validated());
        $row->load(['management','shift','agreementType','agreementStatus']);

        return (new SchoolResource($row))
            ->additional(['message' => 'School created'])
            ->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(School $school)
    {
        $school->load(['management','shift','agreementType','agreementStatus']);
        return new SchoolResource($school);
    }

    public function update(UpdateSchoolRequest $request, School $school)
    {
        $school->update($request->validated());
        $school->load(['management','shift','agreementType','agreementStatus']);

        return (new SchoolResource($school))
            ->additional(['message' => 'School updated']);
    }

    public function destroy(School $school)
    {
        try {
            $school->delete();
            return response()->noContent();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                return response()->json([
                    'message' => 'Cannot delete: this school is referenced by other records.'
                ], Response::HTTP_CONFLICT);
            }
            throw $e;
        }
    }
}
