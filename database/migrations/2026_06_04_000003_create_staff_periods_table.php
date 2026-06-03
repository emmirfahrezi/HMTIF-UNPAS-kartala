<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_periods', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('period_id');
            $table->string('staff_id');
            $table->string('division_id');
            $table->string('position');
            $table->integer('order')->default(0);
            $table->boolean('is_bph')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['period_id', 'staff_id']);

            $table->foreign('period_id')->references('id')->on('periods')->cascadeOnDelete();
            $table->foreign('staff_id')->references('id')->on('staffs')->cascadeOnDelete();
            $table->foreign('division_id')->references('id')->on('divisions')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_periods');
    }
};
