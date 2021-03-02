<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        "title",
        "user_id",
        "genre_id",
        "description",
        "rating",
        "picture",
    ];

    public function genres(){
        return $this->belongsTo('App\Genre', 'genre_id');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function savedBy(){
        return $this->hasMany('App\SavedMovie');
    }
    public function postedBy(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
