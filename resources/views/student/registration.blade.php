@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 mt-5">
        <h1 class="text-center mb-5">Register a Student</h1>
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
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Student Name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter Student Email" class="form-control">
            </div>
            <div class="form-group">
                <label for="contact_number">Contact No.</label>
                <input type="text" name="contact_number" id="contact_number" placeholder="Enter Student Contact Number" class="form-control">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" placeholder="Enter Student Address" class="form-control"></textarea>
            </div>
            
            <div class="form-group">
                <label for="department_id">Department</label>
                <select name="department_id" id="department_id"  class="form-control">
                    @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                    <input type="hidden" name="code" value="{{$department->code}}">
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success mb-5" type="submit">Register</button>
        </form>
    </div>
</div>

    
@endsection
