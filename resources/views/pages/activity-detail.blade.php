<x-layouts.app
    :title="$activity->title . ' | HMTIF UNPAS'"
    :description="$activity->description ?: 'Lihat rincian lengkap kegiatan HMTIF UNPAS.'"
    keywords="Detail Acara HMTIF, Info Kegiatan Informatika, Event Mahasiswa UNPAS"
    :transparent="false"
>
    @php
        $thumbnail = (string) ($activity->thumbnail ?? '');
        $isLocalThumbnail =
            $thumbnail !== '' &&
            \Illuminate\Support\Str::startsWith($thumbnail, ['/', 'storage/', 'images/', url('/')]);
        $heroImage = $isLocalThumbnail ? $thumbnail : asset('images/placeholders/activity.svg');
    @endphp

    <section class="pt-24 pb-10 bg-white border-b border-slate-100">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <a href="{{ route('activities') }}"
                class="inline-flex items-center gap-2 text-primary font-bold text-sm hover:translate-x-1 transition-transform group mb-8">
                <x-heroicon-o-arrow-left class="size-4" />
                Kembali ke Kegiatan
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_0.8fr] gap-10 items-start">
                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.2em] mb-5">
                        {{ ucfirst($activity->status ?? 'kegiatan') }}
                    </span>
                    <h1 class="text-3xl md:text-5xl font-black italic uppercase tracking-tighter text-heading leading-tight">
                        {{ $activity->title }}
                    </h1>
                    <p class="mt-5 text-base md:text-lg text-body/70 max-w-3xl leading-relaxed">
                        {{ $activity->description ?: 'Informasi detail kegiatan HMTIF UNPAS.' }}
                    </p>

                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Tanggal Mulai</div>
                            <div class="font-bold text-heading">{{ optional($activity->start_date)->translatedFormat('d M Y H:i') ?: '-' }}</div>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Tanggal Selesai</div>
                            <div class="font-bold text-heading">{{ optional($activity->end_date)->translatedFormat('d M Y H:i') ?: '-' }}</div>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Lokasi</div>
                            <div class="font-bold text-heading">{{ $activity->location ?: '-' }}</div>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Pendaftaran</div>
                            @if ($activity->registration_url)
                                <a href="{{ $activity->registration_url }}" class="font-bold text-primary hover:underline" target="_blank" rel="noopener noreferrer">Buka Link</a>
                            @else
                                <div class="font-bold text-heading">-</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] overflow-hidden border border-slate-200 shadow-lg bg-slate-50">
                    <img src="{{ $heroImage }}" alt="{{ $activity->title }}" class="w-full h-full object-cover" data-fallback-src="{{ asset('images/placeholders/activity.svg') }}">
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-section/30">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-10">
                <article class="bg-white rounded-[2rem] border border-slate-200 p-8 md:p-10 shadow-sm">
                    <h2 class="text-2xl font-black italic uppercase tracking-tighter text-heading mb-6">Rincian Kegiatan</h2>
                    @if ($activity->body)
                        <div class="prose prose-slate max-w-none prose-headings:font-black prose-headings:tracking-tight prose-a:text-primary">
                            {!! $activity->body !!}
                        </div>
                    @else
                        <p class="text-body/70 leading-relaxed">
                            {{ $activity->description ?: 'Detail kegiatan belum tersedia.' }}
                        </p>
                    @endif
                </article>

                <aside class="space-y-6">
                    <div class="bg-white rounded-[2rem] border border-slate-200 p-6 shadow-sm">
                        <h3 class="text-sm font-black uppercase tracking-[0.2em] text-slate-400 mb-4">Informasi Singkat</h3>
                        <div class="space-y-4 text-sm">
                            <div>
                                <div class="font-black text-slate-400 uppercase tracking-wide text-[10px] mb-1">Status</div>
                                <div class="font-semibold text-heading">{{ ucfirst($activity->status ?? '-') }}</div>
                            </div>
                            <div>
                                <div class="font-black text-slate-400 uppercase tracking-wide text-[10px] mb-1">Lokasi</div>
                                <div class="font-semibold text-heading">{{ $activity->location ?: '-' }}</div>
                            </div>
                            <div>
                                <div class="font-black text-slate-400 uppercase tracking-wide text-[10px] mb-1">Dokumen</div>
                                @if ($activity->file)
                                    <a href="{{ $activity->file }}" target="_blank" rel="noopener noreferrer" class="font-semibold text-primary hover:underline">Lihat Lampiran</a>
                                @else
                                    <div class="font-semibold text-heading">-</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-primary text-white rounded-[2rem] p-6 shadow-lg shadow-primary/20">
                        <h3 class="text-xl font-black italic uppercase tracking-tighter mb-3">Ikut Berpartisipasi</h3>
                        <p class="text-white/80 text-sm leading-relaxed mb-5">
                            Gunakan kanal pendaftaran resmi jika kegiatan ini masih membuka peserta.
                        </p>
                        @if ($activity->registration_url)
                            <x-atoms.shared.button :href="$activity->registration_url" variant="secondary" class="w-full" target="_blank" rel="noopener noreferrer">
                                Daftar Sekarang
                            </x-atoms.shared.button>
                        @else
                            <div class="text-sm font-semibold text-white/70">Pendaftaran belum tersedia.</div>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </section>
</x-layouts.app>
