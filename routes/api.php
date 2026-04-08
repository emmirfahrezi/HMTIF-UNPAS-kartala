<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require base_path('routes/api/v1/auth.php');

    Route::prefix('home')->group(base_path('routes/api/v1/home.php'));
    Route::prefix('activities')->group(base_path('routes/api/v1/activity.php'));
    Route::prefix('announcements')->group(base_path('routes/api/v1/announcement.php'));
    Route::prefix('staff')->group(base_path('routes/api/v1/staff.php'));
    Route::prefix('store')->group(base_path('routes/api/v1/store.php'));
    Route::prefix('aspirations')->group(base_path('routes/api/v1/aspiration.php'));
});
