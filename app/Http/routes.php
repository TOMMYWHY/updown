<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','IndexController@index')->name('home');

Route::get('/up','UpController@index')->name('up');
Route::any('/up/upload','UpController@upload')->name('upload');


Route::get('/down','DownController@index')->name('down');
Route::any('/down/download','DownController@download')->name('download');
Route::any('/down/verifyCode','DownController@verifyCode')->name('verifyCode');