<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public Routes (User)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/product', [HomeController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');

// Admin Routes
Route::get('/dashboard', function () {
  return redirect()->route('admin.dashboard');
});
Route::get('/admin', function () {
  return redirect()->route('admin.dashboard');
});
// Route::prefix('admin')->name('admin.')->group(function () {

//   //users
//   Route::resource('users', UserController::class);
//   Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
//   //dashboard 
//   Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//   //products
//   Route::resource('products', ProductController::class);
//   Route::get('/products', [ProductController::class, 'index'])->name('products.index');
//   Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
//   Route::get('/products/edit', [ProductController::class, 'update'])->name('products.edit');
//   Route::get('/products/show', [ProductController::class, 'show'])->name('products.show');
//   // Route::get('/products', [ProductController::class, 'create'])->name('admin.products.create');
//   // Route::get('/products', [ProductController::class, 'index'])->name('products.index');

//   // v2
//   Route::get('/products', [ProductController::class, 'index'])->name('home');
//   Route::resource('products', ProductController::class);

//   Route::resource('products', ProductController::class);
//   Route::resource('users', UserController::class);

//   Route::get('/products', [ProductController::class, 'index'])->name('products.index');
//   Route::post('/products', [ProductController::class, 'store'])->name('products.store');
//   Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
//   // v3

//   Route::post('/products', [ProductController::class, 'store'])->name('products.store');
//   Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
//   Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
//   Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
//   Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
// }); 

// Admin Routes Group
Route::prefix('admin')->name('admin.')->group(function () {

  // Dashboard
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  
  // Product Routes
  Route::resource('products', ProductController::class);

  // User Routes (if needed)
  // Route::resource('users', UserController::class);
  // Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
  
  // Profile Routes (if needed)
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
