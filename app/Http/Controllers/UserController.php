<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Follow;


class UserController extends Controller
{
  public function index (Request $request)
  { 	
    $where = [
      ['users.id','<>',Auth::id()]
    ];
    $users = User::where($where)->get();
    $my_user = User::find( Auth::id() );

    $follow_list = [];
    foreach ($my_user->follows as $value) {
      $follow_list[ $value->follow_id ]  = '1';
    }

    return view('user.list',
      [
       'users' => $users,
       'followList' => $follow_list,
     ]);

  }

  public function follow (Request $request)
  {   
    $follow = new Follow;
    $follow->user_id = Auth::id();
    $follow->follow_id = $request->input('followId');
    $follow->save();

    return redirect()->route('user_list');
  }

  public function unfollow (Request $request)
  {
   
    $unfollow = Follow::where('user_id',Auth::id())->where('follow_id',$request->followId);

    $unfollow->delete(); 
 
    return redirect()->route('user_list');
  }

  public function profile ()
  {
    return view('profile');
  }

  public function userProfile (Request $request)
  {
    $userId = $request->input('user_id');
    $userProfile = User::where('id',$userId)->first();


    return view('userProfile',
      [
        'user' => $userProfile,
      ]);
  }

  public function updateProf (Request $request)
  {
        $newProf = [
            'name' => $request->name,
            'nickname' => $request->nickname,
            'profile' => $request->profile,
        ];

        User::where('id',$request->id)
            ->update($newProf);

    return redirect()->route('user_list');
  }
}
