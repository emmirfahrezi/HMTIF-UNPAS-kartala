<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bersihkan tabel staffs:
     * - Hapus kolom github (fitur profil GitHub tidak jadi diimplementasikan)
     * - Hapus kolom user_id (relasi sudah dikelola dari sisi users via users.staff_id)
     */
    public function up(): void
    {
        Schema::table('staffs', function (Blueprint $table) {
            if (Schema::hasColumn('staffs', 'github')) {
                $table->dropColumn('github');
            }

            if (Schema::hasColumn('staffs', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('staffs', function (Blueprint $table) {
            if (! Schema::hasColumn('staffs', 'github')) {
                $table->string('github')->nullable()->after('linkedin');
            }

            if (! Schema::hasColumn('staffs', 'user_id')) {
                $table->string('user_id')->nullable()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            }
        });
    }
};
