<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hapus kolom spotlight dari tabel aspirations.
     * Fitur Spotlight Aspirasi Mingguan ditiadakan dari scope aplikasi.
     */
    public function up(): void
    {
        Schema::table('aspirations', function (Blueprint $table) {
            if (Schema::hasColumn('aspirations', 'is_spotlight')) {
                $table->dropColumn('is_spotlight');
            }

            if (Schema::hasColumn('aspirations', 'spotlighted_week')) {
                $table->dropColumn('spotlighted_week');
            }
        });
    }

    public function down(): void
    {
        Schema::table('aspirations', function (Blueprint $table) {
            if (! Schema::hasColumn('aspirations', 'is_spotlight')) {
                $table->boolean('is_spotlight')->default(false);
            }

            if (! Schema::hasColumn('aspirations', 'spotlighted_week')) {
                $table->date('spotlighted_week')->nullable();
            }
        });
    }
};
