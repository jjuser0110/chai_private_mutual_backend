<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->as('user.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'UserController@index')->name('index');
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/store', 'UserController@store')->name('store');
    Route::get('/edit/{user}', 'UserController@edit')->name('edit');
    Route::post('/update/{user}', 'UserController@update')->name('update');
    Route::get('/destroy/{user}', 'UserController@destroy')->name('destroy');
    Route::get('/create_bank/{user}', 'UserController@create_bank')->name('create_bank');
    Route::post('/store_bank/{user}', 'UserController@store_bank')->name('store_bank');
    Route::get('/edit_bank/{user_bank}', 'UserController@edit_bank')->name('edit_bank');
    Route::post('/update_bank/{user_bank}', 'UserController@update_bank')->name('update_bank');
    Route::get('/create_address/{user}', 'UserController@create_address')->name('create_address');
    Route::post('/store_address/{user}', 'UserController@store_address')->name('store_address');
    Route::get('/edit_address/{user_address}', 'UserController@edit_address')->name('edit_address');
    Route::post('/update_address/{user_address}', 'UserController@update_address')->name('update_address');
});
