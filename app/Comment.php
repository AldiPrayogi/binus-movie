<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function users(){
        return $this->belongsTo('App\User', 'userId');
    }
    public function movies(){
        return $this->belongsTo('App\Movie', 'movieId');
    }
    protected $fillable = ['movieId', 'userId', 'movieComment'];
}
