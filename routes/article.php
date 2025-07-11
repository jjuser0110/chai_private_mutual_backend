<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/article')->as('article.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'ArticleController@index')->name('index');
    Route::get('/create', 'ArticleController@create')->name('create');
    Route::post('/store', 'ArticleController@store')->name('store');
    Route::get('/edit/{article}', 'ArticleController@edit')->name('edit');
    Route::post('/update/{article}', 'ArticleController@update')->name('update');
    Route::get('/destroy/{article}', 'ArticleController@destroy')->name('destroy');
});
