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

Route::get('/activity-detail', function () {
    return view('pages.activity-detail');
});

Route::get('/product-detail', function () {
    return view('pages.product-detail');
});

Route::get('/aspirations', function () {
    return view('pages.aspirations');
});

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

// Dev/Styleguide
Route::get('/dev/components', function () {
    return view('dev.components');
});
