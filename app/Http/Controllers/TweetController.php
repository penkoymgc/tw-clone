<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tweet;
use App\Reply;
use App\Favorite;

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

    public function show(Request $request)
    {
        $tweetId = $request->input('tweet_id');
        $tweet = Tweet::where('id',$tweetId)->first();

        $tweetId = $request->input('tweet_id');
        $reply = Reply::where('tweet_id',$tweetId)->get();

        $favtweet = Favorite::where('tweet_id',$tweetId)->where('user_id',Auth::id())->get()->toArray();

        return view('tweetshow',
            [
                'replies' => $reply,
                'tweets' => $tweet,
                'favtweet' => $favtweet,
            ]);    
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
        $deletetweet = Tweet::where('user_id',Auth::id())->where('id',$request->tweet_id);

        $deletetweet->delete(); 

        return redirect()->route('home');
    }

    public function favorite(Request $request)
    {
        $favorite = new Favorite;
        $favorite->user_id = Auth::id();
        $favorite->tweet_id = $request->input('tweet_id');
        $favorite->save();

        $nextpage = $request->input('nextpage');

        if($nextpage == "tweetshow"){
          return redirect("/tweet/show/?tweet_id=".$request->input('tweet_id'));
        } else {
            return redirect()->route($nextpage);
        }

    }

    public function unfavorite (Request $request)
    {

        $unfavorite = Favorite::where('user_id',Auth::id())->where('tweet_id',$request->tweet_id);

        $unfavorite->delete(); 

        $nextpage = $request->input('nextpage');

        if($nextpage == "tweetshow"){
          return redirect("/tweet/show/?tweet_id=".$request->input('tweet_id'));
        } else {
            return redirect()->route($nextpage);
        }
    }

}
