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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
	Route::get('/ideas', 'IdeaController@index');
	Route::get('/ideas/new', 'IdeaController@create');
	Route::post('/ideas', 'IdeaController@store')->name('storeIdea');
	Route::get('/ideas/{idea}', 'IdeaController@show');
	Route::get('/ideas/{idea}/edit', 'IdeaController@edit');
	Route::put('/ideas/{idea}/edit', 'IdeaController@update')->name('updateIdea');
	Route::delete('/ideas', 'IdeaController@destroy')->name('destroyIdea');

	Route::get('/ideas/{idea}/like', 'IdeaController@like');
	Route::get('/ideas/{idea}/dislike', 'IdeaController@dislike');
});
