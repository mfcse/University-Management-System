<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseAssign;
use App\Models\Department;
use App\Models\Student;
use App\Models\StudentEnrollment;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentEnrollmentController extends Controller
{
    public function enrollStudent()
    {
        $data = [];
        $data['students'] = Student::select('registration_id')->get();

        // $data['student'] = Student::select('id', 'name', 'email', 'department_id')->where('registration_id', '2021-CSE-001')->first();

        // $data['courses'] = Course::select('id', 'name', 'code', 'credit')->where('department_id', $data['student']['department_id'])->get();

        // dd($data);

        // $student = Student::select('id', 'name', 'email', 'department_id')->where('registration_id', '2021-CSE-001')->first();


        // dd($student['department_id']);

        // $data['students'] = Student::with('department')->select('id', 'name', 'email', 'department_id')->whereHas('courses', function ($q) {
        //     $q->where('department_id', 1);
        // })->get();
        //dd($data['students']);
        // $student = Student::with('department')->select('id', 'name', 'email', 'department_id')->where('registration_id', '2021-CSE-001')->first();

        // dd($student);
        return view('student.enrollment', $data);
    }

    public function getCourses(Request $request)
    {
        $courses = Course::select('id', 'name', 'code')->where('department_id', $request->deptID)->get();

        return response()->json($courses);
    }

    public function getStudent(Request $request)
    {

        $student = Student::with('department')->select('id', 'name', 'email', 'department_id')->where('registration_id', $request->registrationId)->first();

        return response()->json($student);
    }

    public function submitEnrollment(Request $request)
    {
        //dd($request->all());
        $rules = [
            'registration_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'department_id' => 'required',
            'course_code' => 'required',
        ];

        // $messages = [
        //     'course_code.unique' => 'Course has already been asigned',
        // ];
        //dd($request->all());
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //insert

        try {
            StudentEnrollment::create([
                'registration_id' => $request->registration_id,
                'name' => $request->name,
                'email' => $request->email,
                'department_id' => $request->department_id,
                'course_code' => $request->course_code,
            ]);
            $this->setSuccessMessage('Student Enrolled in the Course Successfully');
            return redirect()->back();
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        return redirect()->back();
    }
}