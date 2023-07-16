<?php

namespace App\Services;

use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseService
{
    public function showAllCourses()
    {
        return CourseResource::collection(Course::all());
    }

    public function storeCourse($request)
    {
        $course = Course::query()->create($request->validated());

        return new CourseResource($course);
    }

    public function showCourse($id)
    {
        return new CourseResource(Course::query()->findOrFail($id));
    }

    public function updateCourse($request)
    {
        $course = Course::query()->findOrFail($request->id);

        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->teacher = $request->teacher;
        $course->save();

        return new CourseResource($course);
    }

    public function deleteCourse($id)
    {
        Course::destroy($id);

        return response('Course has been removed', 200);
    }
}
