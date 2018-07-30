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

Route::name('root_path')->get('/', "UrlsController@create");
Route::name('createUrlShortened_path')->post('/', "UrlsController@store");

Route::name('result_path')->get('/{shortUrl}', "UrlsController@show");

