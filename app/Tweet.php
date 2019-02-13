
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Follow;

class Tweet extends Model
{
	public static function getTlTweet()
	{                              
		//ログインしているユーザーを取得する
		$my_user= Auth::user();

		//ログインしているユーザーがフォローしているユーザーを取得する
		$follower =Follow::where('user_id',$my_user->id)->get();

		//whereINで使える配列つくる
		// $user_id_list = [];
		// $user_id_list[]= '$my_user->id';
		// $user_id_list[]= '$follower->id';

		$user_id_list = [];
		$user_id_list[] = $my_user->id;
		foreach ($follower as $key => $value) {
			$user_id_list[]= $value->follow_id;
		}

		//ツイートテーブルの中からログインしているユーザーとフォローしているユーザーのツイートを取得する
		$tweet = Tweet::whereIn('user_id',$user_id_list)
		->orderByRaw('tweets.created_at DESC')->get();
		return $tweet;

		// $user = Auth::user();
		// $MyTweets = self::where('user_id',$user->id)->get();
	
		// return $MyTweets;
	}


     public function users()
     	{
     		return $this->belongsTo('App\User','user_id','id');
     	}
}


