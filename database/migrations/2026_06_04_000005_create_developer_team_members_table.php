<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('developer_team_members', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('period_id');
            $table->string('name');
            $table->string('role');
            $table->string('division')->nullable();
            $table->string('photo')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();

            $table->foreign('period_id')->references('id')->on('periods')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('developer_team_members');
    }
};
