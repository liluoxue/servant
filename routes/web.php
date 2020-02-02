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
Route::get('/home','ServantController@home');

Route::get('/test',function(){
    return view('layouts.app');
});
Route::get('/upload/{dorm}','ServantController@update');
Route::post('/up','UploadController@fileupload')->name('up');
Route::get('/upindex','UploadController@upindex')->name('upindex');
Route:: get('/upyes','UploadController@upyes')->name('upyes');