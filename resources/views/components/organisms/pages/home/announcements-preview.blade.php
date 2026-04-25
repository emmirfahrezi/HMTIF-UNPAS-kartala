<div class="py-24 bg-white relative overflow-hidden content-auto">
    @props(['announcements'])

    {{-- Decorative SVG --}}
    <div class="absolute top-0 right-0 h-full w-1/3 opacity-5 pointer-events-none">
        <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M100 0 L100 100 L0 100 Z" fill="currentColor" class="text-secondary" />
        </svg>
    </div>

    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10">
        <div class="text-center mb-16">
            <x-atoms.pages.section-title align="center">Informasi Terkini</x-atoms.section-title>
            <h2 class="text-3xl md:text-5xl font-extrabold text-heading mt-4 italic uppercase tracking-tighter">
                Pengumuman <span class="text-primary">Penting & Terbaru</span>
            </h2>
            <div class="w-24 h-1 bg-primary/20 mx-auto mt-6 rounded-full overflow-hidden">
                <div class="w-12 h-full bg-primary animate-pulse"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @php $delay = 1; @endphp
            @foreach ($announcements as $news)
                <div
                    class="group flex flex-col sm:flex-row items-center gap-6 p-6 rounded-4xl bg-gray-50/50 border border-gray-100 hover:bg-white hover:shadow-xl hover:border-primary/20 transition-all duration-700 reveal reveal-up reveal-delay-{{ $delay++ }}">
                    <div
                        class="shrink-0 w-20 h-20 bg-white rounded-2xl shadow-md flex flex-col items-center justify-center border border-gray-50 group-hover:bg-primary group-hover:text-white transition-all transform group-hover:-rotate-6">
                        <span class="text-2xl font-black italic">{{ optional($news->published_at)->format('d') }}</span>
                        <span
                            class="text-[10px] uppercase font-bold tracking-widest">{{ optional($news->published_at)->format('M') }}</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <span
                                class="px-3 py-0.5 rounded-full bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest border border-primary/10">
                                {{ optional($news->category)->name ?? 'Umum' }}
                            </span>
                            <span
                                class="text-[10px] text-gray-400 font-bold uppercase tracking-wildest">Terkonfirmasi</span>
                        </div>
                        <h3
                            class="text-xl font-bold text-heading group-hover:text-primary transition-colors leading-tight mb-2 italic uppercase tracking-tighter">
                            {{ $news->title }}</h3>
                        <p class="text-sm text-gray-400 line-clamp-1">Klik untuk membaca rincian pengumuman secara
                            lengkap...</p>
                    </div>
                    <div class="shrink-0">
                        <a href="{{ route('announcements.show', $news->slug) }}"
                            class="w-12 h-12 rounded-full border border-gray-100 flex items-center justify-center text-gray-300 group-hover:bg-primary group-hover:text-white group-hover:border-primary transition-all"
                            aria-label="Baca pengumuman: {{ $news->title }}">
                            <x-heroicon-o-arrow-right class="size-5" aria-hidden="true" />
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($announcements->isEmpty())
            <p class="text-sm text-body/60 mt-8 text-center">Belum ada pengumuman. Jalankan seeder untuk menampilkan
                data.</p>
        @endif

        <div class="mt-12 text-center">
            <x-atoms.pages.button variant="outline" class="group h-14 px-10 rounded-full transition-all"
                data-nav-target="{{ route('announcements') }}">
                <span>Lihat Seluruh Arsip</span>
                <x-heroicon-o-document-duplicate class="size-5 opacity-50 group-hover:opacity-100 transition-opacity" />
            </x-atoms.button>
        </div>
    </div>
</div>
