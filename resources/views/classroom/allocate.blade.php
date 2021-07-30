@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 mt-5">
        <h1 class="text-center mb-5">Allocate a Classroom</h1>
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
            {{-- <div class="form-group">
                <label for="registration_id">Student Registration ID</label>
                <select name="registration_id" id="registration_id"  class="form-control">
                    <option value="" selected disabled>Select</option>
                    @foreach ($students as $student)
                    <option value="{{$student->registration_id}}">{{$student->registration_id}}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label for="department_id">Department</label>
                <select name="department_id" id="department_id"  class="form-control">
                    <option disabled selected>Select</option>
                    @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name"  class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email"  class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="student_department">Department</label>
                <input type="text" name="student_department" id="student_department"  class="form-control" readonly>
                <input type="hidden" name="department_id" id="department_id">
            </div> --}}

            <div class="form-group">
                <label for="course_code">Course</label>
                <select name="course_code" id="course_code" class="form-control"></select>
            </div>

            <div class="form-group">
                <label for="room_code">Room ID</label>
                <select name="room_code" id="room_code"  class="form-control">
                    @foreach ($classrooms as $classroom)
                    <option value="{{$classroom->code}}">{{$classroom->code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="day">Day</label>
                <select name="day" id="day"  class="form-control">
                    <option>Sunday</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                </select>
            </div>

            <div class="form-group">
                <label for="start_time">From</label>
                <input type="time" name="start_time" id="start_time" class="form-control">
            </div>
            <div class="form-group">
                <label for="end_time">From</label>
                <input type="time" name="end_time" id="end_time" class="form-control">
            </div>
            
            <button class="btn btn-success mb-5" type="submit">Allocate</button>
        </form>
    </div>
</div>

<script type=text/javascript>
    
    $('#department_id').change(function(){
    var departmentId = $(this).val(); 
    //var deptID=2; 
    if(departmentId){
   
    $.ajax({
        type:"GET",
        async: true,
        url:"{{url('get-assigned-courses')}}?departmentId="+departmentId,
        success:function(res){
         
        if(res){
          $("#course_code").empty();
          $("#course_code").append('<option  value="" selected disabled>Select</option>');
          $.each(res,function(key,value){
              //console.log(value);  
 
               $("#course_code").append('<option value="'+value.course_code+'">'+value.course.name+'</option>');
          });
        
        }else{
          $("#course_code").empty();
        }
        }
      });

    } 
    });
    //console.log(deptID);
  </script>
@endsection
