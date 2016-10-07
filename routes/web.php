<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();
Route::get('/home', function(){return view('homepage');});
Route::get('/homepage', function(){return view('homepage');});

// Get Un-Authenticated Pages
Route::get('/', function(){return view('homepage');})->name('homepage');
Route::get('/How-It-Works', function(){return view('how-it-works');});
Route::get('/Sponsor', function(){return view('sponsor');});
Route::get('/Get-Sponsored', function(){return view('get-sponsored');});
Route::get('/Contact-Us', function(){return view('contact-us');});
Route::get('/Privacy-Policy', function(){return view('privacy-policy');});

//Auth Controller Get
Route::get('/Sign-Up', [
  'uses' => 'AuthController@getSignUp',
  'middleware' => 'guest'
]);
Route::get('/Log-In', [
  'uses' => 'AuthController@getLogIn',
  'middleware' => 'guest'
]);
Route::get('/Log-Out', [
    'uses' => 'AuthController@getLogout',
    'as' => 'logout'
]);
//Auth Controller Post
Route::post('/Sign-Up', [
    'uses' => 'AuthController@postSignUp',
    'as' => 'Sign-Up'
]);
Route::post('/Log-In', [
    'uses' => 'AuthController@postSignIn',
    'as' => 'Log-In'
]);

// User Controller Get
Route::get('/User/{username}', [
    'uses' => 'UserController@getUser',
    'as' => 'User',
    'middleware' => 'auth'
]);
Route::post('/wysiwyg', [
  'uses' => "UserController@postSaveWYSIWYG",
  'as' => 'wysiwyg',
]);
Route::post('/Message/Send', [
  'uses' => "UserController@postSendPM",
  'as' => 'sendPM',
]);
Route::post('/Message/Send', [
  'uses' => "MessageController@postSendMsg",
  'as' => 'sendMsg',
]);
Route::post('/Picture/Select', [
  'uses' => "UserController@postSelectPic",
  'as' => 'selectPic',
]);
Route::post('/Picture/Delete', [
  'uses' => "UserController@postDeletePic",
  'as' => 'deletePic',
]);

// Image Controller Get
Route::get('resizeImage', 'ImageController@resizeImage');
// Image Controller Post
Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'ImageController@resizeImagePost']);

// Connections Controller Get
Route::get('/Connections', 'ConnectionsController@getConnections');
// Connections Controller Post
Route::post('/Connections', [
  'uses' => 'ConnectionsController@postSearchConnections',
  'as' => 'searchConnections'
]);

// Messages Controller Get
Route::get('/Messages/{username}', [
  'uses' => 'MessageController@getMessages',
  'as' => 'Messages',
  'middleware' => 'page.owner',
]);
// Messages Controller Post
Route::post('/Message/Post', [
  'uses' => "MessageController@postSendMsgTo",
  'as' => 'sendMsgTo',
]);
Route::post('/Message/Reply', [
  'uses' => "MessageController@postSendReply",
  'as' => 'sendReply',
]);
Route::post('/Message/DeleteReply', [
  'uses' => "MessageController@postDeleteReply",
  'as' => 'deleteReply',
]);

// Sponsorship Advert Controller Get
Route::get('Sponsorship-Feed', [
  'uses' => 'FeedController@getSelectSponsorshipPage',
  'as' => 'selectSponsorshipPage'
]);
// Sponsorship Advert Controller Post
// Route::post('Sponsorship-Feed/Search-Adverts', [
//   'uses' => 'FeedController@postSearchAdverts',
//   'as' => 'searchAdverts'
// ]);
Route::post('Sponsorship-Feed', [
  'uses' => 'FeedController@postSponsorshipAdverts',
  'as' => 'searchAdverts'
]);

// Friends Controller Post
Route::post('Add-Connection', [
  'uses' => 'FriendController@postSendRequest',
]);
Route::post('Accept-Connection', [
  'uses' => 'FriendController@postAcceptRequest',
]);
Route::post('Reject-Connection', [
  'uses' => 'FriendController@postRejectRequest',
]);

// Notification Controller Get
Route::get('Notifications/{username}', [
  'uses' => 'NotificationController@getNotifications',
]);
