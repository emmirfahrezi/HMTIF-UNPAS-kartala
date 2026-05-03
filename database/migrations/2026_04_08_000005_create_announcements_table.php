<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('announcement_category_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->string('thumbnail')->nullable();
            $table->string('file')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->foreign('announcement_category_id')->references('id')->on('announcement_categories')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
