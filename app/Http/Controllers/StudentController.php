<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function registerStudent()
    {
        $data = [];
        $data['departments'] = Department::select('id', 'name', 'code')->get();

        return view('student.registration', $data);
    }
    public function submitStudent(Request $request)
    {
        //dd($request->all());
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:students,email',
            'contact_number' => 'required',
            'department_id' => 'required',
        ];
        // $messages = [
        //     'required' => 'The :attribute field is required.',
        // ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        ////generate registration id
        //get year
        $year = (string) Carbon::now()->year;
        //get dept code
        $code = Department::select('code')->where('id', $request->department_id)->first()->code;

        //dd($code);
        //last part
        $registration = Student::select('registration_id')->latest()->first();
        //dd($registration);
        $lastThreeDigit  = ($registration) ? substr($registration, -3) : '000'; // the number to format

        $unique = str_pad(intval($lastThreeDigit) + 1, strlen($lastThreeDigit), '0', STR_PAD_LEFT); // 000010

        // echo ($year);
        // echo ($code);
        // echo ($unique);
        // die;

        $registration_id = $year . '-' . $code . '-' . $unique;

        //dd($registration_id);

        //insert
        try {
            Student::create([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'contact_number' => $request->contact_number,
                'department_id' => $request->department_id,
                'registration_id' => $registration_id,
            ]);
            $this->setSuccessMessage('Student Registered Successfully with registration Number ' . $registration_id);
            return redirect()->back();
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        return redirect()->back();
    }
}