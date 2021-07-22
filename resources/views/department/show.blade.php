@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 mt-5">
        <h1 class="text-center mb-5">View Countries</h1>
        

            @if (session()->has('message'))
            <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
                {{session()->get('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            @endif
            {{-- <div class="search-bar py-3">
                <input type="text" name="countrySearch" id="countrySearch">
                <button type="submit" name="searchCountry" id="searchCountry" class="btn btn-success">Search</button>
            </div> --}}
            
       <table class="table table-bordered table-hover" id="countryTable">
           <thead>
               <tr>
                   <th>Serial</th>
                   <th>Name</th>
                   <th>About</th>
                   <th>Number Of Cities</th>
                   <th>No. Of City Dwellers</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($countries as $country)
               <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$country->name}}</td>
                <td>{!! $country->about !!}</td>
                <td>{{count($country->cities)}}</td>
                <td>
                    {{-- @php
                        foreach($country->cities as $city){
                            $number_of_dwellers=$number_of_dwellers+$city->number_of_dwellers;
                        }
                        echo $number_of_dwellers.'<br>';
                        $number_of_dwellers=0;
                    @endphp --}}
                    {{$number_of_dwellers[$loop->index]}}
                    
                </td>
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
    $('#countryTable').DataTable();
} );
</script>
@endsection

