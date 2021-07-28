<?php

use App\Http\Controllers\CourseAssignController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentEnrollmentController;
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

//add department
Route::get('/add-department', [DepartmentController::class, 'addDepartment'])->name('department.add');
Route::post('/add-department', [DepartmentController::class, 'submitDepartment']);

//show department
Route::get('/show-departments', [DepartmentController::class, 'showAllDepartments'])->name('department.show');

//add course
Route::get('/add-course', [CourseController::class, 'addCourse'])->name('course.add');
Route::post('/add-course', [CourseController::class, 'submitCourse']);


//add teacher
Route::get('/add-teacher', [TeacherController::class, 'addTeacher'])->name('teacher.add');
Route::post('/add-teacher', [TeacherController::class, 'submitTeacher']);

//assign course 
Route::get('/assign-course', [CourseAssignController::class, 'assignCourse'])->name('course.assign');
Route::post('/assign-course', [CourseAssignController::class, 'submitAssign']);
Route::get('/view-course-stats', [CourseController::class, 'viewCourseStats'])->name('course.stats');

//student
Route::get('/register-student', [StudentController::class, 'registerStudent'])->name('student.register');
Route::post('/register-student', [StudentController::class, 'submitStudent']);

//Enroll in a Course
Route::get('/enroll-student', [StudentEnrollmentController::class, 'enrollStudent'])->name('student.enroll');
Route::post('/enroll-student', [StudentEnrollmentController::class, 'submitEnrollment']);

//result
Route::get('/add-result', [ResultController::class, 'addResult'])->name('result.add');
Route::post('/add-result', [ResultController::class, 'submitResult']);
Route::get('/show-result', [ResultController::class, 'showResult'])->name('result.show');

//ajax requests
Route::get('get-teachers', [CourseAssignController::class, 'getTeachers']);
Route::get('get-courses', [CourseAssignController::class, 'getCourses']);
Route::get('get-teacher-data', [CourseAssignController::class, 'getTeacher']);
Route::get('get-course-data', [CourseAssignController::class, 'getCourse']);
Route::get('get-course-stats', [CourseController::class, 'getCourseInfo']);
Route::get('get-student-data', [StudentEnrollmentController::class, 'getStudent']);
Route::get('get-courses-data', [StudentEnrollmentController::class, 'getCourses']);
Route::get('get-enrolled-courses-data', [ResultController::class, 'getCourses']);
//