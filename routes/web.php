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


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('rooms', 'RoomsController')->only([
    'create', 'store'
]);
Route::get('messages', 'RoomsController@fetchMessages');
Route::post('messages', 'RoomsController@sendMessage');
Route::get('rooms/private/{uuid}', 'RoomsController@getPrivateRoom');