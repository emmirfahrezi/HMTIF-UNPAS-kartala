<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('can_create')->default(false);
            $table->boolean('can_read')->default(true);
            $table->boolean('can_update')->default(false);
            $table->boolean('can_delete')->default(false);
            $table->json('menu_access')->nullable();
            $table->timestamps();
        });

        $now = now();
        DB::table('roles')->insert([
            ['name' => 'Superadmin', 'can_create' => 1, 'can_read' => 1, 'can_update' => 1, 'can_delete' => 1, 'menu_access' => null, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BPH',        'can_create' => 1, 'can_read' => 1, 'can_update' => 1, 'can_delete' => 1, 'menu_access' => null, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Koordinator','can_create' => 1, 'can_read' => 1, 'can_update' => 1, 'can_delete' => 0, 'menu_access' => null, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Staff',      'can_create' => 1, 'can_read' => 1, 'can_update' => 0, 'can_delete' => 0, 'menu_access' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
