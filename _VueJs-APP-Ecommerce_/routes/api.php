<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);          // List all products
Route::get('/products/{product}', [ProductController::class, 'show']);   // Show one product
Route::post('/products', [ProductController::class, 'store']);           // Create a new product
Route::put('/products/{product}', [ProductController::class, 'update']);   // Update an existing product
Route::delete('/products/{product}', [ProductController::class, 'destroy']);// Delete a product
