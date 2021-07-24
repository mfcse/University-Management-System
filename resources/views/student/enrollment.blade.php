@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 mt-5">
        <h1 class="text-center mb-5">Enroll in a Course</h1>
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
                <label for="registration_id">Student Registration ID</label>
                <select name="registration_id" id="registration_id"  class="form-control">
                    <option value="" selected disabled>Select</option>
                    @foreach ($students as $student)
                    <option value="{{$student->registration_id}}">{{$student->registration_id}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
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
            </div>

            <div class="form-group">
                <label for="course_code">Course</label>
                <select name="course_code" id="course_code" class="form-control"></select>
            </div>
            
            <button class="btn btn-success mb-5" type="submit">Assign</button>
        </form>
    </div>
</div>

<script type=text/javascript>
    
    $('#registration_id').change(function(){
    var registrationId = $(this).val(); 
    var deptID=2; 
    if(registrationId){
   //1st
    $.ajax({
        type:"GET",
        async: false,
        url:"{{url('get-student-data')}}?registrationId="+registrationId,
        success:function(res){
            deptID=res.department_id;
            // console.log(deptID);
            console.log(res);
           // $temp;        
        if(res){
                $("#name").val(res.name);
                $("#email").val(res.email);
                $("#student_department").val(res.department.name);
                $("#department_id").val(res.department_id);
        }
        else{
            $("#name").val();
                $("#email").val();
                $("#student_department").val();
        }
      }
    });
    
//2nd
    $.ajax({
        type:"GET",
        async: false,
        url:"{{url('get-courses-data')}}?deptID="+deptID,
        success:function(res){
         
        if(res){
          $("#course_code").empty();
          $("#course_code").append('<option  value="" selected disabled>Select</option>');
          $.each(res,function(key,value){
              //console.log(value);  
 
               $("#course_code").append('<option value="'+value.code+'">'+value.name+'</option>');
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
