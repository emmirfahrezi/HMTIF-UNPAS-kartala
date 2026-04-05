    {{-- Program List Grid --}}
    <section class="py-24 bg-section/30">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php $delay = 1; @endphp
                @foreach([
                    ['title' => 'Informatics Championship', 'date' => '20 Okt 2024', 'type' => 'Akademik', 'image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=1200&auto=format&fit=crop'],
                    ['title' => 'LDKM Informatika', 'date' => '05 Nov 2024', 'type' => 'Internal', 'image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200&auto=format&fit=crop'],
                    ['title' => 'Tech Talks 4.0', 'date' => '15 Des 2024', 'type' => 'Eksternal', 'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1200&auto=format&fit=crop'],
                    ['title' => 'Informatics Care', 'date' => '12 Jan 2025', 'type' => 'Eksternal', 'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1200&auto=format&fit=crop'],
                    ['title' => 'Internal Fun Match', 'date' => '20 Feb 2025', 'type' => 'Internal', 'image' => 'https://images.unsplash.com/photo-1511886929837-354d827aae26?q=80&w=1200&auto=format&fit=crop'],
                    ['title' => 'Project Showcase', 'date' => '10 Mar 2025', 'type' => 'Akademik', 'image' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?q=80&w=1200&auto=format&fit=crop'],
                ] as $item)
                <div class="group relative bg-white rounded-lg border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-700 flex flex-col overflow-hidden hover:-translate-y-2 reveal reveal-up reveal-delay-{{ $delay++ }}">
                    {{-- Card Background Decoration --}}
                    <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-primary to-primary-soft opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    
                    {{-- Thumbnail Wrapper --}}
                    <div class="relative h-56 bg-primary/5 flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center group-hover:scale-110 transition-transform duration-700 ease-in-out" style="background-image: url('{{ $item['image'] }}');"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-dark/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="absolute top-4 right-4 px-3 py-1 bg-white/90 backdrop-blur-md rounded-lg text-[10px] font-bold text-primary uppercase tracking-wider border border-primary/10 shadow-sm z-10">
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
