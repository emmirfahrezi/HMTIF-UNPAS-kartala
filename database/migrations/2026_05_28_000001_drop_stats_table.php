<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hapus tabel stats.
     * Fitur Statistik manual ditiadakan; data kini dihitung secara dinamis
     * dari model yang sudah ada (Staff, Activity, Division).
     */
    public function up(): void
    {
        Schema::dropIfExists('stats');
    }

    public function down(): void
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('label');
            $table->string('value');
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }
};
