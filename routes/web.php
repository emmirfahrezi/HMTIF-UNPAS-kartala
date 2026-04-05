<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/staff', function () {
    return view('pages.staff');
});

Route::get('/activities', function () {
    return view('pages.activities');
});

Route::get('/store', function () {
    return view('pages.store');
});

Route::get('/announcements', function () {
    return view('pages.announcements');
});

Route::get('/announcement-detail', function () {
    return view('pages.announcement-detail');
});

Route::get('/aspirations', function () {
    return view('pages.aspirations');
});

// Dev/Styleguide
Route::get('/dev/components', function () {
    return view('dev.components');
});
