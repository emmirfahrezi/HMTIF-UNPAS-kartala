<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('developer_team_members', function (Blueprint $table) {
            $table->string('staff_id')->nullable()->after('period_id');

            $table->foreign('staff_id')
                ->references('id')
                ->on('staffs')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('developer_team_members', function (Blueprint $table) {
            $table->dropForeign(['staff_id']);
            $table->dropColumn('staff_id');
        });
    }
};
