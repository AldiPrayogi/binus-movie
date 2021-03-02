<?php

namespace App\Http\Controllers;
use App\Movie;
use App\Genre;
use App\Rating;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'movies' => Movie::paginate(10),
        ];
        return view('welcome')->with($data);
    }
    public function searching(Request $request){
        $search = $request->searchVar;
        $data = [
            'movies' => DB::table('movies')
                        ->join('genres', 'movies.genre_id', '=', 'genres.id')
                        ->where('movies.title', 'like', '%'.$search.'%')
                        ->orWhere('genres.genreName', 'like', '%'.$search.'%')
                        ->select('movies.*', 'genreName')
                        ->paginate(10),
        ];

        return view('home', $data);
    }
    
}
