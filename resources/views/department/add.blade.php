@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-4 offset-md-4 mt-5">
        <h1 class="text-center mb-5">Add a Department</h1>
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
                <label for="name">Code</label>
                <input type="text" name="code" id="code" placeholder="Enter Department Code" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Department Name" class="form-control">
            </div>
            <button class="btn btn-success" type="submit">Save</button>
        </form>
    </div>
</div>

    
@endsection
