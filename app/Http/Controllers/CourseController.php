<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Semester;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function addCourse()
    {
        $data = [];
        $data['departments'] = Department::select('id', 'name', 'code')->get();
        $data['semesters'] = Semester::select('id', 'name')->get();

        return view('course.add', $data);
    }
    public function submitCourse(Request $request)
    {
        $rules = [
            'code' => 'required|unique:courses,code|min:5',
            'name' => 'required|unique:courses,name',
            'credit' => 'required|min:0.5|max:5.0|numeric',
            'description' => 'required',
            'department_id' => 'required',
            'semester_id' => 'required',
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
            Course::create([
                'code' => $request->code,
                'name' => $request->name,
                'credit' => $request->credit,
                'description' => $request->description,
                'department_id' => $request->department_id,
                'semester_id' => $request->semester_id,
            ]);
            $this->setSuccessMessage('Course Added Successfully');
            return redirect()->back();
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        return redirect()->back();
    }
    //view all courses
    public function viewCourseStats()
    {
        $data = [];
        $data['departments'] = Department::select('id', 'name', 'code')->get();

        // $courses = Course::with('course_assigned.teacher', 'semester')->select('id', 'name', 'code', 'credit', 'semester_id')->where('department_id', 1)->whereHas('course_assigned', function ($q) {
        //     $q->where('assigned', 1);
        // })->get();
        //dd($courses);
        return view('course.stats', $data);
    }
    public function getCourseInfo(Request $request)
    {
        $courses = Course::with('course_assigned.teacher', 'semester')->select('id', 'name', 'code', 'credit', 'semester_id')->where('department_id', $request->departmentId)->get();

        //set message
        // foreach ($courses as $key => $value) {
        //     if ($value->course_assigned->teacher_id === null) {
        //         $value->course_assigned->teacher->name = 'Not Assigned Yet';
        //     }
        // }
        return response()->json($courses);
    }
}