<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| uses() menentukan TestCase yang digunakan untuk setiap direktori test.
| Kelas TestCase ini sudah mengextend Laravel's base TestCase sehingga
| semua fungsi Laravel (database, HTTP, auth, dsb.) tersedia.
|
*/

uses(Tests\TestCase::class)->in('Feature', 'Architecture');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendefinisikan custom expectations yang dapat
| digunakan kembali di seluruh test suite Anda.
|
*/

// expect()->extend('toBeOne', function () {
//     return $this->toBe(1);
// });

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendefinisikan fungsi helper khusus untuk test.
|
*/
