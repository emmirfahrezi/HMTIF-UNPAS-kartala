<div class="space-y-6 max-w-6xl mx-auto">
    <x-molecules.shared.forms.form-section title="Informasi Pengguna">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-molecules.shared.forms.form-input type="email" label="Email" name="email" :value="$user?->email" required />
            <x-molecules.shared.forms.form-input type="select" label="Role" name="role" :value="$user?->role ?? 'staff'"
                :options="['admin' => 'Admin', 'bph' => 'BPH', 'koordinator' => 'Koordinator', 'staff' => 'Staff']" required />
        </div>
        <x-molecules.shared.forms.form-input type="search-select" label="Hubungkan ke Pengurus" name="staff_id" :value="$user?->staff_id"
            :options="$staffOptions ?? []" helper="Opsional — hubungkan akun ini dengan data pengurus" />
    </x-molecules.shared.forms.form-section>
    <div class="flex items-center justify-end gap-3 mt-8">
        <x-atoms.shared.button variant="ghost" href="/dashboard/users">
            Batal
        </x-atoms.shared.button>
        <x-atoms.shared.button type="submit">
            {{ $user ? 'Simpan Perubahan' : 'Tambah Pengguna' }}
        </x-atoms.shared.button>
    </div>
</div>



