@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 mt-5">
        <h1 class="text-center mb-5">View All Departments</h1>
        

            @if (session()->has('message'))
            <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
                {{session()->get('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            @endif
                        
       <table class="table table-bordered table-hover" id="departmentTable">
           <thead>
               <tr>
                   <th>Serial</th>
                   <th>Code</th>
                   <th>Name</th>
              </tr>
           </thead>
           <tbody>
               @foreach ($departments as $department)
               <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$department->code}}</td>
                <td>{{$department->name}}</td>
               </tr>
               @endforeach
               
           </tbody>
       </table>
    </div>
    {{-- {{$countries->links()}} --}}
</div>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#departmentTable').DataTable();
} );
</script>
@endsection

