<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseAssign;
use App\Models\Department;
use App\Models\Student;
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
        //$data = [];
        $student = Student::with('department')->select('id', 'name', 'email', 'department_id')->where('registration_id', $request->registrationId)->first();

        //$data['courses'] = Course::select('id', 'name', 'code')->where('department_id', $data['student']['department_id'])->get();

        //dd($student);
        return response()->json($student);
    }
    // public function getCourse(Request $request)
    // {
    //     $course = Course::select('id', 'credit', 'name', 'code')->where('code', $request->courseCode)->first();

    //     // dd($teacher);
    //     return response()->json($course);
    // }

    public function submitEnrollment(Request $request)
    {
        //dd($request->all());
        $rules = [
            'department_id' => 'required',
            'teacher_id' => 'required',
            'remaining_credit' => 'required|numeric',
            'course_code' => 'required|unique:course_assigns,course_code',
        ];
        $messages = [
            'course_code.unique' => 'Course has already been asigned',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //check if course credit exceeds

        if ($request->credit_to_be_taken - $request->remaining_credit < 0 || $request->credit_to_be_taken - $request->remaining_credit < $request->credit) {
            $this->setErrorMessage('Teacher Credit Quota exceeds');
            return redirect()->back();

            // echo '<script>
            // var answer = window.confirm("Are you Sure to assign more credits than limit?");
            //     if (answer) {
            //         console.log("ok");
            //     }
            //     else {

            //     }
            // </script>';
            // <script>alert('do you want to continue?')</script>
        }


        //insert

        try {
            //some logics to be implemented
            CourseAssign::create([
                'department_id' => $request->department_id,
                'teacher_id' => $request->teacher_id,
                'remaining_credit' => $request->remaining_credit - $request->course_credit,
                //'course_id' => $request->course_id,
                'course_code' => $request->course_code,
            ]);
            $this->setSuccessMessage('Course Assigned Successfully');
            return redirect()->back();
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        return redirect()->back();
    }
}