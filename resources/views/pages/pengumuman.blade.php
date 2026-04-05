<x-layout title="Pengumuman" :transparent="false">
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
                class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-[0.3em] uppercase mb-6 uppercase">Pusat
                Informasi</span>
            <h1 class="text-4xl md:text-7xl font-black text-heading mb-6 uppercase italic tracking-tighter">
                Warta <span class="text-primary">Kartala</span>
            </h1>
            <p class="text-body/40 max-w-2xl mx-auto text-lg lowercase tracking-widest font-light leading-relaxed">
                tetap terupdate dengan informasi kegiatan, akademik, dan berita terbaru dari hmtif unpas. teknik informatika progresif.
            </p>
        </div>
    </section>

    <div class="bg-section/30 py-16">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            {{-- Search & Filter Strip --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 mb-16">
                <div class="flex items-center gap-4">
                    <div class="h-8 w-2 bg-primary rounded-full"></div>
                    <h2 class="text-heading font-black text-3xl uppercase tracking-tighter italic">Pengumuman <span class="text-primary">Terbaru</span></h2>
                </div>
                
                {{-- Refined Search Bar --}}
                <div class="w-full md:w-96">
                    <form action="" class="relative group">
                        <input type="text" placeholder="Cari info kegiatan..." 
                            class="w-full pl-12 pr-4 py-3.5 rounded-lg bg-white border border-gray-100 focus:ring-2 focus:ring-primary/20 text-sm transition-all shadow-sm group-hover:shadow-md">
                        <x-heroicon-o-magnifying-glass class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-gray-400 group-focus-within:text-primary transition-colors" />
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                {{-- Main Content --}}
                <div class="lg:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @php
                            $news = [
                                ['title' => 'Musyawarah Besar HMTIF 2026', 'date' => '15 APR 2026', 'img' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846'],
                                ['title' => 'Open Recruitment Panitia Makrab', 'date' => '02 MEI 2026', 'img' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d'],
                                ['title' => 'Workshop UI/UX bersama Google Developer', 'date' => '20 MEI 2026', 'img' => 'https://images.unsplash.com/photo-1542744094-24638eff58bb'],
                                ['title' => 'Pendaftaran Lomba Coding Nasional', 'date' => '01 JUN 2026', 'img' => 'https://images.unsplash.com/photo-1516116216624-53e697fedbea'],
                            ];
                        @endphp

                        @foreach($news as $item)
                            <x-molecules.cards.news-card :title="$item['title']" :date="$item['date']" :image="$item['img']"
                                excerpt="Persiapkan dirimu untuk agenda besar HMTIF yang akan diselenggarakan bulan depan. Jangan sampai terlewatkan informasi penting ini." />
                        @endforeach
                    </div>

                    {{-- Pagination Placeholder --}}
                    <div class="mt-12 flex justify-center">
                        <nav class="flex gap-2">
                            <x-atoms.button variant="soft" class="w-10 h-10 p-0 text-sm">1</x-atoms.button>
                            <x-atoms.button variant="outline" class="w-10 h-10 p-0 text-sm">2</x-atoms.button>
                            <x-atoms.button variant="outline" class="w-10 h-10 p-0 text-sm">3</x-atoms.button>
                        </nav>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-8">
                    <div class="bg-white p-6 rounded-2xl border border-border shadow-sm">
                        <h4 class="font-bold text-heading mb-4 pb-2 border-b-2 border-primary-soft">Kategori</h4>
                        <ul class="space-y-3">
                            <li><a href="#"
                                    class="text-body hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary/40"></span> Akademik
                                </a></li>
                            <li><a href="#"
                                    class="text-body hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary/40"></span> Kemahasiswaan
                                </a></li>
                            <li><a href="#"
                                    class="text-body hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary/40"></span> Lomba & Kompetisi
                                </a></li>
                            <li><a href="#"
                                    class="text-body hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary/40"></span> Organisasi
                                </a></li>
                        </ul>
                    </div>

                    <div class="bg-primary p-6 rounded-2xl text-white shadow-lg shadow-primary/20">
                        <h4 class="font-bold text-lg mb-2">Ingin berkontribusi?</h4>
                        <p class="text-white/80 text-sm mb-4 italic">Kirimkan aspirasimu melalui form resmi HMTIF UNPAS.
                        </p>
                        <x-atoms.button variant="outline"
                            class="w-full border-white text-white hover:bg-white hover:text-primary py-2 text-sm">
                            Kirim Aspirasi
                        </x-atoms.button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>