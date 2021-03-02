@extends('layouts.app')

@section("content")
<div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-md-offset-1">
                        @if (session()->has('Success'))
                            <div class="alert alert-success">
                                <strong>{{session()->get("Success")}}</strong>
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
                                <img src="{{asset($user->avatar)}}" style="width:auto; height:150px; float:left;margin-right:25px;">
                                <h2>{{ $user->name }}</h2>
                                <p>{{ $user->email }}</p>
                                <p>{{ $user->address }}</p>  
                            </div>
                            <form action="/profile/updateProfile/{{$user->id}}">
                                <input type="submit" value="Update Profile"class="btn btn-danger"style="float:right"name="{{$user->id}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection