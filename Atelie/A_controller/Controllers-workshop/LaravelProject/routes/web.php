<?php

use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('photos', PhotoController::class)->withTrashed();

// Route::resource('photos', PhotoController::class)->only(['index', 'create']);

// Route::resource('photos', PhotoController::class)->except(['store', 'update']);

// Route::resource('photos', PhotoController::class)
//         ->missing(function (Request $request) {
//             return Redirect::route('photos.index');
//         });

Route::post('photos/{id}/restore', [PhotoController::class, 'restore'])->name('photos.restore');
