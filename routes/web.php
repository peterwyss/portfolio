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
Route::get('/photos', 'PhotoController@index');
Route::get('/admin/photo/create', 'PhotoController@create');
Route::get('/admin/photo/show', 'PhotoController@show');
Route::get('/admin/photo/edit/{id}', 'PhotoController@edit');
Route::post('/admin/photo/store', 'PhotoController@store');
Route::patch('admin/photo/update', 'PhotoController@update');
Route::delete('/admin/photo/delete/{id}', 'PhotoController@destroy');

