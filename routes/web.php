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

Route::get('/', 'AdvertController@index');

Route::get('/reports/{year}/{month}/{day}', 'AdvertController@report');

Route::get('/reports/download/{year}/{month}/{day}', 'AdvertController@download');

