<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('application')->as('application.')->group(function () {
    Route::get('/', 'ApplicationController@index')->name('index');
    Route::get('/action/{application}/{status}', 'ApplicationController@action')->name('action');
    Route::get('/show/{application}', 'ApplicationController@show')->name('show');
    Route::get('/filter/{filter}/{type}', 'ApplicationController@filter')->name('filter');
});
