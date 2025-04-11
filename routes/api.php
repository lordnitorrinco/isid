<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\InstructorLoginController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Auth\InstructorRegisterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\InstructorController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\InstructorMiddleware;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */


Route::post('login', [UserLoginController::class, 'login']);
Route::post('register', [UserRegisterController::class, 'register']);

Route::post('instructor/login', [InstructorLoginController::class, 'login']);
Route::post('instructor/register', [InstructorRegisterController::class, 'register']);



Route::get('/instructor/profile', function () {
    return response()->json(Auth::guard('instructor')->user());
})->middleware(InstructorMiddleware::class);

Route::get('/profile', function () {
    return response()->json(Auth::guard('user')->user());
})->middleware(UserMiddleware::class);


// Listar todos los cursos
Route::get('/courses', [CourseController::class, 'index']);

// Mostrar un curso específico
Route::get('/courses/{course}', [CourseController::class, 'show']);

// Crear un nuevo curso
Route::post('/courses', [CourseController::class, 'store'])->middleware(InstructorMiddleware::class);

// Actualizar un curso existente
Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware(InstructorMiddleware::class);

// Eliminar un curso
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->middleware(InstructorMiddleware::class);

// Listar todos los cursos de un instructor
Route::get('/instructor/courses', [CourseController::class, 'indexInstructor'])->middleware(InstructorMiddleware::class);

// Listar todas las lecciones de un curso específico
Route::get('/courses/{course}/lessons', [LessonController::class, 'index']);

// Mostrar una lección específica
Route::get('/lessons/{lesson}', [LessonController::class, 'show']);

// Crear una nueva lección para un curso específico
Route::post('/courses/{course}/lessons', [LessonController::class, 'store'])->middleware(InstructorMiddleware::class);

// Actualizar una lección existente
Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->middleware(InstructorMiddleware::class);

// Eliminar una lección
Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->middleware(InstructorMiddleware::class);

// List comments for a specific course
Route::get('/courses/{course}/comments', [CommentController::class, 'index']);

// Add a comment to a course
Route::post('/courses/{course}/comments', [CommentController::class, 'store'])->middleware(UserMiddleware::class);

// Update a comment
Route::put('/comments/{comment}', [CommentController::class, 'update'])->middleware([UserMiddleware::class]);

// Delete a comment
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware([UserMiddleware::class]);

// List average rating for all courses
Route::get('/courses/ratings/average', [RatingController::class, 'averageRatings']);

// List all ratings for a specific course
Route::get('/courses/{course}/ratings', [RatingController::class, 'index']);

// Create a rating for a course
Route::post('/courses/{course}/ratings', [RatingController::class, 'store'])->middleware(UserMiddleware::class);

// Update a rating
Route::put('/ratings/{rating}', [RatingController::class, 'update'])->middleware([UserMiddleware::class]);

// Delete a rating
Route::delete('/ratings/{rating}', [RatingController::class, 'destroy'])->middleware([UserMiddleware::class]);

// List all instructors
Route::get('/instructors', [InstructorController::class, 'index']);
