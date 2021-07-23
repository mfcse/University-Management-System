<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseAssign;
use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseAssignController extends Controller
{
    public function assignCourse()
    {
        $data = [];
        $data['departments'] = Department::select('id', 'name', 'code')->get();
        // $course = Course::select('id', 'credit', 'name', 'code')->where('id', 1)->first();
        // $teacher = Teacher::select('id', 'name', 'credit_to_be_taken')->where('id', 1)->first();
        // $credit_to_be_taken = CourseAssign::select('remaining_credit')->where('teacher_id', 1)->first() ?? $teacher['credit_to_be_taken'];
        // $teacher['credit_to_be_taken'] = $credit_to_be_taken;
        //dd($teacher);
        return view('course.assign', $data);
    }
    public function getTeachers(Request $request)
    {
        $teachers = Teacher::select('id', 'name', 'credit_to_be_taken')->where('department_id', $request->departmentId)->get();

        // dd($teachers);
        return response()->json($teachers);
    }
    public function getCourses(Request $request)
    {
        $courses = Course::select('id', 'name', 'code', 'credit')->where('department_id', $request->departmentId)->get();

        return response()->json($courses);
    }

    public function getTeacher(Request $request)
    {
        $teacher = Teacher::select('id', 'name', 'credit_to_be_taken')->where('id', $request->teacherId)->first();
        //$teacher['remaining_credit']=
        $credit_to_be_taken = CourseAssign::select('remaining_credit')->where('teacher_id', $request->teacherId)->first() ?? $teacher['credit_to_be_taken'];
        $teacher['remaining_credit'] = $credit_to_be_taken;
        // dd($teacher);
        return response()->json($teacher);
    }
    public function getCourse(Request $request)
    {
        $course = Course::select('id', 'credit', 'name', 'code')->where('code', $request->courseCode)->first();

        // dd($teacher);
        return response()->json($course);
    }

    public function submitAssign(Request $request)
    {
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:teachers,email',
            'contact_number' => 'required',
            'designation' => 'required',
            'department_id' => 'required',
            'credit_to_be_taken' => 'required',
        ];
        // $messages = [
        //     'required' => 'The :attribute field is required.',
        // ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //insert
        try {
            Teacher::create([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'contact_number' => $request->contact_number,
                'designation' => $request->designation,
                'department_id' => $request->department_id,
                'credit_to_be_taken' => $request->credit_to_be_taken,
            ]);
            $this->setSuccessMessage('Teacher Added Successfully');
            return redirect()->back();
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        return redirect()->back();
    }
}