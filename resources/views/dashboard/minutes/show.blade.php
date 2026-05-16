<x-layouts.dashboard pageTitle="Detail Notulensi" :breadcrumbs="[['label' => 'Notulensi', 'href' => '/dashboard/minutes'], ['label' => 'Detail']]">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <x-atoms.shared.button 
                    variant="soft" 
                    size="sm"
                    href="/dashboard/minutes"
                    class="!p-2 size-9">
                    <x-heroicon-o-arrow-left class="size-5" />
                </x-atoms.shared.button>
                <h2 class="text-2xl font-black text-slate-800 dark:text-white tracking-tight italic uppercase">{{ $minute->perihal }}</h2>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <x-atoms.shared.button 
                variant="soft-warning" 
                href="/dashboard/minutes/{{ $minute->id }}/edit"
                class="border border-amber-500/20">
                Edit Data
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                variant="secondary" 
                href="/dashboard/minutes/{{ $minute->id }}/print"
                target="_blank"
                class="border border-slate-200 dark:border-slate-800">
                Cetak PDF
            </x-atoms.shared.button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Document --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- Document Header --}}
            <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-10 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
                <div class="absolute top-0 right-0 p-10 opacity-[0.03] text-primary pointer-events-none">
                    <x-heroicon-o-clipboard-document-check class="size-48" />
                </div>

                <div class="relative z-10">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-10 border-b border-slate-100 dark:border-slate-800 mb-10">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Nomor Notulensi</label>
                            <p class="text-lg font-black text-slate-800 dark:text-white tracking-widest uppercase">{{ $minute->nomor }}</p>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="text-right">
                                <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-1">Tanggal</label>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $minute->tanggal->format('l, d F Y') }}</p>
                            </div>
                            <div class="h-10 w-px bg-slate-100 dark:bg-slate-800"></div>
                            <div class="text-right">
                                <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-1">Pukul</label>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $minute->waktu_mulai }} - {{ $minute->waktu_selesai ?? 'Selesai' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-3">Tempat / Lokasi</label>
                            <div class="flex items-start gap-3">
                                <div class="size-10 rounded-xl bg-slate-50 dark:bg-slate-950 flex items-center justify-center text-slate-400 dark:text-slate-600 shrink-0">
                                    <x-heroicon-o-map-pin class="size-5" />
                                </div>
                                <p class="text-base font-bold text-slate-700 dark:text-slate-200 leading-snug pt-2">{{ $minute->tempat }}</p>
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-3">Dipimpin Oleh</label>
                            <div class="flex items-start gap-3">
                                <div class="size-10 rounded-xl bg-slate-50 dark:bg-slate-950 flex items-center justify-center text-slate-400 dark:text-slate-600 shrink-0">
                                    <x-heroicon-o-user class="size-5" />
                                </div>
                                <p class="text-base font-bold text-slate-700 dark:text-slate-200 leading-snug pt-2">{{ $minute->dipimpin_oleh }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-12">
                        <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-4">Agenda Pembahasan</label>
                        <div class="prose dark:prose-invert prose-slate max-w-none prose-sm p-6 bg-slate-50 dark:bg-slate-950 rounded-2xl border border-slate-100 dark:border-slate-800 text-slate-600 dark:text-slate-400 font-medium leading-relaxed">
                            {!! $minute->agenda !!}
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-6">Isi & Hasil Keputusan Rapat</label>
                        <div class="prose dark:prose-invert prose-slate max-w-none prose-sm sm:prose-base font-medium leading-relaxed text-slate-700 dark:text-slate-300">
                            {!! $minute->isi_rapat !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Side Info --}}
        <div class="space-y-8">
            {{-- Attendees List --}}
            <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm transition-colors duration-300">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xs font-black text-slate-800 dark:text-white uppercase tracking-[0.2em]">Daftar Hadir</h3>
                    <span class="text-[10px] font-black text-primary bg-primary/5 dark:bg-primary/10 px-2.5 py-1 rounded-full uppercase tracking-widest">
                        {{ $minute->attendees->where('keterangan', 'hadir')->count() }} / {{ $minute->attendees->count() }} Peserta
                    </span>
                </div>

                <div class="space-y-4">
                    @forelse ($minute->attendees as $attendee)
                        <div class="flex items-center justify-between p-3 rounded-2xl border border-slate-50 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                            <div class="flex items-center gap-3">
                                <div class="size-8 rounded-lg {{ $attendee->keterangan == 'hadir' ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-500' : ($attendee->keterangan == 'izin' ? 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-500' : 'bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-500') }} flex items-center justify-center text-[10px] font-black shadow-inner">
                                    {{ strtoupper(substr($attendee->name, 0, 1)) }}
                                </div>
                                <div class="flex flex-col leading-tight">
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-200">{{ $attendee->name }}</span>
                                    <span class="text-[9px] text-slate-400 dark:text-slate-500 font-medium italic">{{ $attendee->jabatan ?? '-' }}</span>
                                </div>
                            </div>
                            <span class="text-[8px] font-black uppercase tracking-widest {{ $attendee->keterangan == 'hadir' ? 'text-emerald-500' : ($attendee->keterangan == 'izin' ? 'text-amber-500' : 'text-red-500') }}">
                                {{ $attendee->keterangan }}
                            </span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 dark:text-slate-600 italic text-center py-4">Tidak ada data peserta.</p>
                    @endforelse
                </div>
            </div>

            {{-- Documentation Preview --}}
            @if($minute->dokumentasi_file)
                <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm transition-colors duration-300">
                    <h3 class="text-xs font-black text-slate-800 dark:text-white uppercase tracking-[0.2em] mb-6">Dokumentasi</h3>
                    <div class="rounded-2xl overflow-hidden border border-slate-100 dark:border-slate-800 mb-4 shadow-inner">
                        <img src="{{ Storage::url($minute->dokumentasi_file) }}" alt="Dokumentasi" class="w-full h-auto object-cover dark:opacity-80">
                    </div>
                    <x-atoms.shared.button 
                        variant="ghost" 
                        size="sm"
                        href="{{ Storage::url($minute->dokumentasi_file) }}" 
                        target="_blank"
                        class="w-full">
                        Buka File Asli
                    </x-atoms.shared.button>
                </div>
            @endif
        </div>
    </div>
</x-layouts.dashboard>
