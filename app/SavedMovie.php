<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SavedMovie extends Model
{
    protected $fillable = [
        "movie_id",
        "user_id",
    ];
    public function movies(){
        return $this->belongsTo('App\SavedMovie', 'movie_id');
    }
    public function users(){
        return $this->belongsTo('App\SavedMovie', 'user_id');
    }

}
