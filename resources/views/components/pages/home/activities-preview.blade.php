<div class="py-24 bg-section/30 relative overflow-hidden content-auto">
    @php
        $activities = \App\Models\Activity::query()
            ->orderByRaw("CASE status WHEN 'upcoming' THEN 1 WHEN 'ongoing' THEN 2 ELSE 3 END")
            ->orderBy('start_date')
            ->take(2)
            ->get();

        $statusLabels = [
            'upcoming' => 'Mendatang',
            'ongoing' => 'Berjalan',
            'past' => 'Selesai',
        ];
    @endphp

    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="max-w-2xl reveal reveal-left">
                <x-atoms.section-title>Agenda Terdekat</x-atoms.section-title>
                <h2
                    class="text-3xl md:text-4xl font-extrabold text-heading mt-4 leading-tight uppercase italic tracking-tighter">
                    Jangan Lewatkan <span class="text-primary text-2xl md:text-4xl">Momentum Seru Kami</span>
                </h2>
            </div>
            <a href="/activities"
                class="group inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-border text-heading font-bold hover:bg-primary hover:text-white hover:border-primary hover:gap-3 transition-all reveal reveal-right">
                Lihat Semua Kegiatan
                <x-heroicon-o-arrow-right class="size-5" />
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php $delay = 1; @endphp
            @foreach ($activities as $item)
                @php
                    $thumbnail = (string) ($item->thumbnail ?? '');
                    $isLocalThumbnail =
                        $thumbnail !== '' &&
                        \Illuminate\Support\Str::startsWith($thumbnail, ['/', 'storage/', 'images/', url('/')]);
                    $activityImage = $isLocalThumbnail ? $thumbnail : asset('images/placeholders/activity.svg');
                @endphp
                <div
                    class="group bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:-translate-y-2 transition-all duration-700 reveal reveal-up reveal-delay-{{ $delay++ }}">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $activityImage }}"
                            class="relative w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            alt="Poster Kegiatan: {{ $item->title }}" width="400" height="300" loading="lazy"
                            decoding="async"
                            onerror="this.onerror=null;this.src='{{ asset('images/placeholders/activity.svg') }}';">
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1 bg-white/90 backdrop-blur-md text-primary text-[10px] font-black uppercase tracking-widest rounded-lg shadow-sm border border-primary/10 italic">
                                {{ $statusLabels[$item->status] ?? 'Kegiatan' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div
                            class="inline-flex items-center gap-2 mb-2 text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                            <x-heroicon-o-calendar class="size-3" />
                            {{ optional($item->start_date)->translatedFormat('d M Y') }}
                        </div>
                        <h3
                            class="text-xl font-bold text-heading group-hover:text-primary transition-colors italic uppercase tracking-tighter mb-4">
                            {{ $item->title }}
                        </h3>
                        <a href="/activity-detail"
                            class="text-sm font-bold text-gray-400 group-hover:text-primary flex items-center gap-1 transition-all"
                            aria-label="Lihat detail kegiatan {{ $item->title }}">
                            Detail Info
                            <x-heroicon-o-chevron-right
                                class="size-4 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all"
                                aria-hidden="true" />
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($activities->isEmpty())
            <p class="text-sm text-body/60 mt-8">Belum ada kegiatan. Jalankan seeder untuk menampilkan data.</p>
        @endif
    </div>
</div>
