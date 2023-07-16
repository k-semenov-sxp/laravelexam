<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignStudentRequest;
use App\Http\Requests\StudentDeleteRequest;
use App\Http\Requests\StudentShowRequest;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Requests\UnsignStudentRequest;
use App\Services\StudentService;
use Illuminate\Http\Request;
use OpenApi\Attributes\Delete;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Put;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Schema;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes\Response;


//use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="My First API", version="1.0")
 */
class StudentController extends Controller
{

    #[Get(
        path: '/api/student/all',
        operationId: 'getAllStudents',
        summary: 'Get all student',
        tags: ['Student'],
        responses: [
            new Response(response: 200, description: 'Everything is fine'),
            new Response(response: 404, description: 'Page not found'),
        ]
    )]
    public function index(StudentService $studentService)
    {
        return $studentService->showAllStudents();
    }

    #[Post(
        path: '/api/student/store',
        operationId: 'storeStudent',
        summary: 'Store current student',
        tags: ['Student'],
        requestBody: new RequestBody(required: true, content: new JsonContent(example: [
            'first_name' => 'test_name',
            'last_name' => 'test_last',
            'gender' => 'M',
            'date_of_birth' => '2002-05-06',
        ])),
        responses: [
            new Response(response: 200, description: 'Everything is fine'),
            new Response(response: 404, description: 'Page not found'),
            new Response(response: 500, description: 'Server error')
        ],
    )]
    public function store(StudentService $studentService, StudentStoreRequest $request)
    {
        return $studentService->storeStudent($request);
    }

    #[Get(
        path: '/api/student/show',
        operationId: 'getCurrentStudent',
        summary: 'Get current student',
        tags: ['Student'],
        responses: [
            new Response(response: 200, description: 'Everything is fine'),
            new Response(response: 404, description: 'Page not found'),
            new Response(response: 500, description: 'Server error')
        ],
        parameters: [
            new Parameter(in: 'query', name: 'id', required: true, description: 'Customer id', schema: new Schema(type: 'integer'))
        ]
    )]
    public function show(StudentService $studentService, StudentShowRequest $request)
    {
        return $studentService->showStudent($request->input(['id']));
    }

    #[Put(
        path: '/api/student/update',
        operationId: 'updateStudent',
        summary: 'Update student',
        tags: ['Student'],
        requestBody: new RequestBody(required: true, content: new JsonContent(example: [
            'id' => 1,
            'first_name' => 'name_test',
            'last_name' => 'last_test',
            'gender' => 'M',
            'date_of_birth' => '2003-05-06',
        ])),
        responses: [
            new Response(response: 200, description: 'Everything is fine'),
            new Response(response: 404, description: 'Page not found'),
            new Response(response: 500, description: 'Server error')
        ],
    )]
    public function update(StudentService $studentService, StudentUpdateRequest $request)
    {
        return $studentService->updateStudent($request);
    }

    #[Delete(
        path: '/api/student/delete',
        operationId: 'deleteStudent',
        summary: 'Delete current student',
        tags: ['Student'],
        responses: [
            new Response(response: 200, description: 'Everything is fine'),
            new Response(response: 404, description: 'Page not found'),
            new Response(response: 500, description: 'Server error')
        ],
        parameters: [
            new Parameter(in: 'query', name: 'id', required: true, description: 'Customer id', schema: new Schema(type: 'integer'))
        ]
    )]
    public function delete(StudentService $studentService, StudentDeleteRequest $request)
    {
        return $studentService->deleteStudent($request->id);
    }

    #[Post(
        path: '/api/student/assign',
        operationId: 'assignStudent',
        summary: 'Assign student',
        tags: ['Student'],
        requestBody: new RequestBody(required: true, content: new JsonContent(example: [
            'studentId' => 6,
            'courseId' => 6,
        ])),
        responses: [
            new Response(response: 200, description: 'Everything is fine'),
            new Response(response: 404, description: 'Page not found'),
            new Response(response: 500, description: 'Server error')
        ],
    )]
    public function assignStudent(StudentService $studentService, AssignStudentRequest $request)
    {
        $studentService->assignStudentToCourse($request);
    }

    #[Delete(
        path: '/api/student/unsign',
        operationId: 'unsignStudent',
        summary: 'Unsign current student',
        tags: ['Student'],
        parameters: [
            new Parameter(in: 'query', name: 'id', required: true, description: 'Customer id', schema: new Schema(type: 'integer'))
        ],
        responses: [
            new Response(response: 200, description: 'Everything is fine'),
            new Response(response: 404, description: 'Page not found'),
            new Response(response: 500, description: 'Server error')
        ]
    )]
    public function unsignStudent(StudentService $studentService, UnsignStudentRequest $request)
    {
        $studentService->unsignStudent($request->id);
    }
}
