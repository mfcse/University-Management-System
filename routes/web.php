<?php

use App\Http\Controllers\CourseAssignController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/add-department', [DepartmentController::class, 'addDepartment'])->name('department.add');
Route::post('/add-department', [DepartmentController::class, 'submitDepartment']);
Route::get('/show-departments', [DepartmentController::class, 'showAllDepartments'])->name('department.show');

Route::get('/add-course', [CourseController::class, 'addCourse'])->name('course.add');
Route::post('/add-course', [CourseController::class, 'submitCourse']);

Route::get('/add-teacher', [TeacherController::class, 'addTeacher'])->name('teacher.add');
Route::post('/add-teacher', [TeacherController::class, 'submitTeacher']);

Route::get('/assign-course', [CourseAssignController::class, 'assignCourse'])->name('course.assign');
Route::post('/assign-course', [CourseAssignController::class, 'submitAssign']);
Route::get('/view-course-stats', [CourseController::class, 'viewCourseStats'])->name('course.stats');

//ajax requests
Route::get('get-teachers', [CourseAssignController::class, 'getTeachers']);
Route::get('get-courses', [CourseAssignController::class, 'getCourses']);
Route::get('get-teacher-data', [CourseAssignController::class, 'getTeacher']);
Route::get('get-course-data', [CourseAssignController::class, 'getCourse']);
Route::get('get-course-stats', [CourseController::class, 'getCourseInfo']);
//