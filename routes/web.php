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

Route::get('/channel/{slug}', 'ForumsController@channel')->name('channel');

Route::get('/discussion/{slug}', 'DiscussionsController@show')->name('discussion');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('channels', 'ChannelsController');

    Route::get('/discussion/create/new', 'DiscussionsController@create')->name('discussion.create');
    Route::get('/discussion/edit/{discussion}', 'DiscussionsController@edit')->name('discussion.edit');
    Route::post('/discussion/update/{discussion}', 'DiscussionsController@update')->name('discussion.update');
    Route::post('/discussion/store', 'DiscussionsController@store')->name('discussion.store');
    Route::post('/discussion/reply/{id}', 'DiscussionsController@reply')->name('discussion.reply');

    Route::get('/reply/{id}/likeOrDislike/{num}', 'RepliesController@likeOrDislike')->name('reply.likeOrDislike');
    Route::get('/reply/edit/{reply}', 'RepliesController@edit')->name('reply.edit');
    Route::post('/reply/update/{reply}', 'RepliesController@update')->name('reply.update');

    Route::get('/discussion/watch/{id}', 'WatchersController@watch')->name('discussion.watch');
    Route::get('/discussion/unwatch/{id}', 'WatchersController@unwatch')->name('discussion.unwatch');

    Route::get('/discussion/best/answer/{reply}', 'RepliesController@bestAnswer')->name('discussion.best.answer');
});

