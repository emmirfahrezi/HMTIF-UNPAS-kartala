<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoreController::class, 'index']);
Route::get('/categories', [StoreController::class, 'categories']);
Route::get('/{slug}', [StoreController::class, 'show']);
