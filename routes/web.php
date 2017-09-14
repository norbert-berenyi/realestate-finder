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

Route::get('test', 'DiscordController@test');

Route::get('/', 'AdvertController@index')->name('home');

Route::get('/unseen', 'AdvertController@unseen');
Route::get('/seen', 'AdvertController@seen');
Route::get('/promising', 'AdvertController@promising');
Route::get('/super-promising', 'AdvertController@superPromising');
Route::get('/duplicate', 'AdvertController@duplicate');

Route::post('advert', 'AdvertController@update');
Auth::routes();

