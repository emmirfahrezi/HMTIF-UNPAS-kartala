<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.home');
});

Route::get('/pengumuman', function () {
    return view('landing.pengumuman');
});

Route::get('/detail-pengumuman', function () {
    return view('landing.detail-pengumuman');
});
