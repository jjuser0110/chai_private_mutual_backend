<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/pending_verify')->as('pending_verify.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'UserController@pending_verify')->name('index');
});
