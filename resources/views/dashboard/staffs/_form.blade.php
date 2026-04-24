{{-- Shared Staff Form --}}
<div class="space-y-6 max-w-6xl mx-auto">
    <x-molecules.dashboard.forms.form-section title="Informasi Pengurus">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-molecules.dashboard.forms.form-input label="Nama" name="name" :value="$staff?->name" placeholder="Nama lengkap" required />
            <x-molecules.dashboard.forms.form-input label="Jabatan" name="position" :value="$staff?->position" placeholder="Jabatan / posisi" required />
            <x-molecules.dashboard.forms.form-input type="select" label="Divisi" name="division_id" :value="$staff?->division_id"
                :options="$divisions ?? []" required />
            <x-molecules.dashboard.forms.form-input type="select" label="Akun Login" name="user_id" :value="$staff?->user_id"
                :options="$users ?? []" helper="Hubungkan pengurus ini dengan akun login" />
        </div>
    </x-dashboard.form-section>

    <x-molecules.dashboard.forms.form-section title="Profil & Sosial Media">
        <x-molecules.dashboard.forms.form-input label="URL Foto" name="photo" :value="$staff?->photo" placeholder="https://..." />
        <x-molecules.dashboard.forms.form-input type="textarea" label="Bio" name="bio" :value="$staff?->bio" placeholder="Biodata singkat..." :rows="3" />
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-molecules.dashboard.forms.form-input label="Instagram" name="instagram" :value="$staff?->instagram" placeholder="@username" />
            <x-molecules.dashboard.forms.form-input label="LinkedIn" name="linkedin" :value="$staff?->linkedin" placeholder="URL profil LinkedIn" />
        </div>
    </x-dashboard.form-section>

    <x-molecules.dashboard.forms.form-section title="Pengaturan">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <x-molecules.dashboard.forms.form-input type="number" label="Urutan" name="order" :value="$staff?->order ?? 0" />
            <x-molecules.dashboard.forms.form-input type="toggle" name="is_active" :value="$staff?->is_active ?? true" placeholder="Aktif" />
            <x-molecules.dashboard.forms.form-input type="toggle" name="is_bph" :value="$staff?->is_bph ?? false" placeholder="BPH (Badan Pengurus Harian)" />
        </div>
    </x-dashboard.form-section>

    <div class="flex items-center justify-end gap-3">
        <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">
            {{ $staff ? 'Simpan Perubahan' : 'Tambah Pengurus' }}
        </button>
        <a href="/dashboard/staffs" class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">Batal</a>
    </div>
</div>
