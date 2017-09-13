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
Route::get('/','CardController@index');

Auth::routes();
Route::group(['middleware' => 'revalidate'], function(){
	
Route::get('/home', 'HomeController@index');//Logged in dashboard

Route::get('pages','UserController@index');//View all Users

//Editing User Profile
Route::get('profile/{user}','UserController@showUserProf')->name('Profile');//Show user profile

Route::get('pages/{user}','UserController@show');//Show user

Route::patch('pages/{user}','UserController@update')->name('EProfile');//Update User Profile

Route::get('delete&{id}','UserController@destroy')->name('DeleteUser');//Delete User

Route::get('MyProfile/{user}','UserController@edit')->name('EditMyProfile');//Edit my Profile

Route::patch('MyProfile/{user}','UserController@updateMyProfile');//Update User Profile in Edit MyProfile

//Create or Edit cards
Route::get('myCards/{user}','CardController@showMyCard')->name('MyCards');//Show my Cards

Route::post('/create','CardController@store');//Create a card

Route::get('/create','CardController@create');//Display register card

Route::get('myCards/editcard/{card}','CardController@edit');//Display edit card

Route::patch('myCards/editcard/{card}','CardController@update')->name('EditCard');//Edit card

Route::get('/deletec&{id}','CardController@destroy')->name('DeleteCard');//Delete card
});

//Displaying Card
Route::get('cards/{card}','CardController@show');//Display card

Route::get('/follower/{id}','FollowerController@show')->name('Follower');//Display follower

Route::get('/createfollower','FollowerController@store')->name('CreateFollower');//Register Guest to following table

Route::post('/notifyme/{id}','UserController@addNoti')->name('Noti');//Register Auth user to following table

Route::get('/unfollow/{id}','UserController@unfollow')->name('Unfollow');//Unfollow event

Route::get('/help','PageController@help')->name('HelpPage');//help page

Route::get('/about','PageController@about')->name('AboutPage');//about page

Route::get('/markAsRead','FollowerController@markAsRead');

Route::get('/testdate','FollowerController@index');

// Route::get('/markAsRead',function(){
// 	auth()->user()->unreadNotifications->markAsRead();
// });