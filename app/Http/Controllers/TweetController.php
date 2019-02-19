<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tweet;
use App\Reply;

class TweetController extends Controller
{
    public function __construct()
    {
    	$this->Tweet = new \App\Tweet;
    }

    public function create (Request $request)
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

    public function show(Request $request)
    {
        $tweetId = $request->input('tweet_id');
        $tweet = Tweet::where('id',$tweetId)->first();

        $tweetId = $request->input('tweet_id');
        $reply = Reply::where('tweet_id',$tweetId)->get();

        return view('tweetshow',['replies' => $reply,'tweets' => $tweet]);    
    }

    public function reply(Request $request)
    {
        $newreply = new Reply;
        $newreply->user_id = Auth::id();
        $newreply->tweet_id = $request->input('tweet_id');
        $newreply->text = $request->input('text');
        $newreply->save();

        //return redirect()->route('tweetshow');
        return redirect("/tweet/show/?tweet_id=".$newreply->tweet_id);
           
    }

    public function delete(Request $request)
    {
        
        Tweet::destroy(['id' => $request->tweet_id]);

        return redirect("home");
    }
}
