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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'user'], function () {
	Route::get('/configuracion', 'UserController@config')->name('user.config')->middleware('auth');
	Route::put('/configuracion/update/{id}', 'UserController@updateConfig')->name('user.updateConfig')->middleware('auth');
	Route::get('/image/{filename}', 'UserController@getImage')->name('user.avatar');
});


Route::group(['prefix' => 'image'], function () {
	Route::get('/subir-imagen', 'ImageController@create')->name('image.create')->middleware('auth');
	Route::post('/subir-imagen/save', 'ImageController@save')->name('image.save');
});
