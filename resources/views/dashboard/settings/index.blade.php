@php
    $menuItems = collect($menuItems)->toArray();
    
    $hasAnnCat = false;
    $hasProdCat = false;
    foreach ($menuItems as $item) {
        if ($item['key'] === 'announcements/categories') $hasAnnCat = true;
        if ($item['key'] === 'products/categories') $hasProdCat = true;
    }
    
    if (!$hasAnnCat) {
        $newMenuItems = [];
        foreach ($menuItems as $item) {
            $newMenuItems[] = $item;
            if ($item['key'] === 'announcements') {
                $newMenuItems[] = ['key' => 'announcements/categories', 'label' => 'Kategori Pengumuman', 'type' => 'item', 'parent' => 'announcements'];
            }
        }
        $menuItems = $newMenuItems;
    }
    
    if (!$hasProdCat) {
        $newMenuItems = [];
        foreach ($menuItems as $item) {
            $newMenuItems[] = $item;
            if ($item['key'] === 'products') {
                $newMenuItems[] = ['key' => 'products/categories', 'label' => 'Kategori Produk', 'type' => 'item', 'parent' => 'products'];
            }
        }
        $menuItems = $newMenuItems;
    }
    
    $hasProfile = false;
    foreach ($menuItems as $item) {
        if ($item['key'] === 'profile') $hasProfile = true;
    }
    if (!$hasProfile) {
        $newMenuItems = [];
        foreach ($menuItems as $item) {
            $newMenuItems[] = $item;
            if ($item['key'] === 'dashboard') {
                $newMenuItems[] = ['key' => 'profile', 'label' => 'Profil Saya', 'type' => 'item', 'parent' => null];
            }
        }
        $menuItems = $newMenuItems;
    }
@endphp
<x-layouts.dashboard pageTitle="Sistem Settings" :breadcrumbs="[['label' => 'Sistem Settings']]">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Kolom Kiri (2/3): Tabel Role Akses --}}
        <div class="lg:col-span-2 space-y-8">
            @include('dashboard.settings._role-table')
        </div>

        {{-- Kolom Kanan (1/3): Info + Tambah Role --}}
        <div class="space-y-8">
            {{-- Info Card --}}
            <div
                class="bg-indigo-500/5 dark:bg-indigo-500/10 rounded-2xl p-6 border border-indigo-500/10 dark:border-indigo-500/20 transition-colors duration-300">
                <div class="flex gap-4">
                    <div
                        class="size-10 rounded-xl bg-indigo-500/10 dark:bg-indigo-500/20 text-indigo-500 flex items-center justify-center shrink-0">
                        <x-heroicon-s-information-circle class="size-5" />
                    </div>
                    <div>
                        <h4 class="text-xs font-black text-indigo-500 uppercase tracking-widest mb-1">Informasi</h4>
                        <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                            Gunakan tombol <strong>gear</strong> pada tabel Role untuk mengatur akses halaman/menu
                            dashboard untuk setiap role.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form Tambah Role --}}
            @include('dashboard.settings._role-form')
        </div>
    </div>

    {{-- Modal Akses Halaman --}}
    @include('dashboard.settings._role-menu-modal')

</x-layouts.dashboard>