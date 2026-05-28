<?php

/*
|--------------------------------------------------------------------------
| Architecture Tests
|--------------------------------------------------------------------------
|
| Menjaga standar kualitas dan kerapian kode secara otomatis.
| Test ini akan gagal jika ada kode debug (dd, dump) yang tertinggal
| atau pelanggaran arsitektur lainnya.
|
*/

/**
 * Pastikan tidak ada fungsi debug yang tersisa di kode produksi.
 * dd(), dump(), var_dump(), ray() harus dihapus sebelum commit.
 */
test('production code does not contain debugging statements')
    ->expect(['dd', 'dump', 'var_dump', 'ray'])
    ->not->toBeUsed();

/**
 * Pastikan semua Model dan Controller tidak menggunakan trait GeneratesId secara tidak sengaja.
 * (Hanya model yang seharusnya punya GeneratesId.)
 */
test('controllers do not use GeneratesId trait')
    ->expect('App\Http\Controllers')
    ->not->toUse('App\Traits\GeneratesId');

/**
 * Pastikan semua Model menggunakan Eloquent Model.
 */
test('models extend eloquent model')
    ->expect('App\Models')
    ->toExtend('Illuminate\Database\Eloquent\Model');

/**
 * Pastikan Services tidak mengimport class dari Http\Controllers.
 * Services harus bebas dari dependency ke layer Controller (clean architecture).
 */
test('services do not depend on controllers')
    ->expect('App\Services')
    ->not->toUse('App\Http\Controllers');
