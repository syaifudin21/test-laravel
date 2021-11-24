<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('account', 'AuthController@me');
});

//jawaban soal nomor 1
Route::get('tracer_study', 'TracerController@number1');

//jawaban soal nomor 234
Route::group(['prefix' => 'tracer'], function ($router) {
    Route::get('', 'TracerController@index'); 
    Route::post('', 'TracerController@store'); // nomor 2
    Route::get('{id}', 'TracerController@show');
    Route::patch('{id}', 'TracerController@update'); // nomor 3
    Route::delete('{id}', 'TracerController@delete'); // nomor 4
});


