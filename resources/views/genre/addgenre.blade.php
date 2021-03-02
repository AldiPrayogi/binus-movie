@extends('layouts.app')

@section('content')        
<div class="container">
    <div class="card">
        <div class="card-body">
        <h3 class="text-center card-title"><b>Add Genre</b></h3>
            <form action="/add-genre/addgenre/store" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text" class="form-control @error('genreName') is-invalid @enderror" name="genreName" id="genreName" placeholder="Genre Name">
                            @error('genreName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary btn-block" >
                                Submit
                            </button>
                        </div>
                    </div>
                </div>   
            </form>
        </div>
    </div>
</div>

      
@endsection