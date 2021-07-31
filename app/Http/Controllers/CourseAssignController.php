<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseAssign;
use App\Models\Department;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseAssignController extends Controller
{
    public function assignCourse()
    {
        $data = [];
        $data['departments'] = Department::select('id', 'name', 'code')->get();



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
        ##there is a bug in getting remaining credit

        $teacher = Teacher::select('id', 'name', 'credit_to_be_taken')->where('id', $request->teacherId)->first();
        //$teacher['remaining_credit']=
        $dbvalue = CourseAssign::select('remaining_credit')->where('teacher_id', $request->teacherId)->orderBy('remaining_credit', 'ASC')->get();

        //get the smallest one
        $credit_to_be_taken = $dbvalue[0]->remaining_credit ?? $teacher['credit_to_be_taken'];
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
        //dd($request->all());
        $rules = [
            'department_id' => 'required',
            'teacher_id' => 'required',
            'remaining_credit' => 'required|numeric',
            'course_code' => 'required',
        ];
        // $messages = [
        //     'course_code.unique' => 'Course has already been asigned',
        // ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //check if assign==0 & already exhists
        $course_code = $request->course_code;
        $old_course = CourseAssign::select('assigned', 'course_code')->where('course_code', $course_code)->first();
        //dd($old_course);

        //check if course credit exceeds

        if ($request->credit_to_be_taken - $request->remaining_credit < 0 || $request->credit_to_be_taken - $request->remaining_credit < $request->credit) {
            $this->setErrorMessage('Teacher Credit Quota exceeds');
            return redirect()->back();
        }

        //insert

        try {
            //some logics to be implemented
            //update old course
            if ($old_course) {
                if ($old_course->assigned === 1) {
                    $this->setErrorMessage('Course has already been assigned');
                    return redirect()->back();
                } else {
                    $course = CourseAssign::with('teacher')->where('assigned', 0)->where('course_code', $request->course_code)->first();
                    //dd($course);

                    $course->update([
                        'department_id' => $request->department_id,
                        'teacher_id' => $request->teacher_id,
                        'remaining_credit' => $course->teacher->credit_to_be_taken,
                        //'course_id' => $request->course_id,
                        'course_code' => $request->course_code,
                        'assigned' => 1
                    ]);
                    $this->setSuccessMessage('Course Assigned Successfully');
                    return redirect()->back();
                }
            } else {
                //new course
                CourseAssign::create([
                    'department_id' => $request->department_id,
                    'teacher_id' => $request->teacher_id,
                    'remaining_credit' => $request->remaining_credit - $request->course_credit,
                    //'course_id' => $request->course_id,
                    'course_code' => $request->course_code,
                ]);

                $this->setSuccessMessage('Course Assigned Successfully');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        return redirect()->back();
    }
    public function unassignCourses()
    {

        //dd(CourseAssign::where('assigned', 1)->get());
        $course = CourseAssign::where('assigned', 1)->update([
            'assigned' => 0,
            // 'remaining_credit'=>
        ]);
        //query
        $teachers = Teacher::select('id', 'credit_to_be_taken')->get();

        foreach ($teachers as $key => $teacher) {
            CourseAssign::where('teacher_id', $teacher->id)->update([
                'remaining_credit' => $teacher->credit_to_be_taken
            ]);
        }

        $this->setSuccessMessage('All Courses Unassigned Successfully');
        return view('course.unassign');

        //return 'All Courses Unassigned Successfully';
    }
}