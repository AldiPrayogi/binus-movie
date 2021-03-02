@extends('layouts.app')

@section('content')
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
<div class="container">
<div class="row">
<div class="col-md-12 offset-md-0 text-center">
  <a href="/add-user" method="GET">
        <button type="submit" class="btn btn-primary" >Add User</button>
  </a>
    </div>
</div>
</div>

<div class="container">
        <h2>Manage User</h2>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Gender</th>
                <th>Adress</th>
                <th>Profile Picture</th>
                <th>DOB</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->gender}}</td>
                    <td>{{$user->address}}</td>
                    <td><img src="{{asset($user->avatar)}}"style="width:auto; height:150px; margin-left:25px;"></td>
                    <td>{{$user->DOB}}</td>
                    
                    <td>
                    <a href="edit-user/{{$user->id}}">
                      <button type="button" class="btn btn-warning">Edit</button>
                    </a>

                  <a href="{{route('user.destroy',$user->id)}}">
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