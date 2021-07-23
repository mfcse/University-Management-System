@extends('layouts.master')

@section('content')
<h3 class="display-4 text-center pt-5 pb-1">
    University Management System
</h3>
<p class="text-center py-1">A Web Application for managing department, course, students, teachers, result etc.</p>

  <div class="row mt-5">
    <div class="col-md-6 offset-md-3 py-3">
      <h2 class="text-center">Add</h2>
    </div>
  </div>
  
  <div class="row mt-5">
    <div class="card col-md-3">
        <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('department.add')}}">Add a Department</a>
            </h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>

      <div class="card col-md-3">
        <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('course.add')}}">Add a Course</a>
            </h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>

      <div class="card col-md-3">
        <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('teacher.add') }}">Add a Teacher</a>
            </h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div> 

      <div class="card col-md-3">
        <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('course.assign') }}">Course Assign to a Teacher</a>
            </h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
  </div>
    
  <div class="row mt-5">
    <div class="col-md-6 offset-md-3 py-3">
      <h2 class="text-center">View</h2>
    </div>
  </div>
  <div class="row mt-5">
  <div class="card col-md-3">
    <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">
            <a href="{{ route('department.show') }}">View All Departments</a>
        </h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
  </div>
  <div class="card col-md-3">
      {{-- <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
      <div class="card-body">
          <h5 class="card-title">
              <a href="{{ route('department.add')}}">Add a Department</a>
          </h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div> --}}
    </div>

    <div class="card col-md-3">
      {{-- <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
      <div class="card-body">
          <h5 class="card-title">
              <a href="{{ route('course.add')}}">Add a Course</a>
          </h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div> --}}
    </div>

    <div class="card col-md-3">
      {{-- <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
      <div class="card-body">
          <h5 class="card-title">
              <a href="{{ route('teacher.add') }}">Add a Teacher</a>
          </h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div> --}}
    </div> 
</div>
    
 @endsection
        
  