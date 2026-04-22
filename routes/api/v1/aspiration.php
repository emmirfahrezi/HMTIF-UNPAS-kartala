<?php

use App\Http\Controllers\AspirationController;
use Illuminate\Support\Facades\Route;

Route::post('/', [AspirationController::class, 'store']);
Route::get('/spotlight', [AspirationController::class, 'spotlight']);
Route::get('/track/{trackingCode}', [AspirationController::class, 'track']);
Route::get('/track-by-nim/{nim}', [AspirationController::class, 'trackByNim']);
