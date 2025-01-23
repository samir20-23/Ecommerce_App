<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorsController;

Route::get('/visitors', [VisitorsController::class, 'display']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ninjas', function () {
    $ninjas = [
        ['name' => 'Mario', 'skill' => 75, 'id' => 1],
        ['name' => 'Luigi', 'skill' => 80, 'id' => 2]
    ];

    return view('ninjas.index', ['ninjas' => $ninjas]);
});

Route::get('/ninjas/create', function () {
    return view('ninjas.create');
});

Route::get('/ninjas/{id}', function ($id) {

    return view('ninjas.show', ['id'=>$id]);
});