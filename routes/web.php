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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'user'], function () {
	Route::get('/configuracion', 'UserController@config')->name('user.config');
	Route::put('/configuracion/update/{id}', 'UserController@updateConfig')->name('user.updateConfig');
	Route::get('/image/{filename}', 'UserController@getImage')->name('user.avatar');
	Route::get('/profile/{id}','UserController@profile')->name('user.profile');
});

Route::group(['prefix' => 'image'], function () {
	Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
	Route::post('/subir-imagen/save', 'ImageController@save')->name('image.save');
	Route::get('/image/{filename}', 'ImageController@getImage')->name('image.file');
	Route::get('/detail/{id}', 'ImageController@details')->name('image.detail');
	Route::post('/detail/comment', 'CommentController@save')->name('comment.save');
	Route::get('/detail/comment/{id}', 'CommentController@delete')->name('comment.delete');
	Route::get('/detail/like/{id}', 'LikeController@like')->name('like.save');
	Route::get('/detail/dislike/{id}', 'LikeController@dislike')->name('like.delete');
});

Route::group(['prefix' => 'likes'], function () {
	Route::get('/', 'LikeController@index')->name('likes.index');
});
