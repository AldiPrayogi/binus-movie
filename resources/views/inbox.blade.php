@extends('layouts.app')

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                @if (session()->has('DeleteSuccess'))
                    <div class="alert alert-success">
                        <strong>{{session()->get("DeleteSuccess")}}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
   
    @if(count($messages) === 0)
        <div class="card" style="width: 80%; margin:auto">
            <div class="card-body">
                <h5 class="card-title text-center"><b>Oops!</b></h5>
                <p class="card-text text-center">You haven't got any messages!</p>
                <a href="/" class="btn btn-primary btn-block">Go to Home</a>
            </div>
        </div>
    @endif
    
    @foreach($messages as $message)
    <div class="card" style="width: 80%; margin:auto">
    
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <img src="{{asset($message->sender->avatar)}}" style="width:auto; height:150px; float:left;margin-right:25px;">
                        <a href="/profiles/{{$message->sender->id}}"><h2>{{ $message->sender->name}}</h2></a>
                        <p><b>Posted at: </b> {{ $message->created_at }}</p>
                        <p><b>Message: </b> {{ $message->message }}</p>  
                    </div>
                    <form action="/messageDelete/{{$message->id}}">
                        <input type="hidden" name="{{$message->id}}">
                        <input type="submit" value="Remove"class="btn btn-danger"style="float:right">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
        {{$messages->links()}}
@endsection