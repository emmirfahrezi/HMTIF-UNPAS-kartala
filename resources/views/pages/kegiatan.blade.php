<x-layout title="Kegiatan & Program Kerja" :transparent="false">
    {{-- Hero Section --}}
    <section class="relative pt-40 pb-24 overflow-hidden bg-white">
        <div class="absolute inset-0 z-0 opacity-10">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 0 L100 0 L100 100 L0 100 Z" fill="none" stroke="currentColor" stroke-width="1"
                    class="text-primary" />
                <path d="M0 0 L100 100" stroke="currentColor" stroke-width="0.5" class="text-primary" />
            </svg>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span
                class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-[0.3em] uppercase mb-6">Program
                Kerja</span>
            <h1 class="text-4xl md:text-7xl font-black text-heading mb-6 uppercase italic tracking-tighter">
                Aksi <span class="text-primary">Kartala</span>
            </h1>
            <p class="text-body/40 max-w-2xl mx-auto text-lg lowercase tracking-widest font-light leading-relaxed">
                eksplorasi rangkaian agenda dan inovasi program kerja hmtif unpas. teknik informatika progresif.
            </p>
        </div>
    </section>

    {{-- Filter & Search Bar (Sticky & Refined) --}}
    <section class="sticky top-[84px] z-30 bg-white/70 backdrop-blur-xl border-y border-gray-100 py-4 shadow-sm">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex gap-2 overflow-x-auto pb-1 no-scrollbar w-full md:w-auto">
                    @foreach (['Semua', 'Internal', 'Eksternal', 'Akademik'] as $filter)
                        <button
                            class="shrink-0 px-6 py-2 rounded-lg {{ $filter == 'Semua' ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'bg-gray-50 text-gray-500 hover:bg-primary/10 hover:text-primary border border-transparent hover:border-primary/20' }} text-sm font-bold transition-all">
                            {{ $filter }}
                        </button>
                    @endforeach
                </div>
                <div class="relative w-full md:w-80">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <x-heroicon-o-magnifying-glass class="size-5 text-gray-400" />
                    </div>
                    <input type="text"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-100 rounded-lg bg-gray-50/50 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all font-medium"
                        placeholder="Cari info kegiatan...">
                </div>
            </div>
        </div>
    </section>

    {{-- Program List Grid --}}
    <section class="py-24 bg-section/30">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                    ['title' => 'Informatics Championship', 'date' => '20 Okt 2024', 'type' => 'Akademik', 'icon' => 'trophy'],
                    ['title' => 'LDKM Informatika', 'date' => '05 Nov 2024', 'type' => 'Internal', 'icon' => 'user-group'],
                    ['title' => 'Tech Talks 4.0', 'date' => '15 Des 2024', 'type' => 'Eksternal', 'icon' => 'presentation-chart-line'],
                    ['title' => 'Informatics Care', 'date' => '12 Jan 2025', 'type' => 'Eksternal', 'icon' => 'heart'],
                    ['title' => 'Internal Fun Match', 'date' => '20 Feb 2025', 'type' => 'Internal', 'icon' => 'puzzle-piece'],
                    ['title' => 'Project Showcase', 'date' => '10 Mar 2025', 'type' => 'Akademik', 'icon' => 'light-bulb'],
                ] as $item)
                <div class="group relative bg-white rounded-lg border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-500 flex flex-col overflow-hidden hover:-translate-y-2">
                    {{-- Card Background Decoration --}}
                    <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-primary to-primary-soft opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    
                    {{-- Thumbnail Wrapper --}}
                    <div class="relative h-48 bg-primary/5 flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent"></div>
                        <div class="relative z-10 w-16 h-16 bg-white rounded-lg shadow-lg flex items-center justify-center text-primary group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 ring-1 ring-black/5">
                            <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="size-8" />
                        </div>
                        <div class="absolute top-4 right-4 px-3 py-1 bg-white/90 backdrop-blur-md rounded-lg text-[10px] font-bold text-primary uppercase tracking-wider border border-primary/10 shadow-sm">
                            {{ $item['type'] }}
                        </div>
                    </div>

                    <div class="p-8 flex flex-col flex-1">
                        <div class="flex items-center gap-2 text-[10px] text-primary font-bold uppercase tracking-widest mb-3">
                            <x-heroicon-s-calendar class="size-3" />
                            {{ $item['date'] }}
                        </div>
                        <h3 class="text-xl font-bold text-heading mb-4 group-hover:text-primary transition-colors leading-tight">{{ $item['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed mb-6 flex-1">
                            Program strategis berskala {{ strtolower($item['type']) }} yang berfokus pada pengembangan mahasiswa Teknik Informatika UNPAS.
                        </p>
                        <a href="/detail-kegiatan" class="inline-flex items-center gap-2 text-sm font-bold text-primary group/link">
                            <span class="relative">
                                Selengkapnya
                                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary group-hover/link:w-full transition-all duration-300"></span>
                            </span>
                            <x-heroicon-o-arrow-long-right class="size-4 group-hover/link:translate-x-1 transition-transform" />
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Load More Section --}}
            <div class="mt-20 flex flex-col items-center">
                <div class="h-px w-24 bg-gray-200 mb-8"></div>
                <x-atoms.button variant="outline" class="px-12 py-3.5 font-bold border-gray-200 text-heading hover:border-primary hover:text-primary rounded-lg transition-all shadow-sm">
                    Tampilkan Semua Kegiatan
                </x-atoms.button>
            </div>
        </div>
    </section>
</x-layout>
