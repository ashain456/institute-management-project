<?php

use App\Http\Controllers\InstituteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| http://127.0.0.1:8000/api/v1/<route>
*/
Route::prefix('v1/')->group(function () {
    Route::post('student', [InstituteController::class, 'createStudent']);
    Route::post('course', [InstituteController::class, 'createCourse']);
    Route::post('course/enrollment', [InstituteController::class, 'createCourseEnrollment']);
    Route::get('students', [InstituteController::class, 'getStudents']);
    Route::get('courses', [InstituteController::class, 'getcourses']);
    Route::get('student/{id}/course', [InstituteController::class, 'getstudentCoursesById']);
});
