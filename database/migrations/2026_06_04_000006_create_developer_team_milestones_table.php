<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('developer_team_milestones', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('period_id');
            $table->string('period_label')->default('');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('planned'); // done | current | planned
            $table->integer('display_order')->default(0);
            $table->timestamps();

            $table->foreign('period_id')->references('id')->on('periods')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('developer_team_milestones');
    }
};
