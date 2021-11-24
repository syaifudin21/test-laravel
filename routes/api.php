<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'user'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::post('tracer', 'TracerController@store');

});

Route::get('tracer_study', 'TracerController@number1');

//soal nomor 234
Route::group(['prefix' => 'tracer'], function ($router) {
    Route::get('', 'TracerController@index');
    Route::post('', 'TracerController@store');
    Route::get('{id}', 'TracerController@show');
    Route::patch('{id}', 'TracerController@update');
    Route::delete('{id}', 'TracerController@delete');
});


