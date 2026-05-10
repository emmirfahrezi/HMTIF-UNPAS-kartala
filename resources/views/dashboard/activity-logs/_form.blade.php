<div class="space-y-6 max-w-5xl mx-auto">
    <x-molecules.shared.forms.form-section title="Informasi Log Aktivitas">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-molecules.shared.forms.form-input
                label="Judul Aktivitas"
                name="title"
                :value="old('title', $activityLog?->title)"
                required
                placeholder="Contoh: Publikasi agenda rapat" />

            <x-molecules.shared.forms.form-input
                type="date"
                label="Tanggal"
                name="date"
                :value="old('date', optional($activityLog?->date)->format('Y-m-d') ?? now()->format('Y-m-d'))"
                required />

            <x-molecules.shared.forms.form-input
                label="Kategori"
                name="category"
                :value="old('category', $activityLog?->category)"
                :helper="collect($categories ?? [])->isNotEmpty() ? 'Kategori tersedia: ' . collect($categories)->implode(', ') : 'Isi kategori aktivitas sesuai kebutuhan.'"
                required
                placeholder="Contoh: Website, Dokumentasi, Publikasi" />

            <x-molecules.shared.forms.form-input
                label="Pelaksana"
                name="performed_by"
                :value="old('performed_by', $activityLog?->performed_by)"
                required
                placeholder="Contoh: Departemen PTI" />
        </div>

        <div class="mt-5">
            <x-molecules.shared.forms.form-input
                type="textarea"
                label="Deskripsi"
                name="description"
                :value="old('description', $activityLog?->description)"
                :rows="5"
                placeholder="Ringkas aktivitas yang dilakukan dan hasilnya" />
        </div>
    </x-molecules.shared.forms.form-section>

    <div class="flex items-center justify-end gap-3 mt-8">
        <x-atoms.shared.button variant="ghost" href="/dashboard/activity-logs">
            Batal
        </x-atoms.shared.button>
        <x-atoms.shared.button type="submit">
            {{ $activityLog ? 'Simpan Perubahan' : 'Tambah Log' }}
        </x-atoms.shared.button>
    </div>
</div>
