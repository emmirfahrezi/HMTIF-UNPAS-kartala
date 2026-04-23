<div class="space-y-6 max-w-4xl">
    <x-dashboard.form-section title="Data Aspirasi">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-dashboard.form-input label="Nama" name="name" :value="$aspiration?->name" required />
            <x-dashboard.form-input label="NIM" name="nim" :value="$aspiration?->nim" />
            <x-dashboard.form-input type="email" label="Email" name="email" :value="$aspiration?->email" />
            <x-dashboard.form-input label="Kode Tracking" name="tracking_code" :value="$aspiration?->tracking_code" />
        </div>
        <x-dashboard.form-input label="Subjek" name="subject" :value="$aspiration?->subject" required />
        <x-dashboard.form-input type="textarea" label="Pesan" name="message" :value="$aspiration?->message" :rows="5" required />
    </x-dashboard.form-section>

    <x-dashboard.form-section title="Status">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <x-dashboard.form-input type="select" label="Status" name="status" :value="$aspiration?->status ?? 'pending'"
                :options="['pending' => 'Pending', 'reviewed' => 'Reviewed', 'resolved' => 'Resolved', 'rejected' => 'Rejected']" required />
            <x-dashboard.form-input type="toggle" name="is_spotlight" :value="$aspiration?->is_spotlight ?? false" placeholder="Tampilkan di Spotlight" />
            <x-dashboard.form-input type="date" label="Pekan Spotlight" name="spotlighted_week" :value="$aspiration?->spotlighted_week?->format('Y-m-d')" />
        </div>
    </x-dashboard.form-section>

    <div class="flex items-center gap-3">
        <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">
            {{ $aspiration ? 'Simpan Perubahan' : 'Tambah Aspirasi' }}
        </button>
        <a href="/dashboard/aspirations" class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">Batal</a>
    </div>
</div>
