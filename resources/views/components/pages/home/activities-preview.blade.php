<div class="py-24 bg-section/30 relative overflow-hidden">
    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="max-w-2xl reveal reveal-left">
                <x-atoms.section-title>Agenda Terdekat</x-atoms.section-title>
                <h2 class="text-3xl md:text-4xl font-extrabold text-heading mt-4 leading-tight uppercase italic tracking-tighter">
                    Jangan Lewatkan <span class="text-primary text-2xl md:text-4xl">Momentum Seru Kami</span>
                </h2>
            </div>
            <a href="/activities" class="group flex items-center gap-2 text-primary font-bold hover:gap-4 transition-all reveal reveal-right">
                Lihat Semua Kegiatan
                <x-heroicon-o-arrow-right class="size-5" />
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php $delay = 1; @endphp
            @foreach ([
                ['title' => 'Informatics Championship', 'date' => '24 Mei 2024', 'type' => 'Internal', 'image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=1200&auto=format&fit=crop'],
                ['title' => 'Webinar Tech Update', 'date' => '12 Juni 2024', 'type' => 'Akademik', 'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1200&auto=format&fit=crop'],
                ['title' => 'Abdi Masyarakat', 'date' => '15 Juli 2024', 'type' => 'Eksternal', 'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1200&auto=format&fit=crop']
            ] as $item)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:-translate-y-2 transition-all duration-700 reveal reveal-up reveal-delay-{{ $delay++ }}">
                    <div class="relative h-48 overflow-hidden animate-shimmer">
                        <div class="absolute inset-0 animate-shimmer"></div>
                        <img src="{{ $item['image'] }}" class="relative w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Poster Kegiatan: {{ $item['title'] }}" width="400" height="300">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-md text-primary text-[10px] font-black uppercase tracking-widest rounded-lg shadow-sm border border-primary/10 italic">
                                {{ $item['type'] }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="relative inline-flex items-center gap-2 mb-2">
                            <div class="absolute inset-0 bg-gray-50 animate-shimmer rounded-md"></div>
                            <div class="relative z-10 flex items-center gap-2 text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                                <x-heroicon-o-calendar class="size-3" />
                                {{ $item['date'] }}
                            </div>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-x-0 inset-y-1 bg-gray-50 animate-shimmer rounded-md"></div>
                            <h3 class="relative z-10 text-xl font-bold text-heading group-hover:text-primary transition-colors italic uppercase tracking-tighter mb-4">
                                {{ $item['title'] }}
                            </h3>
                        </div>
                        <a href="/activity-detail" class="text-sm font-bold text-gray-400 group-hover:text-primary flex items-center gap-1 transition-all" aria-label="Lihat detail kegiatan {{ $item['title'] }}">
                            Detail Info
                            <x-heroicon-o-chevron-right class="size-4 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all" aria-hidden="true" />
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
