<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/invitation_code')->as('invitation_code.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'InviteCodeController@index')->name('index');
    Route::get('/generate', 'InviteCodeController@generate')->name('generate');
    // Route::post('/store', 'InviteCodeController@store')->name('store');
    // Route::get('/edit/{invitation_code}', 'InviteCodeController@edit')->name('edit');
    // Route::post('/update/{invitation_code}', 'InviteCodeController@update')->name('update');
    Route::get('/destroy/{invitation_code}', 'InviteCodeController@destroy')->name('destroy');
});
