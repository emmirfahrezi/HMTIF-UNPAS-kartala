{{-- Shared Announcement Form --}}
<div class="space-y-6 max-w-4xl">
    <x-dashboard.form-section title="Informasi Pengumuman">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-dashboard.form-input label="Judul" name="title" :value="$announcement?->title" placeholder="Judul pengumuman" required />
            <x-dashboard.form-input label="Slug" name="slug" :value="$announcement?->slug" placeholder="auto-generated" required />
        </div>
        <x-dashboard.form-input type="select" label="Kategori" name="announcement_category_id" :value="$announcement?->announcement_category_id"
            :options="$categories ?? []" />
        <x-dashboard.form-input type="textarea" label="Ringkasan" name="excerpt" :value="$announcement?->excerpt" placeholder="Ringkasan singkat..." :rows="3" />
        <x-dashboard.form-input type="textarea" label="Konten" name="body" :value="$announcement?->body" placeholder="Isi pengumuman lengkap..." :rows="8" />
    </x-dashboard.form-section>

    <x-dashboard.form-section title="Media & Publikasi">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-dashboard.form-input label="URL Thumbnail" name="thumbnail" :value="$announcement?->thumbnail" placeholder="https://..." />
            <x-dashboard.form-input type="datetime-local" label="Tanggal Publikasi" name="published_at"
                :value="$announcement?->published_at?->format('Y-m-d\TH:i')" />
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">File Lampiran</label>
            <input type="file" name="file"
                class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition cursor-pointer" />
            @if ($announcement?->file)
                <p class="text-xs text-slate-400 mt-1">File saat ini: {{ $announcement->file }}</p>
            @endif
        </div>
    </x-dashboard.form-section>

    <div class="flex items-center gap-3">
        <button type="submit"
            class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">
            {{ $announcement ? 'Simpan Perubahan' : 'Tambah Pengumuman' }}
        </button>
        <a href="/dashboard/announcements"
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
