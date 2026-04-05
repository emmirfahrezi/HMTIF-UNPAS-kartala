    {{-- Main Content (Search & Grid) --}}
    <div class="lg:col-span-3">
        {{-- Search & Title --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 mb-16">
            <div class="flex items-center gap-4">
                <div class="h-8 w-2 bg-primary rounded-full"></div>
                <h2 class="text-heading font-black text-3xl uppercase tracking-tighter italic">Pengumuman <span class="text-primary">Terbaru</span></h2>
            </div>
            
            <div class="w-full md:w-96">
                <form action="" class="relative group">
                    <input type="text" placeholder="Cari info kegiatan..." 
                        class="w-full pl-12 pr-4 py-3.5 rounded-lg bg-white border border-gray-100 focus:ring-2 focus:ring-primary/20 text-sm transition-all shadow-sm group-hover:shadow-md">
                    <x-heroicon-o-magnifying-glass class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-gray-400 group-focus-within:text-primary transition-colors" />
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php
                $news = [
                    ['title' => 'Musyawarah Besar HMTIF 2026', 'date' => '15 APR 2026', 'img' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846'],
                    ['title' => 'Open Recruitment Panitia Makrab', 'date' => '02 MEI 2026', 'img' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d'],
                    ['title' => 'Workshop UI/UX bersama Google Developer', 'date' => '20 MEI 2026', 'img' => 'https://images.unsplash.com/photo-1542744094-24638eff58bb'],
                    ['title' => 'Pendaftaran Lomba Coding Nasional', 'date' => '01 JUN 2026', 'img' => 'https://images.unsplash.com/photo-1516116216624-53e697fedbea'],
                ];
                $delay = 1;
            @endphp

            @foreach($news as $item)
                <x-molecules.cards.news-card 
                    :title="$item['title']" 
                    :date="$item['date']" 
                    :image="$item['img']"
                    href="/announcement-detail"
                    class="reveal-delay-{{ $delay++ }}"
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
