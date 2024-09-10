<?php

use App\Services\Neo4jClient;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;

// API routes for School
Route::get('/schools', [SchoolController::class, 'index']); // List all schools
Route::post('/schools', [SchoolController::class, 'store']); // Store new school
Route::get('/schools/{school}', [SchoolController::class, 'show']); // Show single school
Route::put('/schools/{school}', [SchoolController::class, 'update']); // Update school
Route::delete('/schools/{school}', [SchoolController::class, 'destroy']); // Delete school

// API routes for Subject
Route::get('/subjects', [SubjectController::class, 'index']); // List all subjects
Route::post('/subjects', [SubjectController::class, 'store']); // Store new subject
Route::get('/subjects/{subject}', [SubjectController::class, 'show']); // Show single subject
Route::put('/subjects/{subject}', [SubjectController::class, 'update']); // Update subject
Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy']); // Delete subject

// API routes for Student
Route::get('/students', [StudentController::class, 'index']); // List all students
Route::get('/studentsubjects', [StudentController::class, 'get_student_subject']); // List all students with their  subjects
Route::post('/studentsubjects', [StudentController::class, 'create_student_subject']); // create students with  subjects
Route::post('/students', [StudentController::class, 'store']); // Store new student
Route::get('/students/{student}', [StudentController::class, 'show']); // Show single student
Route::put('/students/{student}', [StudentController::class, 'update']); // Update student
Route::delete('/students/{student}', [StudentController::class, 'destroy']); // Delete student

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');