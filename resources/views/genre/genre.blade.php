@extends('layouts.app')

@section('content')
<div class="container">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-md-offset-1">
      @if (session()->has('Success'))
        <div class="alert alert-success">
          <strong>{{session()->get("Success")}}</strong>
        </div>
      @endif
      @if (session()->has('UpdateSuccess'))
        <div class="alert alert-success">
          <strong>{{session()->get("UpdateSuccess")}}</strong>
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

  <div class="row">
    <div class="col-md-12 offset-md-0 text-center">
      <a href="/add-genre/">
            <button type="submit" class="btn btn-primary" >Add Genre</button>
      </a>
        </div>
    </div>
  </div>

  <div class="container">
    <h2>Manage Genre</h2>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
              <th>Name</th>
              <th>Action</th>  
          </tr>
        </thead>
          <tbody>
            @foreach($genres as $genre)
              <tr>
                <td>{{$genre->id}}</td>
                <td>{{$genre->genreName}}</td>
                <td>
                  <a href="edit-genre/{{$genre->id}}">
                    <button type="button" class="btn btn-warning">Edit</button>
                  </a>
                  <a href="{{route('genre.destroy',$genre->id)}}">
                    <button type="button" class="btn btn-danger">Delete</button>   
                  </a>
                </td>
              </tr>
            @endforeach    
          </tbody>
      </table>
    </div>
  </div>

@endsection