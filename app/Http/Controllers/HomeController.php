<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tweet;
use App\Favorite;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $timeline = Tweet::getTlTweet();

        $my_user = User::find( Auth::id() );
        
        $favtweet = [];
        foreach ($my_user->favorites as $value) {
          $favtweet[ $value->tweet_id ]  = '1';
        }

        return view('home',
        [
            'tweets' => $timeline,
            'favtweet' => $favtweet,
        ]);
    }
}
