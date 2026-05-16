<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mx-auto">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        <x-molecules.shared.forms.form-section title="Informasi Pengguna" icon="heroicon-s-users" bg-icon="heroicon-o-users">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <x-molecules.shared.forms.form-input type="email" label="Email" name="email" :value="$user?->email" required />
                <x-molecules.shared.forms.form-input type="select" label="Role" name="role" :value="$user?->role ?? 'staff'"
                    :options="['admin' => 'Admin', 'bph' => 'BPH', 'koordinator' => 'Koordinator', 'staff' => 'Staff']" required />
            </div>
            <x-molecules.shared.forms.form-input type="search-select" label="Hubungkan ke Pengurus" name="staff_id" :value="$user?->staff_id"
                :options="$staffOptions ?? []" helper="Opsional — hubungkan akun ini dengan data pengurus" />
        </x-molecules.shared.forms.form-section>
    </div>

    {{-- Sidebar Content --}}
    <div class="space-y-8">
        <div class="bg-indigo-500/5 dark:bg-indigo-500/10 rounded-2xl p-6 border border-indigo-500/10 dark:border-indigo-500/20 transition-colors duration-300">
            <div class="flex gap-4">
                <div class="size-10 rounded-xl bg-indigo-500/10 dark:bg-indigo-500/20 text-indigo-500 flex items-center justify-center shrink-0">
                    <x-heroicon-s-information-circle class="size-5" />
                </div>
                <div>
                    <h4 class="text-xs font-black text-indigo-500 uppercase tracking-widest mb-1">Setup Password</h4>
                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        Password untuk akun ini tidak diatur di sini. Sistem akan otomatis mengirimkan email berisi tautan <strong>Setup Password</strong> ke alamat email yang Anda masukkan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 flex items-center justify-end gap-3">
    <x-atoms.shared.button variant="ghost" href="/dashboard/users">
        Batal
    </x-atoms.shared.button>
    <x-atoms.shared.button type="submit">
        {{ $user ? 'Simpan Perubahan' : 'Tambah Pengguna' }}
    </x-atoms.shared.button>
</div>



