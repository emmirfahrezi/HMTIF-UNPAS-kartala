<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nim', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->string('tracking_code', 16)->unique();
            $table->enum('status', ['pending', 'reviewed', 'resolved'])->default('pending');
            $table->boolean('is_spotlight')->default(false);
            $table->date('spotlighted_week')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirations');
    }
};
