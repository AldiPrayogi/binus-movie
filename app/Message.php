<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'id', 'from_userid', 'to_userid', 'message'
    ];

    public function sender(){
        return $this->belongsTo('App\User', 'from_userid');
    }
    public function receiver(){
        return $this->belongsTo('App\User', 'to_userid');
    }
}
