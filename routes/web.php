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
Route::get('/photos', 'PhotoController@index')->name('photos');
Route::get('/admin/photo/create', 'PhotoController@create')->name('photo.create');
Route::get('/admin/photo/show', 'PhotoController@show')->name('photo.show');
Route::get('/admin/photo/edit/{id}', 'PhotoController@edit');
Route::post('/admin/photo/store', 'PhotoController@store');
Route::patch('admin/photo/update', 'PhotoController@update');
Route::delete('/admin/photo/delete/{id}', 'PhotoController@destroy');

Route::get('/admin/video/create/{page}', 'VideoController@create');
Route::post('/admin/video/store', 'VideoController@store');
Route::get('/admin/video/edit/', 'VideoController@edit');
Route::post('admin/video/update', 'VideoController@update');
Route::get('/videos/{page}', 'VideoController@index');
Route::post('/admin/video/delete', 'VideoController@destroy');

Route::get('/admin/config/create', 'ConfigController@create');
Route::post('/admin/config/store', 'ConfigController@store');

Route::get('mail', function(){
    return view('mail');
});


