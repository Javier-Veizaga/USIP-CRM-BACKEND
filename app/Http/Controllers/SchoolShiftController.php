<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolShiftRequest;
use App\Http\Requests\UpdateSchoolShiftRequest;
use App\Http\Resources\SchoolShiftResource;
use App\Models\SchoolShift;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class SchoolShiftController extends Controller
{
    public function index()
    {
        return SchoolShiftResource::collection(SchoolShift::orderBy('name')->get());
    }

    public function store(StoreSchoolShiftRequest $request)
    {
        $row = SchoolShift::create($request->validated());

        return (new SchoolShiftResource($row))
            ->additional(['message' => 'School shift created'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SchoolShift $schoolShift)
    {
        return new SchoolShiftResource($schoolShift);
    }

    public function update(UpdateSchoolShiftRequest $request, SchoolShift $schoolShift)
    {
        $schoolShift->update($request->validated());

        return (new SchoolShiftResource($schoolShift))
            ->additional(['message' => 'School shift updated']);
    }

    public function destroy(SchoolShift $schoolShift)
    {
        try {
            $schoolShift->delete();
            return response()->noContent();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                return response()->json([
                    'message' => 'No se puede eliminar: este turno es utilizado por las escuelas.'
                ], Response::HTTP_CONFLICT);
            }
            throw $e;
        }
    }
}
