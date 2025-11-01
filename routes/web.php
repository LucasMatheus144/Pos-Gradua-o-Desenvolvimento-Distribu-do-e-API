<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{StudentController, CourseController};

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:api')->group(function(){
  // CRUD completo de Students
  Route::apiResource('students', StudentController::class);

  // CRUD completo de Courses + matrícula
  Route::apiResource('courses', CourseController::class);
  Route::post('courses/{course}/enroll', [CourseController::class,'enroll']);
});