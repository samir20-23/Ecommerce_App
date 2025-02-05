<?php

use App\Models\Product;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\ManageProducts;
use App\Http\Controllers\ManageUsers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


//user
// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/product', [HomeController::class, 'index'])->name('home');
// Route::resource('product', HomeController::class);


// //serverce
// Route::get('/admin', function () {
//     return redirect()->route('admin.dashboard.index'); // Redirect to admin dashboard
// });
// Route::get('/dashboard', function () {
//     return redirect()->route('admin.dashboard.index'); // Redirect to admin dashboard
// });
// admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Route::resource('/dashboard', DashboardController::class);
    
    // Route::resource('/products', ManageProducts::class);
    // Route::resource('/users', ManageUsers::class);

    // vuejs 
  // routes/api.php
// Route::get('/products', [ManageProducts::class, 'index']);  // For listing products
// Route::post('/products', [ManageProducts::class, 'store']);  // For creating a new product
// Route::delete('/products/{id}', [ManageProducts::class, 'destroy']);  // For deleting a product
// Route::put('/products/{id}', [ManageProducts::class, 'update']);  // For updating a product
// Route::get('/products/{id}', [ManageProducts::class, 'show']);  // For viewing a single product

});
 
// Route::get('/products', [ProductController::class, 'index']);  // Display products
// Route::post('/products', [ProductController::class, 'store']);  // Create a new product
// Route::put('/products/{id}', [ProductController::class, 'update']);  // Update a product
// Route::delete('/products/{id}', [ProductController::class, 'destroy']);  // Delete a product
// Route::get('/products/{id}', [ProductController::class, 'show']);  // Show a single product
//  

// Admin panel routes

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
