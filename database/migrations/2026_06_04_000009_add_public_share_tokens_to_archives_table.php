<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->string('share_token', 64)->nullable()->unique()->after('share_expires_at');
            $table->string('short_code', 10)->nullable()->unique()->after('share_token');
        });

        // Backfill token untuk arsip yang sudah ada
        DB::table('archives')->whereNull('share_token')->orderBy('id')->each(function ($archive) {
            DB::table('archives')->where('id', $archive->id)->update([
                'share_token' => Str::random(64),
                'short_code'  => Str::lower(Str::random(8)),
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->dropUnique(['share_token']);
            $table->dropUnique(['short_code']);
            $table->dropColumn(['share_token', 'short_code']);
        });
    }
};
