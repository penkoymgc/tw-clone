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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/tweet','TweetController@update');
Route::get('/tweet/show','TweetController@show')->name('tweetshow');
Route::post('/tweet/reply','TweetController@reply');
Route::post('/tweet/delete','TweetController@delete')->name('tweetdelete');


Route::get('/users','UserController@index')->name('user_list');


Route::post('/users/follow','UserController@follow');

Route::post('/users/unfollow','UserController@unfollow');

Route::get('/profile','UserController@profile');
Route::post('/profile/update','UserController@updateProf');

Route::get('/userProfile','UserController@userProfile')->name('userProfile');