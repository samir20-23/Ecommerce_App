<?php

use App\Models\Product;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageProducts;
use App\Http\Controllers\ManageUsers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


//user
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/product', [HomeController::class, 'index'])->name('home');
Route::resource('product', HomeController::class);


//serverce
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard.index'); // Redirect to admin dashboard
});
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard.index'); // Redirect to admin dashboard
});
// admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    
    Route::resource('/products', ManageProducts::class);
    Route::resource('/users', ManageUsers::class);
});