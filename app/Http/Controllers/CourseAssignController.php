<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseAssignController extends Controller
{
    public function assignCourse()
    {
        $data = [];
        $data['departments'] = Department::select('id', 'name', 'code')->get();
        // $teachers = Teacher::select('id', 'name', 'credit_to_be_taken')->where('department_id', 1)->get();
        // dd($teachers);
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