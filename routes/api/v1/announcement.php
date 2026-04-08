<?php

use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AnnouncementController::class, 'index']);
Route::get('/categories', [AnnouncementController::class, 'categories']);
Route::get('/{slug}', [AnnouncementController::class, 'show']);
