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
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Teacher Name" class="form-control">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" placeholder="Enter Teacher Address" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter Teacher Email" class="form-control">
            </div>
            <div class="form-group">
                <label for="contact_number">Contact No.</label>
                <input type="text" name="contact_number" id="contact_number" placeholder="Enter Teacher Contact Number" class="form-control">
            </div>
            <div class="form-group">
                <label for="designation">Designation</label>
                <select name="designation" id="designation"  class="form-control">
                    <option>Lecturer</option>
                    <option>Assistant Proffessor</option>
                    <option>Associate Proffessor</option>
                    <option>Proffessor</option>
                </select>
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
                <label for="credit_to_be_taken">Credit to be taken</label>
                <input type="text" name="credit_to_be_taken" id="credit_to_be_taken" placeholder="Credit to be taken" class="form-control">
            </div>
            <button class="btn btn-success mb-5" type="submit">Save</button>
        </form>
    </div>
</div>

    
@endsection
