@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 mt-5">
        <h1 class="text-center mb-5">View Course Stats</h1>
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
        </form>
    </div>
    <div class="col-md-12">
        <table class="table table-bordered table-hover" id="courseTable">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Semester</th>
                    <th>Assigned To</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script type=text/javascript>
    $('#department_id').change(function(){
    var departmentID = $(this).val();  
    if(departmentID){
      $.ajax({
        type:"GET",
        url:"{{url('get-course-stats')}}?departmentId="+departmentID,
        success:function(res){        
        if(res){
            console.log(res);
        //   $("#teacher_id").empty();
        //   $("#teacher_id").append('<option  value="" selected disabled>Select</option>');
          $.each(res,function(key,value){
            $("#courseTable tbody").append('<tr><td>'+value.code+'</td><td>'+value.name+'</td><td>'+value.semester.name+'</td><td>'+value.course_assigned.teacher_id+'</td></tr>');
          });
        
        }else{
            $("#courseTable tbody").empty();
        }
        }
      });
    }
});
    
  </script>
@endsection
