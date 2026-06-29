<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('minute_attendees', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('minute_id');
            $table->string('name');
            $table->string('nim', 20)->nullable();
            $table->string('jabatan')->nullable();
            $table->enum('keterangan', ['hadir', 'izin', 'alpha'])->default('hadir');
            $table->string('paraf')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('minute_id')->references('id')->on('minutes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minute_attendees');
    }
};
