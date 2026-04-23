{{-- Shared Activity Form --}}
<div class="space-y-6 max-w-4xl">
    <x-dashboard.form-section title="Informasi Kegiatan" description="Detail utama kegiatan.">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-dashboard.form-input label="Judul" name="title" :value="$activity?->title" placeholder="Nama kegiatan" required />
            <x-dashboard.form-input label="Slug" name="slug" :value="$activity?->slug" placeholder="auto-generated" required helper="Akan otomatis terisi dari judul" />
        </div>
        <x-dashboard.form-input type="textarea" label="Deskripsi Singkat" name="description" :value="$activity?->description" placeholder="Deskripsi singkat kegiatan..." required :rows="3" />
        <x-dashboard.form-input type="textarea" label="Konten Lengkap" name="body" :value="$activity?->body" placeholder="Detail lengkap kegiatan..." :rows="6" />
    </x-dashboard.form-section>

    <x-dashboard.form-section title="Jadwal & Lokasi">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-dashboard.form-input type="datetime-local" label="Tanggal Mulai" name="start_date"
                :value="$activity?->start_date?->format('Y-m-d\TH:i')" required />
            <x-dashboard.form-input type="datetime-local" label="Tanggal Selesai" name="end_date"
                :value="$activity?->end_date?->format('Y-m-d\TH:i')" />
            <x-dashboard.form-input label="Lokasi" name="location" :value="$activity?->location" placeholder="Tempat pelaksanaan" />
            <x-dashboard.form-input type="url" label="URL Registrasi" name="registration_url" :value="$activity?->registration_url" placeholder="https://..." />
        </div>
    </x-dashboard.form-section>

    <x-dashboard.form-section title="Media & Status">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-dashboard.form-input label="URL Thumbnail" name="thumbnail" :value="$activity?->thumbnail" placeholder="https://..." />
            <x-dashboard.form-input type="select" label="Status" name="status" :value="$activity?->status"
                :options="['upcoming' => 'Upcoming', 'ongoing' => 'Ongoing', 'past' => 'Past']" required />
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">File Lampiran</label>
            <input type="file" name="file"
                class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition cursor-pointer" />
            @if ($activity?->file)
                <p class="text-xs text-slate-400 mt-1">File saat ini: {{ $activity->file }}</p>
            @endif
        </div>
    </x-dashboard.form-section>

    {{-- Actions --}}
    <div class="flex items-center gap-3">
        <button type="submit"
            class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">
            {{ $activity ? 'Simpan Perubahan' : 'Tambah Kegiatan' }}
        </button>
        <a href="/dashboard/activities"
            class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">
            Batal
        </a>
    </div>
</div>

<script>
    document.getElementById('title')?.addEventListener('blur', function () {
        const slugField = document.getElementById('slug');
        if (slugField && !slugField.value) {
            slugField.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        }
    });
</script>
