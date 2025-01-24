<?php

use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageProducts;
use App\Http\Controllers\ManageUsers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('product.index');
// })->name('product.index');

//user
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/home', [ProductController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index'])->name('home');
Route::resource('product', ProductController::class);

// admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ManageProducts::class);
    Route::resource('users', ManageUsers::class);
});
Route::resource('admin', DashboardController::class); 
Route::resource('dashboard', DashboardController::class);
