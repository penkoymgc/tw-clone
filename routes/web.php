<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//トップページ Homeコントローラー 

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


//ツイートを保存する Tweetコントローラー

Route::post('/tweet','TweetController@update');

//ユーザー一覧 Userコントローラー

Route::get('/users','UserController@index')->name('user_list');

//フォローを実行する Userコントローラー

Route::post('/users/follow','UserController@follow');

Route::post('/users/unfollow','UserController@unfollow');

Route::get('/profile','UserController@profile');
Route::post('/profile/update','UserController@updateProf');

Route::get('/userProfile','UserController@userProfile')->name('userProfile');