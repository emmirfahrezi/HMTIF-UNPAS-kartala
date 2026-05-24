<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hapus kolom user_id dari tabel staffs.
     *
     * Relasi antara user dan staff sudah dikelola dari sisi users (users.staff_id → staffs.id),
     * sehingga kolom staffs.user_id redundan dan tidak lagi digunakan.
     */
    public function up(): void
    {
        Schema::table('staffs', function (Blueprint $table) {
            if (Schema::hasColumn('staffs', 'user_id')) {
                // Hapus foreign key terlebih dahulu sebelum drop kolom
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('staffs', function (Blueprint $table) {
            if (! Schema::hasColumn('staffs', 'user_id')) {
                $table->string('user_id')->nullable()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            }
        });
    }
};
