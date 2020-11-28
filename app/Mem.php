<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; 


class Mem extends Model
{

    protected $guarded = []; 
     
    public function user() {
        return $this->belongsTo('App\User');
    }


     public function category() {
        return $this->belongsTo('App\Category');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function likes() {
        return $this->hasMany('App\Like');
    }

    public function isLiked()
    {
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }

    public function photos() {
        return $this->morphMany('App\Photo', 'photoable');
    }
}

// return $this->hasManyThrough('App\Room', 'App\TouristObject','city_id','object_id');