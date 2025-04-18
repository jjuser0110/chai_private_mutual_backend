<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/shop_item')->as('shop_item.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'ShopItemController@index')->name('index');
    Route::get('/create', 'ShopItemController@create')->name('create');
    Route::post('/store', 'ShopItemController@store')->name('store');
    Route::get('/edit/{shop_item}', 'ShopItemController@edit')->name('edit');
    Route::post('/update/{shop_item}', 'ShopItemController@update')->name('update');
    Route::get('/destroy/{shop_item}', 'ShopItemController@destroy')->name('destroy');
});
