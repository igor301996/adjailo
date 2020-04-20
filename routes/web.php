<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('application')->as('application.')->group(function () {
    Route::middleware('client')->group(function () {
        Route::get('/', 'ApplicationController@index')->name('index');
        Route::get('/create', 'ApplicationController@create')->name('create');
    });
Route::post('/store', 'ApplicationController@store')->name('store');
Route::get('/show/{application}/', 'ApplicationController@show')->name('show');
Route::get('/closed/{application}', 'ApplicationController@closed')->name('action');
});

Route::prefix('message')->as('message.')->group(function () {
    Route::get('/message/{application}/create', 'MessageController@create')->name('create');
    Route::post('/message/{application}/store', 'MessageController@store')->name('store');
});
