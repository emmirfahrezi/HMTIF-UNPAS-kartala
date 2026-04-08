<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StaffController::class, 'index']);
Route::get('/divisions', [StaffController::class, 'divisions']);
