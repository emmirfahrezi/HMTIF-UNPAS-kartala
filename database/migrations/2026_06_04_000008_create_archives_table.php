<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('type');                          // general_letter | lpj | proposal | nota
            $table->string('division_id')->nullable();
            $table->string('file_path');
            $table->string('file_name');
            $table->string('mime_type')->default('application/pdf');
            $table->unsignedBigInteger('file_size')->default(0);
            $table->boolean('share_enabled')->default(false);
            $table->timestamp('share_expires_at')->nullable();
            $table->timestamps();

            $table->foreign('division_id')
                ->references('id')
                ->on('divisions')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
