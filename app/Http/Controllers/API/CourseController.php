<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseDeleteRequest;
use App\Http\Requests\CourseShowRequest;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Services\CourseService;
use OpenApi\Attributes\Delete;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Put;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;


class CourseController extends Controller
{
    #[Get(
        path: '/api/course/all',
        operationId: 'getAllCourse',
        summary: 'Get all courses',
        tags: ['Course'],
        responses: [
            new Response(response: 200, description: 'Everything is fine'),
            new Response(response: 404, description: 'Page not found'),
            new Response(response: 500, description: 'Internal Server Error')
        ]
    )]
    public function index(CourseService $courseService)
    {
        return $courseService->showAllCourses();
    }

    #[Post(
        path: '/api/course/store',
        operationId: 'storeCourse',
        summary: 'Store current course',
        tags: ['Course'],
        requestBody: new RequestBody(required: true, content: new JsonContent(example: [
            'course_name' => 'test_course',
            'description' => 'test_description',
            'teacher' => 'test_teacher',
        ])),
        responses: [
            new Response(response: 200, description: 'Everything is fine',
                content: new JsonContent(example: [
                    'course_name' => 'test_course',
                    'description' => 'test_description',
                    'teacher' => 'test_teacher',
                ])
            ),
            new Response(response: 404, description: 'Page not found'),
            new Response(response: 500, description: 'Internal Server Error')
        ],
    )]
    public function store(CourseService $courseService, CourseStoreRequest $request)
    {
        return $courseService->storeCourse($request);
    }

    #[Get(
        path: '/api/course/show',
        operationId: 'getCurrentCourse',
        summary: 'Get current course',
        tags: ['Course'],
        parameters: [
            new Parameter(in: 'query', name: 'id', required: true, description: 'Course id', schema: new Schema(type: 'integer'))
        ],
        responses: [
            new Response(response: 200, description: 'Everything is fine',
                content: new JsonContent(example: [
                    'course_name' => 'test_course',
                    'description' => 'test_description',
                    'teacher' => 'test_teacher',
                ])
            ),
            new Response(response: 404, description: 'Page not found'),
            new Response(response: 500, description: 'Internal Server Error')
        ],
    )]
    public function show(CourseService $courseService, CourseShowRequest $request)
    {
        return $courseService->showCourse($request->input(['id']));
    }

    #[Put(
        path: '/api/course/update',
        operationId: 'updateCourse',
        summary: 'Update course',
        tags: ['Course'],
        requestBody: new RequestBody(required: true, content: new JsonContent(example: [
            'id' => 1,
            'course_name' => 'test_course',
            'description' => 'test_description',
            'teacher' => 'test_teacher',
        ])),
        responses: [
            new Response(response: 200, description: 'Everything is fine'),
            new Response(response: 404, description: 'Page not found'),
            new Response(response: 500, description: 'Internal Server Error')
        ],
    )]
    public function update(CourseService $courseService, CourseUpdateRequest $request)
    {
        return $courseService->updateCourse($request);
    }

    #[Delete(
        path: '/api/course/delete',
        operationId: 'deleteCourse',
        summary: 'Delete current course',
        tags: ['Course'],
        parameters: [
            new Parameter(in: 'query', name: 'id', required: true, description: 'Customer id', schema: new Schema(type: 'integer'))
        ],
        responses: [
            new Response(response: 201, description: 'Everything is fine'),
            new Response(response: 404, description: 'Page not found'),
            new Response(response: 500, description: 'Internal Server Error')
        ],
    )]
    public function delete(CourseService $courseService, CourseDeleteRequest $request)
    {
        return $courseService->deleteCourse($request->id);
    }
}
