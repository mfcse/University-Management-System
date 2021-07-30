@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2 mt-5">
        <h1 class="text-center mb-5">View Course Schedule</h1>
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
                    <option disabled selected>Select</option>
                    @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
            </div>

          
        </form>
        <table class="table table-bordered table-hover mb-5" id="scheduleTable">
            <thead>
                <tr>
                    <th colspan="5" style="text-align: center">Schedule Info</th>
                </tr>
                <tr>
                    <th>Course Code</th>
                    <th>Name</th>
                    <th>Room No</th>
                    <th>Day</th>
                    <th>Time</th>
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
        url:"{{url('get-allocation-stats')}}?departmentId="+departmentID,
        success:function(res){        
        if(res){
            console.log(res);
            $("#scheduleTable tbody").empty();
        //   $("#teacher_id").empty();
        //   $("#teacher_id").append('<option  value="" selected disabled>Select</option>');
          $.each(res,function(key,value){
            //   let teacher=(!value.course_assigned) ? "Not Assigned Yet" : value.course_assigned.teacher.name;
              //console.log(teacher);
              //console.log(typeof(value.start_time));
              $("#scheduleTable tbody").append('<tr><td>'+value.course_code+'</td><td>'+value.course.name+'</td><td>'+value.room_code+'</td><td>'+value.day+'</td><td>'+value.start_time+'-'+value.end_time+'</td></tr>');

            // $("#scheduleTable tbody").append('<tr><td>'+value.course_code+'</td><td>'+value.course.name+'</td><td>Room No: '+value.room_code+', '+value.day+', '+value.start_time+'-'+value.end_time+'</td></tr>');
          });
        
        }else{
            $("#scheduleTable tbody").empty();
        }
        }
      });
    }
});
    
    //console.log(deptID);
  </script>
@endsection
