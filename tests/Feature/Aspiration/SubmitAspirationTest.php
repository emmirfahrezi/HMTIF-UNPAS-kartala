<?php

use App\Models\Aspiration;
use App\Services\Mail\MailService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->mock(MailService::class, function (MockInterface $mock) {
        $mock->shouldIgnoreMissing();
    });
});

/*
|--------------------------------------------------------------------------
| Test: Form Pengiriman Aspirasi Publik
|--------------------------------------------------------------------------
|
| Memverifikasi keamanan dan validasi form aspirasi publik (/aspirations).
| Form ini dapat diakses tanpa login sehingga penting untuk diuji
| terhadap input kosong, data tidak valid, dan penyimpanan ke database.
|
| Catatan field:
|   - 'tujuan' (required) → disimpan sebagai 'subject' di database
|   - 'pesan'  (required) → disimpan sebagai 'message' di database
|   - 'nama', 'nim', 'email' (semua opsional)
|
*/

it('saves valid aspiration to database and redirects with success indicator', function () {
    $response = $this->post(route('aspirations.store'), [
        'nama' => 'Ahmad Fauzi',
        'nim' => '23552011015',
        'email' => 'ahmad@student.unpas.ac.id',
        'tujuan' => 'Permohonan Perbaikan Proyektor Ruang C4',
        'pesan' => 'Proyektor di ruang C4 sering mati saat digunakan untuk presentasi. Mohon segera diperbaiki.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('aspiration_success', true);
    $response->assertSessionHas('tracking_code');

    // Data tersimpan di database dengan field yang benar
    $this->assertDatabaseHas('aspirations', [
        'subject' => 'Permohonan Perbaikan Proyektor Ruang C4',
        'message' => 'Proyektor di ruang C4 sering mati saat digunakan untuk presentasi. Mohon segera diperbaiki.',
        'status' => 'pending',
    ]);
});

it('saves anonymous aspiration (without name, nim, and email)', function () {
    $response = $this->post(route('aspirations.store'), [
        'tujuan' => 'Aspirasi Anonim tentang Kebersihan Toilet',
        'pesan' => 'Toilet di lantai 3 perlu lebih sering dibersihkan.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('aspiration_success', true);

    $aspiration = Aspiration::where('subject', 'Aspirasi Anonim tentang Kebersihan Toilet')->first();
    expect($aspiration)->not->toBeNull();
    expect($aspiration->name)->toBeNull();
    expect($aspiration->nim)->toBeNull();
    expect($aspiration->email)->toBeNull();
});

it('rejects aspiration when required field tujuan is missing', function () {
    $response = $this->post(route('aspirations.store'), [
        'nama' => 'Budi',
        'pesan' => 'Pesan valid tapi tanpa tujuan.',
        // 'tujuan' missing
    ]);

    $response->assertSessionHasErrors(['tujuan']);
    $this->assertDatabaseCount('aspirations', 0);
});

it('rejects aspiration when required field pesan is missing', function () {
    $response = $this->post(route('aspirations.store'), [
        'nama' => 'Budi',
        'tujuan' => 'Tujuan valid',
        // 'pesan' missing
    ]);

    $response->assertSessionHasErrors(['pesan']);
    $this->assertDatabaseCount('aspirations', 0);
});

it('rejects aspiration when both required fields are empty', function () {
    $response = $this->post(route('aspirations.store'), [
        'nama' => 'Budi',
        'tujuan' => '',
        'pesan' => '',
    ]);

    $response->assertSessionHasErrors(['tujuan', 'pesan']);
});

it('rejects aspiration with invalid email format', function () {
    $response = $this->post(route('aspirations.store'), [
        'email' => 'bukan-email-valid',
        'tujuan' => 'Tujuan valid',
        'pesan' => 'Pesan valid dan cukup panjang.',
    ]);

    $response->assertSessionHasErrors(['email']);
    $this->assertDatabaseCount('aspirations', 0);
});

it('accepts aspiration with no email (optional field)', function () {
    $response = $this->post(route('aspirations.store'), [
        'tujuan' => 'Aspirasi tanpa email',
        'pesan' => 'Ini adalah pesan aspirasi tanpa email.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('aspiration_success');
    $this->assertDatabaseCount('aspirations', 1);
});

it('generates unique tracking code for each aspiration', function () {
    $this->post(route('aspirations.store'), [
        'tujuan' => 'Aspirasi pertama',
        'pesan' => 'Pesan aspirasi pertama untuk test tracking code.',
    ]);

    $this->post(route('aspirations.store'), [
        'tujuan' => 'Aspirasi kedua',
        'pesan' => 'Pesan aspirasi kedua untuk test tracking code.',
    ]);

    $aspirations = Aspiration::all();
    expect($aspirations)->toHaveCount(2);
    expect($aspirations[0]->tracking_code)->not->toBe($aspirations[1]->tracking_code);
});
