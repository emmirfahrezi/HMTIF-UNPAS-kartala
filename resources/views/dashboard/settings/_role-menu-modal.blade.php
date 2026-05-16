{{-- Section: Modal Akses Halaman --}}
<x-molecules.shared.modal id="role-menu-settings" title="Hak Akses Halaman">
    <div class="mb-4 bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl border border-slate-100 dark:border-slate-800">
        <h4 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
            <x-heroicon-o-bars-3-bottom-left class="size-5 text-primary" />
            Daftar Menu Dashboard
        </h4>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Centang menu yang diizinkan untuk diakses oleh
            role ini.</p>
    </div>

    <div class="space-y-1 h-[400px] overflow-y-auto pr-2 custom-scrollbar">
        {{-- Root Item --}}
        <div
            class="flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group">
            <x-atoms.shared.checkbox checked />
            <x-heroicon-o-home class="size-5 text-slate-400 group-hover:text-primary transition-colors" />
            <span class="font-bold text-sm text-slate-700 dark:text-slate-200">Dashboard</span>
        </div>

        {{-- Category 1: Konten --}}
        <div class="pt-2 pb-1">
            <div
                class="flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group">
                <x-atoms.shared.checkbox checked />
                <span
                    class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded">Konten</span>
            </div>

            <div class="ml-9 border-l-2 border-slate-100 dark:border-slate-800 pl-4 py-1 space-y-1 relative">
                <div
                    class="flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group">
                    <x-atoms.shared.checkbox checked />
                    <x-heroicon-o-document-duplicate
                        class="size-4 text-slate-400 group-hover:text-primary transition-colors" />
                    <span class="font-medium text-sm text-slate-600 dark:text-slate-300">Halaman Utama</span>
                </div>
                <div
                    class="flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group">
                    <x-atoms.shared.checkbox checked />
                    <x-heroicon-o-calendar
                        class="size-4 text-slate-400 group-hover:text-primary transition-colors" />
                    <span class="font-medium text-sm text-slate-600 dark:text-slate-300">Kegiatan</span>
                </div>
                <div
                    class="flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group">
                    <x-atoms.shared.checkbox checked />
                    <x-heroicon-o-megaphone
                        class="size-4 text-slate-400 group-hover:text-primary transition-colors" />
                    <span class="font-medium text-sm text-slate-600 dark:text-slate-300">Pengumuman</span>
                </div>
            </div>
        </div>

        {{-- Category 2: Organisasi --}}
        <div class="pt-2 pb-1">
            <div
                class="flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group">
                <x-atoms.shared.checkbox checked />
                <span
                    class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded">Organisasi</span>
            </div>

            <div class="ml-9 border-l-2 border-slate-100 dark:border-slate-800 pl-4 py-1 space-y-1 relative">
                <div
                    class="flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group">
                    <x-atoms.shared.checkbox checked />
                    <x-heroicon-o-users class="size-4 text-slate-400 group-hover:text-primary transition-colors" />
                    <span class="font-medium text-sm text-slate-600 dark:text-slate-300">Pengurus</span>
                </div>
                {{-- Sub-children --}}
                <div
                    class="ml-8 border-l-2 border-slate-100/50 dark:border-slate-800/50 pl-4 py-1 space-y-1 relative">
                    <div
                        class="flex items-center gap-3 p-1.5 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group">
                        <x-atoms.shared.checkbox checked />
                        <span class="font-medium text-sm text-slate-500 dark:text-slate-400">Divisi</span>
                    </div>
                </div>

                <div
                    class="flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group">
                    <x-atoms.shared.checkbox checked />
                    <x-heroicon-o-chat-bubble-left-right
                        class="size-4 text-slate-400 group-hover:text-primary transition-colors" />
                    <span class="font-medium text-sm text-slate-600 dark:text-slate-300">Aspirasi</span>
                </div>
                <div
                    class="flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group">
                    <x-atoms.shared.checkbox checked />
                    <x-heroicon-o-clipboard-document-list
                        class="size-4 text-slate-400 group-hover:text-primary transition-colors" />
                    <span class="font-medium text-sm text-slate-600 dark:text-slate-300">Notulensi</span>
                </div>
            </div>
        </div>

        {{-- Category 3: Store --}}
        <div class="pt-2 pb-1">
            <div
                class="flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group">
                <x-atoms.shared.checkbox checked />
                <span
                    class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded">Store</span>
            </div>

            <div class="ml-9 border-l-2 border-slate-100 dark:border-slate-800 pl-4 py-1 space-y-1 relative">
                <div
                    class="flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group">
                    <x-atoms.shared.checkbox checked />
                    <x-heroicon-o-shopping-bag
                        class="size-4 text-slate-400 group-hover:text-primary transition-colors" />
                    <span class="font-medium text-sm text-slate-600 dark:text-slate-300">Produk</span>
                </div>
            </div>
        </div>

    </div>

    <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-slate-100 dark:border-slate-800">
        <x-atoms.shared.button variant="ghost" type="button"
            @click="$dispatch('close-modal', { name: 'role-menu-settings' })">
            Batal
        </x-atoms.shared.button>
        <x-atoms.shared.button type="button"
            @click="$dispatch('close-modal', { name: 'role-menu-settings' }); toast('Berhasil menyimpan akses menu (Demo)', 'success')">
            Simpan Perubahan
        </x-atoms.shared.button>
    </div>
</x-molecules.shared.modal>
