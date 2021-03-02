@extends('layouts.app')
@section("content")
    <div class="card" style="width: 80%; margin:auto">
        <div class="card-body">
            <div class="container">
                <div class="card mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="#">
                            <img class="img-fluid rounded mb-3 mb-md-0" src="{{asset($movies->picture)}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-9">
                            @if(Auth::user()['role'] == "Member")
                                @foreach($movies->savedBy as $u)
                                    @if($u->user_id == Auth::id())
                                        <form action="/deletebookmark/{{$u->id}}"method="GET">
                                        <button class="btn btn-light" style="float:right; color:orange; margin-top:3%; margin-right:3%; background-color:white"><i class="fa fa-bookmark fa-2x"></i></button>
                                        </form>
                                    @elseif(is_null($u) || $u->user_id != Auth::id())
                                        <form action="/addbookmark/{{$u->movie_id}}" method="POST">
                                        @csrf
                                        <button class="btn btn-light" style="float:right; color:grey; margin-top:3%"><i class="fa fa-bookmark fa-2x"></i></button>
                                        </form>
                                    @endif
                                @endforeach
                            @endif
                            <br>
                            <h4><a href="/movie/{{$movies->id}}">{{$movies->title}}</a></h3>
                            <p style="color:grey">{{$movies->genres['genreName']}}</p>
                            <p class="card-text" style="margin-right:10px">{{$movies->description}}</p>
                            <span class="fa fa-star checked" style = "color: orange;margin-right:2%"></span>{{number_format($movies->rating, 1)}}
                            <p style="color:grey">Created at: {{$movies->created_at}}</p>
                        </div>
                    </div>
                </div>
            @foreach($comments as $comment)
            <br>
            <div class="card">
                <div class="card-body">
                    @if ($comment->userId == Auth::id())
                    <div class="float-right">
                        <a href="/deleteComment/{{$comment->id}}">
                            <button type="button" class="btn btn-danger">Delete</button>
                        </a>
                    </div>
                    @endif
                    <div>
                        <img src="{{asset($comment->users['avatar'])}}" style="border-radius:180px;width:auto; width:7%; float:left;margin-right:25px;">
                        <p>
                            <a href="/profiles/{{$comment->userId}}">{{$comment->users['name']}}</a> 
                        </p>
                        <p style="color:grey">
                            Commented at: {{$comment->created_at}}  
                        </p>
                        <p>
                            {{$comment->movieComment}}
                        </p>
                    </div> 
                </div>
            </div>
            @endforeach  
            <br>
            @auth
            <div class="card">
                <div class="card-body">
                    <form action="/movieComment" method="POST">
                        @csrf
                        @error('comment')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                        <div class="form-group">
                            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"cols="29"></textarea>
                            
                            <input type="hidden" name="id" value="{{$movies->id}}">
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>
@endsection
