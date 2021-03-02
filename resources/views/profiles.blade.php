@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
            @if (session()->has('messageSent'))
                <div class="alert alert-success">
                <strong>{{session()->get("messageSent")}}</strong>
                </div>
            @endif
            </div>
        </div>
    </div>

    <div class="card" style="width: 80%; margin:auto">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <img src="{{asset($users->avatar)}}" style="width:auto; height:150px; float:left;margin-right:25px;">
                        <h2>{{ $users->name }}</h2>
                        <p>{{ $users->email }}</p>
                        <p>{{ $users->address }}</p>  
                    </div>
                    @if($users->id == Auth::id())
                    <form action="/profile/updateProfile/{{$users->id}}">
                        <input type="submit" value="Update Profile"class="btn btn-danger"style="float:right"name="{{$users->id}}">
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @auth
            @if($users->id != Auth::id())
            <div class="card-body" style="background-color:lightgrey">
                <form action="/sendmessage/{{$users->id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control @error('messages') is-invalid @enderror" id="exampleFormControlTextarea1" rows="6" name="messages"></textarea>
                        @error('messages')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
            @endif
        @endauth
    </div>
@endsection