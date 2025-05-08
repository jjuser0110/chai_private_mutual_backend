<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/booking')->as('booking.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'BookingController@index')->name('index');
    Route::get('/pending', 'BookingController@pending')->name('pending');
    Route::get('/create', 'BookingController@create')->name('create');
    Route::post('/store', 'BookingController@store')->name('store');
    Route::post('/extra', 'BookingController@extra')->name('extra');
    Route::post('/add_countdown', 'BookingController@add_countdown')->name('add_countdown');
    Route::post('/status', 'BookingController@status')->name('status');
    Route::get('/edit/{booking}', 'BookingController@edit')->name('edit');
    Route::post('/update/{booking}', 'BookingController@update')->name('update');
    Route::get('/destroy/{booking}', 'BookingController@destroy')->name('destroy');
});
