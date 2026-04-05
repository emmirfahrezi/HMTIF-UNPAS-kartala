<x-layout 
    title="Kegiatan & Program Kerja | HMTIF UNPAS" 
    description="Jelajahi berbagai program kerja dan kegiatan inovatif HMTIF UNPAS. Dari kompetisi teknologi hingga pengabdian masyarakat untuk mahasiswa Informatika."
    keywords="Kegiatan HMTIF, Proker HMTIF, Informatics Championship, Event Teknik Informatika"
    :transparent="false"
>
    <x-slot:head>
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "BreadcrumbList",
            "itemListElement": [{
                "@@type": "ListItem",
                "position": 1,
                "name": "Beranda",
                "item": "{{ url('/') }}"
            },{
                "@@type": "ListItem",
                "position": 2,
                "name": "Kegiatan",
                "item": "{{ url()->current() }}"
            }]
        }
        </script>
    </x-slot:head>
    {{-- Hero Section --}}
    {{-- Hero Section --}}
    <x-molecules.sections.page-hero 
        badge="Informasi Program"
        title="Aksi"
        highlight="Kartala"
        description="eksplorasi rangkaian agenda dan inovasi program kerja hmtif unpas. teknik informatika progresif."
    />
    
    {{-- Upcoming Highlight Timeline --}}
    <section class="py-16 bg-section/30 overflow-hidden">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="flex items-center gap-4 mb-10 overflow-hidden">
                <span class="w-12 h-px bg-primary/20"></span>
                <h2 class="text-xl font-black text-heading italic uppercase tracking-tighter">Timeline <span class="text-primary italic">Mendatang</span></h2>
                <span class="flex-1 h-px bg-gray-100 italic font-black uppercase tracking-widest text-[10px]">Geser untuk melihat agenda >></span>
            </div>

            <div class="flex gap-6 overflow-x-auto pb-8 no-scrollbar -mx-4 px-4 snap-x snap-mandatory">
                @foreach([
                    ['month' => 'OKT', 'day' => '24', 'title' => 'Informatics Championship', 'status' => 'Main Event', 'color' => 'primary'],
                    ['month' => 'NOV', 'day' => '05', 'title' => 'LDKM 2024: Kartala Generation', 'status' => 'Internal', 'color' => 'blue'],
                    ['month' => 'DES', 'day' => '15', 'title' => 'Tech Talk: AI Evolution', 'status' => 'Webinar', 'color' => 'purple'],
                    ['month' => 'JAN', 'day' => '12', 'title' => 'Informatics Care: Bakti Sosial', 'status' => 'Community', 'color' => 'red'],
                ] as $timeline)
                <div class="shrink-0 w-80 snap-center">
                    <div class="group bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-500 relative overflow-hidden">
                         <div class="absolute top-0 right-0 w-32 h-32 bg-{{ $timeline['color'] == 'primary' ? 'primary' : $timeline['color'] . '-500' }}/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700"></div>
                         
                         <div class="flex items-start justify-between mb-8">
                             <div class="relative flex flex-col items-center">
                                 <div class="absolute inset-x-0 -inset-y-1 bg-gray-50 animate-shimmer rounded-md"></div>
                                 <span class="relative z-10 text-xs font-black text-primary uppercase tracking-widest">{{ $timeline['month'] }}</span>
                                 <span class="relative z-10 text-4xl font-black text-heading tracking-tighter">{{ $timeline['day'] }}</span>
                             </div>
                             <span class="px-3 py-1 bg-gray-50 border border-gray-100 rounded-lg text-[9px] font-black uppercase tracking-widest text-gray-400 group-hover:bg-primary group-hover:text-white transition-all">
                                 {{ $timeline['status'] }}
                             </span>
                         </div>
                         
                         <div class="flex flex-col gap-1 mb-4">
                            <div class="relative">
                                <div class="absolute inset-x-0 inset-y-1 bg-gray-50 animate-shimmer rounded-md"></div>
                                <h2 class="relative z-10 font-bold text-heading text-lg group-hover:text-primary transition-colors line-clamp-1 leading-tight italic uppercase tracking-tighter">{{ $timeline['title'] }}</h2>
                            </div>
                         </div>
                         <div class="flex items-center gap-2">
                             <div class="w-2 h-2 rounded-full bg-{{ $timeline['color'] == 'primary' ? 'primary' : $timeline['color'] . '-500' }}"></div>
                             <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest group-hover:text-gray-600 transition-colors">Terkonfirmasi</span>
                         </div>
                    </div>
                </div>
                @endforeach
            </div>
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
                        <div class="relative inline-flex items-center gap-2 mb-3">
                            <div class="absolute inset-0 bg-gray-50 animate-shimmer rounded-md"></div>
                            <div class="relative z-10 flex items-center gap-2 text-[10px] text-primary font-bold uppercase tracking-widest leading-none">
                                <x-heroicon-s-calendar class="size-3" />
                                {{ $item['date'] }}
                            </div>
                        </div>
                        <div class="relative mb-4">
                            <div class="absolute inset-x-0 inset-y-1 bg-gray-50 animate-shimmer rounded-md"></div>
                            <h2 class="relative z-10 text-xl font-bold text-heading group-hover:text-primary transition-colors leading-tight">{{ $item['title'] }}</h2>
                        </div>
                        <div class="relative mb-6 flex-1">
                            <div class="absolute inset-0 bg-gray-50 animate-shimmer rounded-md"></div>
                            <p class="relative z-10 text-sm text-gray-500 leading-relaxed">
                                Program strategis berskala {{ strtolower($item['type']) }} yang berfokus pada pengembangan mahasiswa Teknik Informatika UNPAS.
                            </p>
                        </div>
                        <a href="/activity-detail" class="inline-flex items-center gap-2 text-sm font-bold text-primary group/link">
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
