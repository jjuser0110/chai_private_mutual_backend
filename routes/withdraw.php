<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/withdraw')->as('withdraw.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'WithdrawController@index')->name('index');
    Route::get('/pending', 'WithdrawController@pending')->name('pending');
    Route::get('/create', 'WithdrawController@create')->name('create');
    Route::post('/store', 'WithdrawController@store')->name('store');
    Route::get('/edit/{withdraw}', 'WithdrawController@edit')->name('edit');
    Route::post('/update/{withdraw}', 'WithdrawController@update')->name('update');
    Route::get('/destroy/{withdraw}', 'WithdrawController@destroy')->name('destroy');
});
