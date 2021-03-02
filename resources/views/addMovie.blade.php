@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-8">
            <div class="card" style = "background-color:rgba(0,0,0,.03)">
                <div class="card-header" style="text-align: center; padding-top:30px; padding-bottom: 0px">
                        <h3 class="text-center"><b>Add Movie</b></h3>
                </div>
                <div class="card-body">
                    <form action="/add-movie/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                                <input type="hidden" name = "id" class="form-control" readonly>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Title">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <select class="form-control" id="genre_id" name="genre_id">
                                @foreach ($genres as $genre)
                                    <option value="{{$genre->id}}">{{$genre->genreName}}</option>
                                @endforeach
                            {{-- <option value="">Pilih role</option> --}}
                            </select>
                        </div>

                        
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="5" placeholder="Description"></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                    
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="rating" class="form-control @error('rating') is-invalid @enderror" name="rating" placeholder="Rating">

                                @error('rating')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                   
                        <div class="form-group">
                            <div class="col-md-12" style="align:center">
                                <input name="picture" type="file" class="form-control custom-file-input @error('picture') is-invalid @enderror" name="picture" required accept="image/*">
                                
                                <label class="custom-file-label" for="picture">Choose File [Max: 2MB]</label>
                            </div>
                            @error('picture')
                                <br><div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                                <button type="submit" class="btn btn-primary" style = "width: 100%">
                                    Submit
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