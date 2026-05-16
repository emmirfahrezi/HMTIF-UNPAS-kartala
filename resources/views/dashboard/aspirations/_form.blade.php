<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        <x-molecules.shared.forms.form-section title="Data Aspirasi" icon="heroicon-s-document-text" bg-icon="heroicon-o-document-text">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <x-molecules.shared.forms.form-input label="Nama" name="name" :value="$aspiration?->name" required />
                <x-molecules.shared.forms.form-input label="NIM" name="nim" :value="$aspiration?->nim" />
                <x-molecules.shared.forms.form-input type="email" label="Email" name="email" :value="$aspiration?->email" />
                <x-molecules.shared.forms.form-input label="Kode Tracking" name="tracking_code" :value="$aspiration?->tracking_code" />
            </div>
            <x-molecules.shared.forms.form-input label="Subjek" name="subject" :value="$aspiration?->subject" required />
            <x-molecules.shared.forms.form-input type="textarea" label="Pesan" name="message" :value="$aspiration?->message" :rows="5" required />
        </x-molecules.shared.forms.form-section>

        <x-molecules.shared.forms.form-section title="Status" icon="heroicon-s-check-circle" bg-icon="heroicon-o-check-circle">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <x-molecules.shared.forms.form-input type="select" label="Status" name="status" :value="$aspiration?->status ?? 'pending'"
                    :options="['pending' => 'Menunggu', 'reviewed' => 'Ditinjau', 'resolved' => 'Selesai', 'rejected' => 'Ditolak']" required />
                <x-molecules.shared.forms.form-input type="toggle" name="is_spotlight" :value="$aspiration?->is_spotlight ?? false" placeholder="Tampilkan di Spotlight" />
                <x-molecules.shared.forms.form-input type="date" label="Pekan Spotlight" name="spotlighted_week" :value="$aspiration?->spotlighted_week?->format('Y-m-d')" />
            </div>
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
                    <h4 class="text-xs font-black text-indigo-500 uppercase tracking-widest mb-1">Informasi Notifikasi</h4>
                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        Jika email pengirim tersedia, perubahan status (terutama jika Selesai atau Ditolak) akan otomatis mengirimkan email notifikasi ke pengirim.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 flex items-center justify-end gap-3">
    <x-atoms.shared.button variant="ghost" href="/dashboard/aspirations">
        Batal
    </x-atoms.shared.button>
    <x-atoms.shared.button type="submit">
        {{ $aspiration ? 'Simpan Perubahan' : 'Tambah Aspirasi' }}
    </x-atoms.shared.button>
</div>

