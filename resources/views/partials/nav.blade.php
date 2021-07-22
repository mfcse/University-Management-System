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
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Department</a>
            <div class="dropdown-menu" aria-labelledby="dropdown07">
              <a class="dropdown-item" href="{{route('department.add')}}">Add a Department</a>
              {{-- <a class="dropdown-item" href="{{route('country.show')}}">View All Countries</a> --}}
            </div>
          </li>
          {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">City</a>
            <div class="dropdown-menu" aria-labelledby="dropdown07">
              <a class="dropdown-item" href="{{route('city.add')}}">Add a City</a>
              <a class="dropdown-item" href="{{route('city.show')}}">View All Cities</a>
            </div>
          </li> --}}
        </ul>
        <form class="form-inline my-2 my-md-0">
          <input class="form-control" type="text" placeholder="Search" aria-label="Search" id="search" name="search">
        </form>
      </div>
    </div>
  </nav>