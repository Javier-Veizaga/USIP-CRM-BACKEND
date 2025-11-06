<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    public function index()
    {
        $rows = Course::with('faculty')->orderBy('id','desc')->get();
        return CourseResource::collection($rows);
    }

    public function store(StoreCourseRequest $request)
    {
        // En la migración ya tenés unique(name, faculty_id)
        $row = Course::create($request->validated());
        $row->load('faculty');

        return (new CourseResource($row))
            ->additional(['message' => 'Course created'])
            ->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Course $course)
    {
        $course->load('faculty');
        return new CourseResource($course);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());
        $course->load('faculty');

        return (new CourseResource($course))
            ->additional(['message' => 'Course updated']);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->noContent();
    }

    //! Ronal para vos, esto te va a sarvir para un select
    //? Te lo dejo si te sirve.
    public function meta()
    {
        return response()->json([
            'faculties' => \App\Models\Faculty::orderBy('id')->get(['id','name','semesters']),
        ]);
    }
}
