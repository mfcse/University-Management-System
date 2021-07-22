<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function addDepartment()
    {
        return view('department.add');
    }
    public function submitDepartment(Request $request)
    {
        $rules = [
            'code' => 'required|unique:departments,code|min:2|max:7',
            'name' => 'required|unique:departments,name',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //insert
        try {
            Department::create([
                'code' => $request->code,
                'name' => $request->name
            ]);
            $this->setSuccessMessage('Department Added Successfully');
            return redirect()->back();
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        return redirect()->back();
    }
}