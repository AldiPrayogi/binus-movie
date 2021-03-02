<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = [
           'genres' => Genre::all(),
        ];
        return view('genre.genre', $genres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('genre.addgenre');
    }
    
    
    public function edit($id)
    {
      $genre=Genre::find($id);
      return view('genre.editgenre')->with([
          'genre'=>$genre
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all()); //buat cek
        $arr = [
            'genreName' => 'required',
        ];
        $val = Validator::make($request->all(), $arr);
        if($val->fails()){
            return back()->withErrors($val);
        }
        $genre=Genre::create([
           'genreName'=> $request->get('genreName'),
        ]);
        return redirect('/genre')->with([
        'Success'=>'Data has been recorded'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arr = [
            'genreName' => 'required',
        ];
        $val = Validator::make($request->all(), $arr);
        if($val->fails()){
            return back()->withErrors($val);
        }
        $genre=Genre::find($id);
        $genre->update($request->all());
        $genre->save();
        return redirect('/genre')->with([
            'UpdateSuccess'=>'Data has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre=Genre::find($id);
            
        $genre->delete();
        return redirect('/genre')->with([
            'DeleteSuccess' => 'Data has been deleted'
        ]);
       
    }
    
}
