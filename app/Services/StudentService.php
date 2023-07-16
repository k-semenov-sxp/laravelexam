<?php

namespace App\Services;

use App\Http\Resources\StudentResource;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentService
{
    public function showAllStudents()
    {
        return StudentResource::collection(Student::all());
    }

    public function storeStudent($request)
    {
        $student = Student::query()->create($request->validated());

        return new StudentResource($student);
    }

    public function showStudent($id)
    {
        return new StudentResource(Student::query()->findOrFail($id));
    }

    public function updateStudent($request)
    {
        $student = Student::query()->findOrFail($request->id);

        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->gender = $request->gender;
        $student->date_of_birth = $request->date_of_birth;
        $student->save();

        return new StudentResource($student);
    }

    public function deleteStudent($id)
    {
        Student::destroy($id);

        return response('Student has been removed', 200);
    }

    public function assignStudentToCourse($request)
    {
        $student = Student::query()->findOrFail($request->studentId);
        $course = Course::query()->findOrFail($request->courseId);

        $student->courses()->attach($course);
    }

    public function unsignStudent($id)
    {
        DB::table('course_student')->delete($id);
    }
}
