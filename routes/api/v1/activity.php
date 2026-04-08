<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ActivityController::class, 'index']);
Route::get('/filter', [ActivityController::class, 'filter']);
Route::get('/{slug}', [ActivityController::class, 'show']);
