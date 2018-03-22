<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{

	protected $fillable = ['title', 'text', 'user_id'];


    public function agreements()
    {
        return $this->belongsToMany('App\User')->withTimestamps()->withPivot('like');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
