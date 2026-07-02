<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('staffs', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('division_id');
            $table->string('name');
            $table->string('position');
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_bph')->default(false);
            $table->timestamps();

            $table->foreign('division_id')->references('id')->on('divisions')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
