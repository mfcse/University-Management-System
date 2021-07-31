<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample07">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
          </li>
                    
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Departments</a>
            <div class="dropdown-menu" aria-labelledby="dropdown07">
              <a class="dropdown-item" href="{{route('department.add')}}">Add a Department</a>
              <a class="dropdown-item" href="{{route('department.show')}}">View All Departments</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Courses</a>
            <div class="dropdown-menu" aria-labelledby="dropdown07">
              <a class="dropdown-item" href="{{route('course.add')}}">Add a Course</a>
              <a class="dropdown-item" href="{{route('course.assign')}}">Assign a Course</a>
              <a class="dropdown-item" href="{{route('course.stats')}}">View Course Stats</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Teachers</a>
            <div class="dropdown-menu" aria-labelledby="dropdown07">
              <a class="dropdown-item" href="{{route('teacher.add')}}">Add a Teacher</a>
              {{-- <a class="dropdown-item" href="{{route('city.show')}}">View All Cities</a> --}}
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Students</a>
            <div class="dropdown-menu" aria-labelledby="dropdown07">
              <a class="dropdown-item" href="{{route('student.register')}}">Register a Student</a>
              <a class="dropdown-item" href="{{route('student.enroll')}}">Enroll in a Course</a>
              <a class="dropdown-item" href="{{route('result.add')}}">Save Result</a>
              <a class="dropdown-item" href="{{route('result.show')}}">View Result</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Classrooms</a>
            <div class="dropdown-menu" aria-labelledby="dropdown07">
              <a class="dropdown-item" href="{{route('classroom.allocate')}}">Allocate a Classroom</a>
              <a class="dropdown-item" href="{{route('allocation.show')}}">View Class Schedule</a>
              
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clear Data</a>
            <div class="dropdown-menu" aria-labelledby="dropdown07">
              <a class="dropdown-item" href="{{route('course.unassign')}}">Unassign all Courses</a>
              <a class="dropdown-item" href="{{route('classroom.unallocate')}}">Unallocate all Classrooms</a>
              
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-md-0">
          <input class="form-control" type="text" placeholder="Search" aria-label="Search" id="search" name="search">
        </form>
      </div>
    </div>
  </nav>