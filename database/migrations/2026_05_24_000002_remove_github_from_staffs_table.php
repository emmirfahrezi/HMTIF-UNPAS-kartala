<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hapus kolom github dari tabel staffs.
     * Fitur profil GitHub dihapus dari scope aplikasi.
     */
    public function up(): void
    {
        Schema::table('staffs', function (Blueprint $table) {
            if (Schema::hasColumn('staffs', 'github')) {
                $table->dropColumn('github');
            }
        });
    }

    public function down(): void
    {
        Schema::table('staffs', function (Blueprint $table) {
            if (! Schema::hasColumn('staffs', 'github')) {
                $table->string('github')->nullable()->after('linkedin');
            }
        });
    }
};
