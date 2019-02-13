<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tweet;

class TweetController extends Controller
{
    public function __construct()
    {
    	$this->Tweet = new \App\Tweet;
    }

    public function update (Request $request)
    {
    	// $tweet = Tweet::newTweet();
    	// $id = Auth::id();

    	// $tweetEntity = [
    	// 	'users_id' => $id,
    	// 	'tweet' => $request->input('tweet'),
    	// ];

    	$tweet = new Tweet;
        $tweet->user_id = Auth::id();
        $tweet->tweet = $request->input('tweet');
        $tweet->save();


    	// if (!$this->Tweet->tweetUpdateOrCreate($tweetEntity)) {
    	// 	$request->session()->flash('message','ツイート時にエラーが発生しました。');
    	// }

    	return redirect()->route('home');

    }
}
