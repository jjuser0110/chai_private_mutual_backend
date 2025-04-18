<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home_banner', [App\Http\Controllers\HomeController::class, 'home_banner'])->name('home_banner');
Route::post('/home_banner_store', [App\Http\Controllers\HomeController::class, 'home_banner_store'])->name('home_banner_store');
Route::get('/shop_banner', [App\Http\Controllers\HomeController::class, 'shop_banner'])->name('shop_banner');
Route::post('/shop_banner_store', [App\Http\Controllers\HomeController::class, 'shop_banner_store'])->name('shop_banner_store');
Route::get('/image_destroy/{banner}', [App\Http\Controllers\HomeController::class, 'image_destroy'])->name('image_destroy');
Route::get('/product_banner', [App\Http\Controllers\HomeController::class, 'product_banner'])->name('product_banner');
Route::post('/product_banner_store', [App\Http\Controllers\HomeController::class, 'product_banner_store'])->name('product_banner_store');
Route::post('/change_password', [App\Http\Controllers\HomeController::class, 'change_password'])->name('change_password');