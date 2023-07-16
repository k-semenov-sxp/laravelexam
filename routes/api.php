<?php

use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('student.')->group( function () {
    Route::get('/student/all', [StudentController::class, 'index'])->name('index');
    Route::post('/student/store', [StudentController::class, 'store'])->name('store');
    Route::get('/student/show', [StudentController::class, 'show'])->name('show');
    Route::put('/student/update', [StudentController::class, 'update'])->name('update');
    Route::delete('/student/delete', [StudentController::class, 'delete'])->name('delete');
    Route::post('/student/assign', [StudentController::class, 'assignStudent'])->name('assign');
    Route::delete('/student/unsign', [StudentController::class, 'unsignStudent'])->name('unsign');
});

Route::name('course.')->group( function () {
    Route::get('/course/all', [CourseController::class, 'index'])->name('index');
    Route::post('/course/store', [CourseController::class, 'store'])->name('store');
    Route::get('/course/show', [CourseController::class, 'show'])->name('show');
    Route::put('/course/update', [CourseController::class, 'update'])->name('update');
    Route::delete('/course/delete', [CourseController::class, 'delete'])->name('delete');
});
