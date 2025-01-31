<?php

use App\Models\Product;
use App\Http\Controllers\ManageProducts;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageUsers;
use App\Http\Controllers\ProfileController;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('product.index');
// })->name('product.index');

// any user 
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



// admin
Route::get('/products', [ManageProducts::class, 'index'])->name('home');
Route::resource('products', ManageProducts::class);
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ManageProducts::class);
    Route::resource('users', ManageUsers::class);
});



// 
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ManageProducts::class);
    Route::resource('users', ManageUsers::class);
});
// 
Route::get('/products', [ManageProducts::class, 'index'])->name('products.index');
Route::post('/products', [ManageProducts::class, 'store'])->name('products.store');
Route::get('/admin/products/create', [ManageProducts::class, 'create'])->name('admin.products.create');
Route::get('/admin/products/edit', [ManageProducts::class, 'update'])->name('admin.products.edit');
Route::get('/admin/products/show', [ManageProducts::class, 'show'])->name('admin.products.show');

// 

// Route::resource('categories', CategoryController::class);
Route::resource('products', ManageProducts::class);
Route::delete('products/{product}', [ManageProducts::class, 'destroy'])->name('products.destroy');


// Edit product route
Route::get('products/{product}/edit', [ManageProducts::class, 'edit'])->name('products.edit');

// Show product route
Route::get('products/{product}', [ManageProducts::class, 'show'])->name('products.show');

// Delete product route
Route::delete('products/{product}', [ManageProducts::class, 'destroy'])->name('products.destroy');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
