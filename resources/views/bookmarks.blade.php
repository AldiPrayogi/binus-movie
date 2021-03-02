@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section("content")
<div class="container">

      @if(count($movies) === 0)
        <div class="card mb-3" style="margin:auto">
            <div class="card-body">
                <h5 class="card-title text-center"><b>Oops!</b></h5>
                <p class="card-text text-center">There isn't any movies with that name or genre!</p>
                <a href="/" class="btn btn-primary btn-block">Go to Home</a>
            </div>
        </div>
      @endif
      @foreach($movies as $movie)
        <div class="card mb-3">
          <div class="row">
            <div class="col-md-2">
              <a href="#">
                <img class="img-fluid rounded mb-4 mb-md-0" src="{{asset($movie->picture)}}" alt=""style="max-width:150%">
              </a>
            </div>
            <div class="col-md-10"style="padding-left:7%;padding-bottom:7%;padding-right:7%">
              <br>
              <h3><b><a href="/movie/{{$movie->id}}">{{$movie->title}}</a></b></h3>
              <p style="color:grey">{{$movie->genreName}}</p>
              <p>{{$movie->description}}</p>
              <span class="fa fa-star checked" style = "color: orange;margin-right:2%"></span>{{number_format($movie->rating, 1)}}
            </div>
          </div> 
        </div>
      @endforeach  
    </div>
  {{$movies->links()}}
@endsection
