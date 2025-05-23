<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/join')->as('join.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'JoinController@index')->name('index');
    Route::get('/pending', 'JoinController@pending')->name('pending');
    Route::get('/create', 'JoinController@create')->name('create');
    Route::post('/store', 'JoinController@store')->name('store');
    Route::post('/status', 'JoinController@status')->name('status');
    Route::get('/edit/{join}', 'JoinController@edit')->name('edit');
    Route::post('/update/{join}', 'JoinController@update')->name('update');
    Route::get('/destroy/{join}', 'JoinController@destroy')->name('destroy');
});
