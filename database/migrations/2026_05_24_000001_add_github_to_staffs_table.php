<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migrasi ini dibatalkan — fitur github dihapus dari scope.
// File dipertahankan agar tidak merusak environment yang sudah menjalankannya.
// Lihat: 2026_05_24_000002_remove_github_from_staffs_table.php
return new class extends Migration
{
    public function up(): void
    {
        // no-op — kolom github tidak jadi ditambahkan
    }

    public function down(): void
    {
        // no-op
    }
};
