<?php

namespace App\Http\Controllers;

use App\Models\AllocateClassroom;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\CourseAssign;
use App\Models\Department;
use App\Models\Teacher;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllocateClassroomController extends Controller
{
    public function allocateClassroom()
    {
        $data = [];
        $data['departments'] = Department::select('id', 'name', 'code')->get();
        $data['classrooms'] = Classroom::select('id', 'code')->get();

        // $time = AllocateClassroom::select('start_time', 'end_time')->get();

        // dd($time);

        // $dbvalue = CourseAssign::select('remaining_credit')->where('teacher_id', 1)->first();
        // dd($dbvalue->remaining_credit);
        // $course = Course::select('id', 'credit', 'name', 'code')->where('code', 'CSE-221')->first();
        // $teacher = Teacher::select('id', 'name', 'credit_to_be_taken')->where('id', 1)->first();
        // $credit_to_be_taken = CourseAssign::select('remaining_credit')->where('teacher_id', 1)->first() ?? $teacher['credit_to_be_taken'];
        // $teacher['credit_to_be_taken'] = $credit_to_be_taken;
        //dd($course);
        return view('classroom.allocate', $data);
    }
    public function getCourses(Request $request)
    {
        $courses = CourseAssign::with('course')->select('id', 'assigned', 'course_code', 'department_id')->where('department_id', $request->departmentId)->where('assigned', 1)->get();


        return response()->json($courses);
    }


    public function submitAllocation(Request $request)
    {
        //dd($request->all());
        $rules = [
            'department_id' => 'required',
            'course_code' => 'required',
            'room_code' => 'required',
            'day' => 'required',
            'start_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i|after:start_time',

        ];
        // $messages = [
        //     'course_code.unique' => 'Course has already been asigned',
        // ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        ##manage and prevent overlapping time

        // $time = AllocateClassroom::select('start_time', 'end_time')->get();
        // var_dump($time);
        // die;


        $startTime = Carbon::parse(str_replace(array('am', 'pm'), ':00', $request->input('start_time')));


        // $test = AllocateClassroom::select('start_time')->first();
        // echo date('h:i a', strtotime($test->start_time));
        // dd($test);
        // die;

        //dd($startTime);
        $endTime = Carbon::parse(str_replace(array('am', 'pm'), ':00', $request->input('end_time')));
        $day = $request->input('day');

        $timeExists = AllocateClassroom::where('day', $day)
            ->where('start_time', $startTime)
            ->where('end_time', $endTime)
            ->exists(); //use allocate_rooms table model (I don't know if it is ClassRomm)

        # **prevent partial overlapping


        if ($timeExists) {
            return redirect()->back()->withErrors(['time' => 'Class Room Already Allocated']);
        }

        //insert
        try {
            //some logics to be implemented
            AllocateClassroom::create([
                'department_id' => $request->department_id,
                'course_code' => $request->course_code,
                'room_code' => $request->room_code,
                'day' => $request->day,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            // AllocateClassroom::create([
            //     'department_id' => $request->department_id,
            //     'course_code' => $request->course_code,
            //     'room_code' => $request->room_code,
            //     'day' => $request->day,
            //     'start_time' => $request->start_time,
            //     'end_time' => $request->end_time,
            // ]);
            $this->setSuccessMessage('Classroom Allocated Successfully');
            return redirect()->back();
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        return redirect()->back();
    }
    public function viewAllocations()
    {
        $data = [];
        $data['departments'] = Department::select('id', 'name', 'code')->get();

        // $allocations = AllocateClassroom::with('course')->select('id', 'day', 'start_time', 'end_time', 'course_code', 'room_code', 'department_id')->where('department_id', 1)->get();
        // dd($allocations);

        // $allocations = AllocateClassroom::with('course')->select('id', 'day', 'start_time', 'end_time', 'course_code', 'room_code', 'department_id')->where('department_id', 1)->get();
        // dd($allocations);

        return view('classroom.allocateView', $data);
    }
    public function viewAllocationStats(Request $request)
    {
        $allocations = AllocateClassroom::with('course')->select('id', 'day', 'start_time', 'end_time', 'course_code', 'room_code', 'department_id')->where('department_id', $request->departmentId)->orderBy('course_code', 'asc')->get();
        ///to do //combine same in a row

        # display time in 12 hour format
        foreach ($allocations as $key => $value) {
            $value->start_time = date('h:i a', strtotime($value->start_time));
            $value->end_time = date('h:i a', strtotime($value->end_time));
        }

        //set message
        // foreach ($courses as $key => $value) {
        //     if ($value->course_assigned->teacher_id === null) {
        //         $value->course_assigned->teacher->name = 'Not Assigned Yet';
        //     }
        // }
        return response()->json($allocations);
    }
    public function unallocateClassrooms()
    {
        $course = AllocateClassroom::where('allocated', 1)->update([
            'allocated' => 0
        ]);

        $this->setSuccessMessage('All Classrooms Unallocated Successfully');
        return view('classroom.unallocate');
    }
}