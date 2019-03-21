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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/{page?}', 'HomeController@index')
    ->where('page', '[0-9]+')
    ->name('home');

Route::get('/tag/{tag_id}/{page?}', 'HomeController@tag')
    ->where('tag_id', '[0-9]+')
    ->where('page', '[0-9]+')
    ->name('tag');

Route::get('/post/{id}', 'PostController@index')
    ->where('id', '[0-9]+')
    ->name('post');

Route::get('/post/editor',
    //function() { return view('editor'); } ) //
      'PostController@editor')
    ->name('editor')
    ->middleware('auth');

Route::post('post/save', 'PostController@save')
    ->name('post_save')
    ->middleware('auth');

Route::post('post/comment', 'PostController@comment')
    ->name('comment')
    ->middleware('auth');
