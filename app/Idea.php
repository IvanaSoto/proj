<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{

	protected $fillable = ['title', 'text'];


    public function user()
    {
        return $this->belongsToMany('App\User')->withTimestamps()->withPivot('like');
    }
}
