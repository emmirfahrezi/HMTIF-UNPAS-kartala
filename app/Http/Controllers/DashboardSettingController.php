<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class DashboardSettingController extends Controller
{
    const MENU_ITEMS = [
        ['key' => 'dashboard',        'label' => 'Dashboard',      'type' => 'root'],
        ['key' => 'konten',           'label' => 'Konten',         'type' => 'category'],
        ['key' => 'home-sections',    'label' => 'Halaman Utama',  'type' => 'item', 'parent' => 'konten'],
        ['key' => 'activities',       'label' => 'Kegiatan',       'type' => 'item', 'parent' => 'konten'],
        ['key' => 'announcements',    'label' => 'Pengumuman',     'type' => 'item', 'parent' => 'konten'],
        ['key' => 'organisasi',       'label' => 'Organisasi',     'type' => 'category'],
        ['key' => 'staffs',           'label' => 'Pengurus',       'type' => 'item', 'parent' => 'organisasi'],
        ['key' => 'staffs/divisions', 'label' => 'Divisi',         'type' => 'item', 'parent' => 'staffs'],
        ['key' => 'aspirations',      'label' => 'Aspirasi',       'type' => 'item', 'parent' => 'organisasi'],
        ['key' => 'minutes',          'label' => 'Notulensi',      'type' => 'item', 'parent' => 'organisasi'],
        ['key' => 'store',            'label' => 'Store',          'type' => 'category'],
        ['key' => 'products',         'label' => 'Produk',         'type' => 'item', 'parent' => 'store'],
        ['key' => 'pengaturan',       'label' => 'Pengaturan',     'type' => 'category'],
        ['key' => 'activity-logs',    'label' => 'Log Aktivitas',  'type' => 'item', 'parent' => 'pengaturan'],
        ['key' => 'stats',            'label' => 'Statistik',      'type' => 'item', 'parent' => 'pengaturan'],
        ['key' => 'users',            'label' => 'Pengguna',       'type' => 'item', 'parent' => 'pengaturan'],
        ['key' => 'settings',         'label' => 'Sistem Settings','type' => 'item', 'parent' => 'pengaturan'],
    ];

    public function index()
    {
        $roles     = Role::all();
        $menuItems = self::MENU_ITEMS;

        return view('dashboard.settings.index', compact('roles', 'menuItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        Role::create([
            'name'       => $request->name,
            'can_create' => $request->boolean('perm_create'),
            'can_read'   => $request->boolean('perm_read'),
            'can_update' => $request->boolean('perm_update'),
            'can_delete' => $request->boolean('perm_delete'),
        ]);

        return redirect()->route('dashboard.settings.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'field' => 'required|in:can_create,can_read,can_update,can_delete',
            'value' => 'required|boolean',
        ]);

        $role->update([$validated['field'] => $validated['value']]);

        return response()->json(['success' => true]);
    }

    public function updateMenuAccess(Request $request, Role $role)
    {
        $validated = $request->validate([
            'menu_access'   => 'nullable|array',
            'menu_access.*' => 'string',
        ]);

        $role->update(['menu_access' => $validated['menu_access'] ?? []]);

        return response()->json(['success' => true]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('dashboard.settings.index')->with('success', 'Role berhasil dihapus.');
    }
}
