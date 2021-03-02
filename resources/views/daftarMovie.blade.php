@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-md-12 col-md-offset-1">
            @if (session()->has('EditSuccess'))
              <div class="alert alert-success">
                <strong>{{session()->get("Success")}}</strong>
              </div>
           @endif
           @if (session()->has('AddSuccess'))
              <div class="alert alert-success">
                <strong>{{session()->get("AddSuccess")}}</strong>
              </div>
           @endif
           @if (session()->has('DeleteSuccess'))
              <div class="alert alert-success">
                <strong>{{session()->get("DeleteSuccess")}}</strong>
              </div>
           @endif
      </div>
  </div>
</div>
<div class="container">
  <div class="row">
  <div class="col-md-12 offset-md-0 text-center">
    <a href="/add-movie" method="GET">
      <button type="submit" class="btn btn-primary" >Add Movie</button>
    </a>
      </div>
  </div>
</div>

<div class="container">
  <h2>Manage Movie</h2>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Posted By</th>
            <th>Genre</th>
            <th>Title</th>
            <th>Picture</th>
            <th>Description</th>
            <th>Rating</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($movies as $movie)
          <tr>
            <td>{{$movie->id}}</td>
            <td>{{$movie->postedBy['name']}}</td>
            <td>{{$movie->genres->genreName}}</td>
            <td style="color:orange">{{$movie->title}}</td>
            <td><img src="{{asset($movie->picture)}}"style="width:auto; height:150px;"></td>
            <td>{{$movie->description}}</td>
            <td>{{$movie->rating}}</td>    
            <td style="padding-right: 50px">
              <div class="row">
                <div class="col-md-7">
                  {{-- <button type="button" class="btn btn-warning">Edit</button> --}}
                  <a class="btn btn-warning" href="{{route('daftar.movie.edit',$movie->id)}}">Edit</a>
                </div>
                <div class="col-md-6">
                  {{-- <button type="button" class="btn btn-danger">Delete</button>   --}}
                  <a class="btn btn-danger" href="{{route('movie.destroy',$movie->id)}}">Delete</a> 
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      
      </tbody>
    </table>
  </div>
</div>
      
@endsection