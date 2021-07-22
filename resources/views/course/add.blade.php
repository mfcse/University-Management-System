@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 mt-5">
        <h1 class="text-center mb-5">Add a Course</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session()->has('message'))
            <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
                {{session()->get('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            @endif
            
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" name="code" id="code" placeholder="Enter Course Code" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Course Name" class="form-control">
            </div>
            <div class="form-group">
                <label for="credit">Credit</label>
                <input type="text" name="credit" id="credit" placeholder="Enter Course Credit" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Enter Course Description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="department_id">Department</label>
                <select name="department_id" id="department_id"  class="form-control">
                    @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="semester_id">Semester</label>
                <select name="semester_id" id="semester_id"  class="form-control">
                    @foreach ($semesters as $semester)
                    <option value="{{$semester->id}}">{{$semester->name}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success mb-5" type="submit">Save</button>
        </form>
    </div>
</div>

    
@endsection
