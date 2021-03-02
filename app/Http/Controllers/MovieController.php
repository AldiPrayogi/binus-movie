<?php

namespace App\Http\Controllers;
use App\Movie;
use App\Comment;
use Auth;
use App\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    public function index($id){
        $movie =[
            'movies' => Movie::where('id', 'like', $id)->first(),
        ];
        $data = [
            'comments' => comment::where('movieId', 'like', $id)->get(),
        ];
        return view('movie')->with($movie)->with($data);
    }
    public function postComment(Request $request){
        $arr = [
            'comment' => 'required'
        ];
        $val = Validator::make($request->all(), $arr);
        if($val->fails()){
            return back()->withErrors($val);
        }
        Comment::create([
            'movieId' => $request->id,
            'userId' => Auth::id(),
            'movieComment' => $request->comment,
        ]);
        return back();
    }
    public function deleteComment($id){
        $comment = Comment::find($id);

        if(isset($comment)){
            $comment->delete();
        }

        return back();
    }
    public function daftarMovie(){
        $movies = [
            'movies' => Movie::paginate(10),
        ];
        return view('daftarMovie')->with($movies);
    }

    public function create(){
        $genres = Genre::all();
        return view('addMovie')->with([
            'genres' => $genres,
        ]);
    }

    public function store(Request $request){
        $arr = [
            'title' => 'required',
            'genre_id' => 'required',
            'description' => 'required',
            'rating' => 'required|numeric|min:1|max:10',
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $val = Validator::make($request->all(), $arr);
        if($val->fails()){
            return back()->withErrors($val);
        }
        if($request->hasfile('picture')){
            $pictureUploaded = $request->file('picture');
            $pictureName = time().'.'.$pictureUploaded->getClientOriginalExtension();
            $picturePath = public_path('/storage/pictures/');
            $pictureUploaded->move($picturePath, $pictureName);
            $movie = Movie::create([
                'user_id' => Auth::user()->id,
                'title' => $request->get('title'),
                'genre_id' => $request->get('genre_id'),
                'description' => $request->get('description'),
                'rating' => $request->get('rating'),
                'picture' => '/storage/pictures/'.$pictureName,
            ]);
        }
        $movie->save();

        return redirect('/managemovie')->with([
            'AddSuccess'=>'Movie has been added!'
        ]);
    }

    public function edit($id){
        $movie = Movie::find($id);
        $genres = Genre::all();
        return view('editmanagemovie')->with([
            'genres' => $genres,
            'movie' => $movie,
        ]);
    }

    public function update(Request $request, $id){
        $movie=Movie::find($id);
        $arr = [
            'title' => 'required',
            'genre_id' => 'required',
            'description' => 'required',
            'rating' => 'required|numeric|min:1|max:10',
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        
        $val = Validator::make($request->all(), $arr);
        if($val->fails()){
            return back()->withErrors($val);
        }
        if($request->hasfile('picture')){
            $pictureUploaded = $request->file('picture');
            $pictureName = time().'.'.$pictureUploaded->getClientOriginalExtension();
            $picturePath = public_path('/storage/pictures/');
            $pictureUploaded->move($picturePath, $pictureName);  
            DB::table('movies')->where('id', $request->id)->update([
                'user_id' => Auth::user()->id,
                'title' => $request->get('title'),
                'genre_id' => $request->get('genre_id'),
                'description' => $request->get('description'),
                'rating' => $request->get('rating'),
            ]);
            $movie->picture = '/storage/pictures/'.$pictureName;
        }
        $movie->save();
        return redirect('/managemovie')->with([
            'EditSuccess'=>'Movie has been updated!'
        ]);
    }
    public function destroy($id)
    {
        $movie=Movie::find($id);
            
        $movie->delete();
            
        return redirect('/managemovie')->with([
            'DeleteSuccess'=>'Movie has been deleted!'
        ]);
    }
        
}
