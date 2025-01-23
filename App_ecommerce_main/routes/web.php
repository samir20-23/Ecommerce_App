<?php

use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('product.index');
})->name('product.index');

//user
Route::get('/product', [ProductController::class, 'index'])->name('home');
// admin
Route::resource('admin', DashboardController::class);
Route::resource('dashboard', DashboardController::class);

