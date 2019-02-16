<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Reply extends Model
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id', 'tweet_id', 'text',
    ];

public function users()
{
	return $this->hasMany('App\User','user_id','id');
}

public function tweets()
{
	return $this->hasMany('App\Tweet','tweet_id','id');
}
}
