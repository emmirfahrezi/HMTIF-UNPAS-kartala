<x-layouts.app :title="$activity->title . ' | HMTIF-UNPAS'" :description="strip_tags($activity->description ?: 'Lihat rincian lengkap kegiatan HMTIF-UNPAS.')"
    keywords="Detail Acara HMTIF, Info Kegiatan Informatika, Event Mahasiswa UNPAS" :transparent="false">
    @php
        $heroImage = $activity->thumbnail_url;
    @endphp

    <x-molecules.pages.sections.page-hero icon="heroicon-o-calendar-days">
        <div class="text-left max-w-3xl -mt-16 md:-mt-24 relative z-20">
            <a href="{{ route('activities') }}"
                class="inline-flex items-center gap-2 text-primary font-bold text-sm hover:-translate-x-1 transition-transform group mb-8">
                <x-heroicon-o-arrow-left class="size-4" />
                Kembali ke Kegiatan
            </a>

            <div class="mt-2">
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.2em] mb-5">
                    {{ $activity->status_label ?? 'Kegiatan' }}
                </span>
                <h1
                    class="text-3xl md:text-5xl font-black italic uppercase tracking-tighter text-heading leading-tight">
                    {{ $activity->title }}
                </h1>
                <div class="prose prose-slate mt-5 text-base text-body/70 md:text-lg">
                    @if ($activity->description)
                        {!! $activity->description !!}
                    @else
                        <p>Informasi detail kegiatan HMTIF-UNPAS.</p>
                    @endif
                </div>
            </div>
        </div>
    </x-molecules.pages.sections.page-hero>

    <section class="py-10 md:py-16 bg-section/30 min-h-screen">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">

            {{-- 2-Column Grid Starting from Image --}}
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-10 items-start">

                {{-- Left Column (Image + Details) --}}
                <div class="space-y-10">
                    <div
                        class="rounded-[2rem] overflow-hidden border border-slate-200 shadow-lg bg-slate-50 w-full h-[300px] md:h-[500px]">
                        <img src="{{ $heroImage }}" alt="{{ $activity->title }}" class="w-full h-full object-cover"
                            data-fallback-src="{{ asset('images/placeholders/activity.svg') }}">
                    </div>

                    <article class="bg-white rounded-[2rem] border border-slate-200 p-8 md:p-10 shadow-sm">
                        <h2 class="text-2xl font-black italic uppercase tracking-tighter text-heading mb-6">Rincian
                            Kegiatan</h2>
                        @if ($activity->body)
                            <div
                                class="prose prose-slate max-w-none prose-headings:font-black prose-headings:tracking-tight prose-a:text-primary">
                                {!! $activity->body !!}
                            </div>
                        @else
                            <p class="text-body/70 leading-relaxed">
                                {{ strip_tags($activity->description ?: 'Detail kegiatan belum tersedia.') }}
                            </p>
                        @endif
                    </article>
                </div>

                {{-- Right Column (Sidebar) --}}
                <aside class="space-y-6">
                    <div class="bg-white rounded-[2rem] border border-slate-200 p-6 shadow-sm">
                        <h3 class="text-sm font-black uppercase tracking-[0.2em] text-slate-400 mb-4">Informasi Singkat
                        </h3>
                        <div class="space-y-4 text-sm">
                            <div>
                                <div class="font-black text-slate-400 uppercase tracking-wide text-[10px] mb-1">Status
                                </div>
                                <div class="font-semibold text-heading">{{ $activity->status_label ?? '-' }}
                                </div>
                            </div>
                            <div>
                                <div class="font-black text-slate-400 uppercase tracking-wide text-[10px] mb-1">Tanggal
                                    Mulai</div>
                                <div class="font-semibold text-heading">
                                    {{ optional($activity->start_date)->translatedFormat('d M Y H:i') ?: '-' }}</div>
                            </div>
                            <div>
                                <div class="font-black text-slate-400 uppercase tracking-wide text-[10px] mb-1">Tanggal
                                    Selesai</div>
                                <div class="font-semibold text-heading">
                                    {{ optional($activity->end_date)->translatedFormat('d M Y H:i') ?: '-' }}</div>
                            </div>
                            <div>
                                <div class="font-black text-slate-400 uppercase tracking-wide text-[10px] mb-1">Lokasi
                                </div>
                                <div class="font-semibold text-heading">{{ $activity->location ?: '-' }}</div>
                            </div>
                            <div>
                                <div class="font-black text-slate-400 uppercase tracking-wide text-[10px] mb-1">
                                    Pendaftaran</div>
                                @if ($activity->registration_url)
                                    <a href="{{ $activity->registration_url }}"
                                        class="font-semibold text-primary hover:underline" target="_blank"
                                        rel="noopener noreferrer">Buka Link</a>
                                @else
                                    <div class="font-semibold text-heading">-</div>
                                @endif
                            </div>
                            <div>
                                <div class="font-black text-slate-400 uppercase tracking-wide text-[10px] mb-1">Dokumen
                                </div>
                                @if ($activity->file)
                                    <a href="{{ $activity->file }}" target="_blank" rel="noopener noreferrer"
                                        class="font-semibold text-primary hover:underline">Lihat Lampiran</a>
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
                            <x-atoms.shared.button :href="$activity->registration_url" variant="secondary" class="w-full"
                                target="_blank" rel="noopener noreferrer">
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