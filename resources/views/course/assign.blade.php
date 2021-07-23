@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 mt-5">
        <h1 class="text-center mb-5">Assign a Course</h1>
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
                <label for="department_id">Department</label>
                <select name="department_id" id="department_id"  class="form-control">
                    <option value="" selected disabled>Select</option>
                    @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="teacher_id">Teacher</label>
                <select name="teacher_id" id="teacher_id"  class="form-control">
                </select>
            </div>

            <div class="form-group">
                <label for="credit_to_be_taken">Credit to be taken</label>
                <input type="text" name="credit_to_be_taken" id="credit_to_be_taken" class="form-control"  readonly>
            </div>

            <div class="form-group">
                <label for="remaining_credit">Remaining Credit</label>
                <input type="text" name="remaining_credit" id="remaining_credit" class="form-control"  readonly>
            </div>
    
            <div class="form-group">
                <label for="course_code">Course</label>
                <select name="course_code" id="course_code" class="form-control"></select>
                <input type="hidden" name="course_id" id="course_id">
            </div>
             
            <div class="form-group">
                <label for="course_name">Course Name</label>
                <input type="text" name="course_name" id="course_name" class="form-control"   readonly>
            </div>
            <div class="form-group">
                <label for="course_credit">Course Credit</label>
                <input type="text" name="course_credit" id="course_credit" class="form-control"   readonly>
            </div>
            
            <button class="btn btn-success mb-5" type="submit">Assign</button>
        </form>
    </div>
</div>

<script type=text/javascript>
    $('#department_id').change(function(){
    var departmentID = $(this).val();  
    if(departmentID){
      $.ajax({
        type:"GET",
        url:"{{url('get-teachers')}}?departmentId="+departmentID,
        success:function(res){        
        if(res){
          $("#teacher_id").empty();
          $("#teacher_id").append('<option  value="" selected disabled>Select</option>');
          $.each(res,function(key,value){
            $("#teacher_id").append('<option value="'+value.id+'">'+value.name+'</option>');
          });
        
        }else{
          $("#teacher_id").empty();
        }
        }
      });
      $.ajax({
        type:"GET",
        url:"{{url('get-courses')}}?departmentId="+departmentID,
        success:function(res){ 
            //console.log(res);       
        if(res){
          $("#course_code").empty();

          $("#course_code").append('<option  value="" selected disabled>Select</option>');

          $.each(res,function(key,value){
            $("#course_code").append('<option value="'+value.code+'">'+value.code+'</option>');
          });
        
        }else{
          $("#course_code").empty();
        }
        }
      });
    }else{
      $("#teacher_id").empty();
      $("#course_code").empty();
    }   
    });
    //get value for a course
    $('#course_code').change(function(){
    var courseCode = $(this).val();  
    if(courseCode){
      $.ajax({
        type:"GET",
        url:"{{url('get-course-data')}}?courseCode="+courseCode,
        success:function(res){        
        if(res){
           // console.log(res);
          $("#course_name").val(res['name']);
          $("#course_id").val(res['id']);
          $("#course_credit").val(res['credit']);
                
        }else{
          $("#credit_to_be_taken").val();
          $("#remaining_credit").val();
        }
        }
      });
    } 
    });

    //get value for a teacher
    $('#teacher_id').change(function(){
    var teacherId = $(this).val();  
    if(teacherId){
      $.ajax({
        type:"GET",
        url:"{{url('get-teacher-data')}}?teacherId="+teacherId,
        success:function(res){        
        if(res){
            //console.log(res);
          $("#credit_to_be_taken").val(res['credit_to_be_taken']);
          $("#remaining_credit").val(res['remaining_credit']);
                
        }else{
            $("#credit_to_be_taken").val();
          $("#remaining_credit").val();
        }
        }
      });
    } 
    });
    
  </script>
@endsection
