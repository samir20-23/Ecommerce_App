<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageProducts;
use App\Http\Controllers\ManageUsers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;




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

// 

// In case you need them explicitly (but resource() already creates these routes):
Route::get('/admin/products/create', [ManageProducts::class, 'create'])->name('admin.products.create');
Route::post('/admin/products', [ManageProducts::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{id}/edit', [ManageProducts::class, 'edit']);
Route::put('/admin/products/{id}', [ManageProducts::class, 'update']);
Route::delete('/admin/products/{id}', [ManageProducts::class, 'destroy'])->name('admin.products.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
