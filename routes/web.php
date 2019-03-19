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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/discuss', function(){
    return view('discuss');
});

Auth::routes();

Route::get('/forum', 'ForumsController@forum')->name('forum');

Route::get('{provider}/auth', 'SocialsController@auth')->name('social.auth');
Route::get('/{provider}/redirect', 'SocialsController@callback')->name('social.callback');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('channels', 'ChannelsController');

    Route::get('/discussion/create', 'DiscussionsController@create')->name('discussion.create');
    Route::post('/discussion/store', 'DiscussionsController@store')->name('discussion.store');
    Route::get('/discussion/{slug}', 'DiscussionsController@show')->name('discussion');
});

