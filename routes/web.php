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

// Get Un-Authenticated Pages
Route::get('/', function(){return view('homepage');})->name('homepage');
Route::get('/How-It-Works', function(){return view('how-it-works');});
Route::get('/Sponsor', function(){return view('sponsor');});
Route::get('/Get-Sponsored', function(){return view('get-sponsored');});
Route::get('/Contact-Us', function(){return view('contact-us');});
Route::get('/Privacy-Policy', function(){return view('privacy-policy');});

//Auth Controller Get
Route::get('/Sign-Up', 'AuthController@getSignUp');
Route::get('/Log-In', 'AuthController@getLogIn');
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
//Route::get('/User/{username}', 'UserController@getUser');
Route::get('/User/{username}', [
    'uses' => 'UserController@getUser',
    'as' => 'User',
    'middleware' => 'auth'
]);

// Image Controller Get
Route::get('resizeImage', 'ImageController@resizeImage');
// Image Controller Post
Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'ImageController@resizeImagePost']);

// Connections Controller Get
Route::get('/Connections', 'ConnectionsController@getConnections');

Auth::routes();

Route::get('/home', function(){return view('homepage');});
Route::get('/homepage', function(){return view('homepage');});
