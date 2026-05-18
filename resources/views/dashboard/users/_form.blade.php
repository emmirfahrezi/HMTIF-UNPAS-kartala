<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mx-auto">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        <x-molecules.shared.forms.form-section title="Informasi Pengguna" icon="heroicon-s-users" bg-icon="heroicon-o-users">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div class="md:col-span-2">
                    <x-molecules.shared.forms.form-input type="text" label="Nama" name="name" :value="$user?->name" required />
                </div>
                <x-molecules.shared.forms.form-input type="email" label="Email" name="email" :value="$user?->email" required />
                <x-molecules.shared.forms.form-input type="select" label="Role" name="role" :value="$user?->role ?? 'staff'"
                    :options="['admin' => 'Admin', 'bph' => 'BPH', 'koordinator' => 'Koordinator', 'staff' => 'Staff']" required />
                <div class="md:col-span-2">
                    <x-molecules.shared.forms.form-input type="password" label="Password" name="password" :required="!$user" helper="{{ $user ? 'Kosongkan jika tidak ingin mengubah password.' : 'Minimal 8 karakter.' }}" />
                </div>
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
                    <h4 class="text-xs font-black text-indigo-500 uppercase tracking-widest mb-1">Manajemen Password</h4>
                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        Atur password awal untuk pengguna baru di sini. Pengguna yang dibuat juga dapat melakukan pemulihan sandi secara mandiri kapan saja.
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



