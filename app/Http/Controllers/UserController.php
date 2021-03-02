<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Movie;
use App\SavedMovie;
use Auth;
use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    //Untuk show profile
    public function profile(){
        $user = [
            'user' => Auth::user(),
        ];
        return view('profile', $user);
    }
    //Untuk show update form
    public function index($id){
        $user = DB::table('users')->where('id', $id)->first();
        return view('updateProfile', ['user'=>$user]);
    }
    //Untuk update
    public function update(Request $request){
        $user = Auth::user();
        $arr = [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required',
            'role' => 'required',
            'gender' => 'required|in:Male,Female',
            'DOB' => 'required|date',
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $val = Validator::make($request->all(), $arr);
        if($val->fails()){
            return back()->withErrors($val);
        }
        if($request->hasfile('avatar')){
            $avatarUploaded = $request->file('avatar');
            $avatarName = time().'.'.$avatarUploaded->getClientOriginalExtension();
            $avatarPath = public_path('/storage/avatars/');
            $avatarUploaded->move($avatarPath, $avatarName);   
            DB::table('users')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'role' =>$request->role,
                'address' => $request->address,
                'DOB' => $request->DOB,
                'avatar' => $avatarName,
            ]);
            $user->avatar = '/storage/avatars/'.$avatarName;
        }
        $user->save();
        $users = [
            'user' => Auth::user(),
        ];
        return redirect('profile')->with([
            'Success'=>'Your profile has been updated!'
        ]);
    }

    public function addBookmark($id){
        $movie = Movie::find($id);
        $user = Auth::id();
        $movie->users()->attach($user);
        return back();
    }

    public function deleteBookmark($id){
        $savedMovie = SavedMovie::find($id);

        $savedMovie->delete();

        return back();
    }

    public function indexBookmark(){
        $id = Auth::id();
        $data = [
            'movies' => DB::table('movies')
                        ->join('saved_movies', 'movies.id', '=', 'saved_movies.movie_id')
                        ->join('genres', 'movies.genre_id', '=', 'genres.id')
                        ->where('saved_movies.user_id', 'like', $id)
                        ->select('movies.*', 'genreName')
                        ->paginate(10),
        ];

        return view('bookmarks', $data);
    }
}
