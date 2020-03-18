<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Mail\NewUserWelcomeMail;
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
Auth::routes();

Route::get('/email', function(){
    return new NewUserWelcomeMail();
});
Route::get('/', function () {
    return view('home');
});

Route::post('follow/{user}', 'FollowsController@store');

Route::get('/posts', 'PostsController@index');

// Route::get('/', 'PostsController@index');
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('/p/create', 'PostsController@create');
Route::get('/p/{post}', 'PostsController@show');

Route::post('/p', 'PostsController@store');
