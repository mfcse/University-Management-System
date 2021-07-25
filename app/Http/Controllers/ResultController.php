<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Grade;
use App\Models\Result;
use App\Models\Student;
use App\Models\StudentEnrollment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResultController extends Controller
{
    public function addResult()
    {
        $data = [];
        $data['students'] = Student::select('registration_id')->get();
        $data['grades'] = Grade::select('id', 'letter_grade', 'gpa')->get();


        // $courses = StudentEnrollment::with('course')->select('id', 'department_id', 'course_code', 'enrolled')->where('department_id', 1)->where('enrolled', 1)->get();
        // dd($courses);

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
        return view('result.add', $data);
    }

    public function getCourses(Request $request)
    {
        $courses = StudentEnrollment::with('course')->select('id', 'department_id', 'course_code', 'enrolled')->where('department_id', $request->deptID)->where('enrolled', 1)->get();

        return response()->json($courses);
    }


    public function submitResult(Request $request)
    {
        //dd($request->all());
        $rules = [
            'registration_id' => 'required',
            'grade_id' => 'required',
            'student_enrollment_id' => 'required',
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
            Result::create([
                'registration_id' => $request->registration_id,
                'grade_id' => $request->grade_id,
                'student_enrollment_id' => $request->student_enrollment_id,
            ]);
            $this->setSuccessMessage('Result Saved Successfully');
            return redirect()->back();
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        return redirect()->back();
    }
}