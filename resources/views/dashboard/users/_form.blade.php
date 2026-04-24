<div class="space-y-6 max-w-6xl mx-auto">
    <x-molecules.dashboard.forms.form-section title="Informasi Pengguna">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-molecules.dashboard.forms.form-input label="Nama" name="name" :value="$user?->name" required />
            <x-molecules.dashboard.forms.form-input type="email" label="Email" name="email" :value="$user?->email" required />
            <x-molecules.dashboard.forms.form-input type="password" label="Password" name="password" placeholder="{{ $user ? 'Kosongkan jika tidak diubah' : '' }}" :required="!$user" />
            <x-molecules.dashboard.forms.form-input type="select" label="Role" name="role" :value="$user?->role ?? 'staff'"
                :options="['admin' => 'Admin', 'bph' => 'BPH', 'koordinator' => 'Koordinator', 'staff' => 'Staff']" required />
        </div>
        <x-molecules.dashboard.forms.form-input type="select" label="Hubungkan ke Pengurus" name="staff_id" :value="$user?->staff_id"
            :options="$staffOptions ?? []" helper="Opsional — hubungkan akun ini dengan data pengurus" />
    </x-dashboard.form-section>
    <div class="flex items-center justify-end gap-3">
        <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">
            {{ $user ? 'Simpan' : 'Tambah Pengguna' }}
        </button>
        <a href="/dashboard/users" class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">Batal</a>
    </div>
</div>
