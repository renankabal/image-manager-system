<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@getIndex');
Route::get('login', 'HomeController@getLogin');
Route::get('register', 'HomeController@getRegister');
Route::post('register', 'HomeController@postRegister');
Route::post('login', 'HomeController@postLogin');
Route::post('upload', 'PhotoController@post_upload');
Route::get('logout', 'HomeController@logout');
Route::get('albums', 'AlbumsController@viewAllAlbums');
Route::get('/photo/{id}', 'PhotoController@viewDetails');

Route::group(array('before' => 'auth'), function(){

    Route::get('admin', 'AdminController@getIndex');
    Route::get('albums/create', 'AlbumsController@getCreate');
    Route::post('albums/create', 'AlbumsController@postCreate');
    Route::get('albums/{id}/edit', 'AlbumsController@getEdit');
    Route::put('albums/{id}/edit', 'AlbumsController@putEdit');
    Route::get('albums/{id}/delete', 'AlbumsController@delete');
    Route::get('albums/own', 'AlbumsController@viewOwnAlbums');
    Route::post('comments/{id}/photo', 'CommentsController@postPhotoComment');
    Route::post('comments/{id}/album', 'CommentsController@postAlbumComment');
    Route::post('votes/{id}', 'VotesController@vote');
});

Route::get('albums/{id}', 'AlbumsController@viewPhotos');