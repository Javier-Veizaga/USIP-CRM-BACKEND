<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacultyRequest;
use App\Http\Requests\UpdateFacultyRequest;
use App\Http\Resources\FacultyResource;
use App\Models\Faculty;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class FacultyController extends Controller
{
    public function index()
    {
        return FacultyResource::collection(
            Faculty::orderBy('name')->get()
        );
    }

    public function store(StoreFacultyRequest $request)
    {
        $row = Faculty::create($request->validated());

        return (new FacultyResource($row))
            ->additional(['message' => 'Faculty created'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Faculty $faculty)
    {
        return new FacultyResource($faculty);
    }

    public function update(UpdateFacultyRequest $request, Faculty $faculty)
    {
        $faculty->update($request->validated());

        return (new FacultyResource($faculty))
            ->additional(['message' => 'Faculty updated']);
    }

    public function destroy(Faculty $faculty)
    {
        try {
            $faculty->delete();
            return response()->noContent();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                return response()->json([
                    'message' => 'Cannot delete: this faculty is referenced by careers.'
                ], Response::HTTP_CONFLICT);
            }
            throw $e;
        }
    }
}
