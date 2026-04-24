{{-- Shared Minute Form --}}
<div class="space-y-6 max-w-4xl">
    <x-molecules.dashboard.forms.form-section title="Informasi Rapat">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-molecules.dashboard.forms.form-input label="Nomor" name="nomor" :value="$minute?->nomor" required placeholder="001/NOT/HMTIF/2026" />
            <x-molecules.dashboard.forms.form-input label="Perihal" name="perihal" :value="$minute?->perihal" required />
            <x-molecules.dashboard.forms.form-input type="date" label="Tanggal" name="tanggal" :value="$minute?->tanggal?->format('Y-m-d')" required />
            <x-molecules.dashboard.forms.form-input label="Tempat" name="tempat" :value="$minute?->tempat" />
            <x-molecules.dashboard.forms.form-input type="time" label="Waktu Mulai" name="waktu_mulai" :value="$minute?->waktu_mulai" />
            <x-molecules.dashboard.forms.form-input type="time" label="Waktu Selesai" name="waktu_selesai" :value="$minute?->waktu_selesai" />
        </div>
        <x-molecules.dashboard.forms.form-input label="Dipimpin Oleh" name="dipimpin_oleh" :value="$minute?->dipimpin_oleh" />
    </x-dashboard.form-section>

    <x-molecules.dashboard.forms.form-section title="Isi Rapat">
        <x-molecules.dashboard.forms.form-input type="textarea" label="Agenda" name="agenda" :value="$minute?->agenda" :rows="4" />
        <x-molecules.dashboard.forms.form-input type="textarea" label="Isi Rapat / Pembahasan" name="isi_rapat" :value="$minute?->isi_rapat" :rows="6" />
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">File Dokumentasi</label>
            <input type="file" name="dokumentasi_file"
                class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition cursor-pointer" />
            @if ($minute?->dokumentasi_file)
                <p class="text-xs text-slate-400 mt-1">File saat ini: {{ $minute->dokumentasi_file }}</p>
            @endif
        </div>
    </x-dashboard.form-section>

    <x-molecules.dashboard.forms.form-section title="Daftar Hadir" description="Tambah peserta yang hadir dalam rapat.">
        <div id="attendeeRepeater" class="space-y-3" data-count="{{ ($minute?->attendees?->count() ?? 0) }}">
            @foreach ($minute?->attendees ?? [] as $i => $att)
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 attendee-row">
                    <input type="hidden" name="attendees[{{ $i }}][id]" value="{{ $att->id }}" />
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                        <input type="text" name="attendees[{{ $i }}][name]" value="{{ $att->name }}" placeholder="Nama"
                            class="px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" />
                        <input type="text" name="attendees[{{ $i }}][nim]" value="{{ $att->nim }}" placeholder="NIM"
                            class="px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" />
                        <input type="text" name="attendees[{{ $i }}][jabatan]" value="{{ $att->jabatan }}" placeholder="Jabatan"
                            class="px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" />
                        <select name="attendees[{{ $i }}][keterangan]"
                            class="px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 bg-white">
                            <option value="hadir" {{ $att->keterangan === 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="izin" {{ $att->keterangan === 'izin' ? 'selected' : '' }}>Izin</option>
                            <option value="alpha" {{ $att->keterangan === 'alpha' ? 'selected' : '' }}>Alpha</option>
                        </select>
                        <div class="flex items-center gap-2">
                            <input type="number" name="attendees[{{ $i }}][order]" value="{{ $att->order }}" placeholder="#"
                                class="w-16 px-2 py-2 border border-slate-200 rounded-lg text-sm text-center focus:outline-none focus:ring-2 focus:ring-primary/20" />
                            <button type="button" onclick="this.closest('.attendee-row').remove()"
                                class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">✕</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" onclick="addAttendeeRow()"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-primary bg-primary/10 rounded-xl hover:bg-primary/20 transition">
            <x-heroicon-o-plus class="size-4" /> Tambah Peserta
        </button>
    </x-dashboard.form-section>

    <div class="flex items-center gap-3">
        <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">
            {{ $minute ? 'Simpan' : 'Tambah Notulensi' }}
        </button>
        <a href="/dashboard/minutes" class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">Batal</a>
    </div>
</div>

@vite(['resources/js/dashboard/minute-form.js'])

