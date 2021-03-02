@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style = "background-color:rgba(0,0,0,.03)">
                <div class="card-header" style="text-align: center; padding-top:30px; padding-bottom: 0px">
                    <h2>Register</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}"enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="Male"><label for="gender"style="padding-left: 5px; padding-right: 10px">Male</label>
                                <input type="radio"  class="@error('gender') is-invalid @enderror" name="gender" value="Female" ><label for="gender"style="padding-left: 5px">Female</label>
                                
                                @error('gender')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" cols="30" rows="3" placeholder="Address"></textarea>
                                
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="DOB" type="date" class="form-control @error('DOB') is-invalid @enderror" name="DOB" required autocomplete="date" placeholder="Date Of Birth">
                                
                                @error('DOB')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12" style="align:center">
                                <input id="avatar" type="file" class="form-control custom-file-input @error('avatar') is-invalid @enderror" name="avatar" required accept="image/*">
                                
                                <label class="custom-file-label" for="profile_picture" >Choose File [Max: 2MB]</label>
                                @error('avatar')
                                    <br><div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                                <button type="submit" class="btn btn-primary" style = "width: 100%">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
