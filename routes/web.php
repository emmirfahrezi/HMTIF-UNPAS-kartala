<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/pengurus', function () {
    return view('pages.pengurus');
});

Route::get('/kegiatan', function () {
    return view('pages.kegiatan');
});

Route::get('/store', function () {
    return view('pages.store');
});

Route::get('/pengumuman', function () {
    return view('pages.pengumuman');
});

Route::get('/detail-pengumuman', function () {
    return view('pages.detail-pengumuman');
});

Route::get('/aspirasi', function () {
    return view('pages.aspirasi');
});

// Dev/Styleguide
Route::get('/dev/komponen', function () {
    return view('dev.komponen');
});
