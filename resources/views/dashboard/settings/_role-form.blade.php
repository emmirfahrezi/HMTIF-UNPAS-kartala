{{-- Section: Tambah Role Akses --}}
<div
    class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
    <div class="absolute top-0 right-0 p-6 opacity-[0.03] text-primary pointer-events-none">
        <x-heroicon-o-plus-circle class="size-24" />
    </div>

    <h3
        class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3 relative z-10">
        <span
            class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
            <x-heroicon-s-plus-circle class="size-5" />
        </span>
        Tambah Role Akses
    </h3>

    <form action="#" method="POST" class="space-y-5 relative z-10" x-data="{ roleName: '' }">
        @csrf
        <div>
            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">Nama
                Role</label>
            <input type="text" name="name" x-model="roleName" required placeholder="Misal: Editor"
                class="w-full bg-slate-50 dark:bg-slate-950/45 border border-slate-200/50 dark:border-slate-800/50 text-slate-800 dark:text-white rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all duration-300 placeholder:text-slate-400 dark:placeholder:text-slate-600">
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Hak Akses
                Default</label>
            <div
                class="space-y-3 bg-slate-50 dark:bg-slate-950/30 p-4 rounded-xl border border-slate-100 dark:border-slate-800">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600 dark:text-slate-400">Create (Buat Data)</span>
                    <x-atoms.shared.checkbox name="perm_create" />
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600 dark:text-slate-400">Read (Lihat Data)</span>
                    <x-atoms.shared.checkbox name="perm_read" checked />
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600 dark:text-slate-400">Update (Ubah Data)</span>
                    <x-atoms.shared.checkbox name="perm_update" />
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600 dark:text-slate-400">Delete (Hapus Data)</span>
                    <x-atoms.shared.checkbox name="perm_delete" />
                </div>
            </div>
        </div>

        <div class="pt-2">
            <x-atoms.shared.button type="button"
                class="w-full justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                x-bind:disabled="!roleName.trim()"
                @click="toast('Role baru berhasil ditambahkan (Demo)', 'success')">
                Simpan Role
            </x-atoms.shared.button>
        </div>
    </form>
</div>
