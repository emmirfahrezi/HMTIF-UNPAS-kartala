<?php

use App\Models\Role;
use App\Models\User;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

/*
|--------------------------------------------------------------------------
| Test: Middleware CheckMenuAccess
|--------------------------------------------------------------------------
|
| Memverifikasi bahwa middleware CheckMenuAccess (Handoff 001) bekerja
| dengan benar — memblokir user yang tidak punya akses menu, dan
| membiarkan admin bypass semua pengecekan.
|
*/

it('blocks staff without menu access from accessing user management', function () {
    // Role 'staff' hanya punya akses ke activities dan announcements
    Role::create([
        'name'        => 'staff',
        'can_read'    => true,
        'can_create'  => false,
        'can_update'  => false,
        'can_delete'  => false,
        'menu_access' => ['activities', 'announcements'],
    ]);

    $staffUser = User::factory()->create(['role' => 'staff']);

    $this->actingAs($staffUser)
         ->get('/dashboard/users')
         ->assertForbidden(); // 403 — tidak punya akses ke 'users'
});

it('blocks staff without menu access from accessing activity logs', function () {
    Role::create([
        'name'        => 'staff',
        'can_read'    => true,
        'can_create'  => false,
        'can_update'  => false,
        'can_delete'  => false,
        'menu_access' => ['activities', 'announcements'],
    ]);

    $staffUser = User::factory()->create(['role' => 'staff']);

    $this->actingAs($staffUser)
         ->get('/dashboard/activity-logs')
         ->assertForbidden(); // 403 — 'activity-logs' tidak ada di menu_access
});

it('allows staff to access menu items they are permitted', function () {
    $this->withoutVite();

    // Hapus role 'Staff' dari migration agar tidak ada konflik pada lookup LOWER(name) = 'staff'
    Role::whereRaw('LOWER(name) = ?', ['staff'])->delete();
    Role::create([
        'name'        => 'staff',
        'can_read'    => true,
        'can_create'  => true,
        'can_update'  => true,
        'can_delete'  => false,
        'menu_access' => ['activities', 'announcements'],
    ]);

    $staffUser = User::factory()->create(['role' => 'staff']);

    // Staff punya akses ke 'activities', jadi tidak boleh dapat 403
    $this->actingAs($staffUser)
         ->get('/dashboard/activities')
         ->assertOk(); // 200 — diizinkan
});

it('always allows any authenticated user to access their own profile', function () {
    $this->withoutVite();

    // Role tanpa akses sama sekali
    Role::create([
        'name'        => 'koordinator',
        'can_read'    => true,
        'can_create'  => false,
        'can_update'  => false,
        'can_delete'  => false,
        'menu_access' => [], // tidak ada akses sama sekali
    ]);

    $user = User::factory()->create(['role' => 'koordinator']);

    // Profile selalu diizinkan (hardcoded di middleware)
    $this->actingAs($user)
         ->get('/dashboard/profile')
         ->assertOk();
});

it('blocks user with unconfigured role from accessing dashboard pages', function () {
    // Hapus role 'BPH' dari migration agar tidak ada record di tabel roles untuk role ini
    // (users.role adalah enum, jadi kita pakai nilai valid tapi tanpa Role record di DB)
    Role::whereRaw('LOWER(name) = ?', ['bph'])->delete();

    $user = User::factory()->create(['role' => 'bph']);

    $this->actingAs($user)
         ->get('/dashboard/activities')
         ->assertForbidden(); // Role tidak ditemukan → 403
});

it('allows admin to bypass all route checks including user management', function () {
    $this->withoutVite();

    $adminUser = User::factory()->create(['role' => 'admin']);

    // Admin tidak perlu Role record — isAdmin() cek langsung $user->role === 'admin'
    $this->actingAs($adminUser)
         ->get('/dashboard/users')
         ->assertOk();
});

it('allows admin to access all dashboard pages without role configuration', function () {
    $this->withoutVite();

    $adminUser = User::factory()->create(['role' => 'admin']);

    // Test beberapa halaman sekaligus
    $this->actingAs($adminUser)->get('/dashboard/activities')->assertOk();
    $this->actingAs($adminUser)->get('/dashboard/settings')->assertOk();
    $this->actingAs($adminUser)->get('/dashboard/aspirations')->assertOk();
});
