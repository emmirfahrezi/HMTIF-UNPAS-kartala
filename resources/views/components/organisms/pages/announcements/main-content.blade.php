    {{-- Main Content (Search & Grid) --}}
    <div class="lg:col-span-3">
        @props(['announcements'])

        @php
            $search = trim((string) request('q', ''));
            $news = $announcements;
        @endphp

        {{-- Search & Title --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 mb-16">
            <div class="flex items-center gap-4">
                <div class="h-8 w-2 bg-primary rounded-full"></div>
                <h2 class="text-heading font-black text-3xl uppercase tracking-tighter italic">Pengumuman <span
                        class="text-primary">Terbaru</span></h2>
            </div>

            <div class="w-full md:w-96">
                <form action="" method="GET" class="relative group">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari info kegiatan..."
                        class="w-full pl-12 pr-4 py-3.5 rounded-lg bg-white border border-gray-100 focus:ring-2 focus:ring-primary/20 text-sm transition-all shadow-sm group-hover:shadow-md">
                    <x-heroicon-o-magnifying-glass
                        class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-gray-400 group-focus-within:text-primary transition-colors" />
                </form>
            </div>
        </div>

        <div id="announcement-grid" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php $delay = 1; @endphp
            @forelse ($news as $item)
                @php
                    $thumbnail = (string) ($item->thumbnail ?? '');
                    $isLocalThumbnail =
                        $thumbnail !== '' &&
                        \Illuminate\Support\Str::startsWith($thumbnail, ['/', 'storage/', 'images/', url('/')]);
                    $announcementImage = $isLocalThumbnail ? $thumbnail : asset('images/placeholders/announcement.svg');
                @endphp
                <x-molecules.pages.cards.news-card :title="$item->title" :date="optional($item->published_at)->translatedFormat('d M Y')" :image="$announcementImage" :href="'/announcement-detail'"
                    class="reveal-delay-{{ $delay++ }}" :excerpt="$item->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($item->body), 120)" />
            @empty
                <div class="md:col-span-2 rounded-2xl border border-dashed border-gray-200 bg-white p-8 text-center">
                    <p class="text-sm text-body/60">Belum ada pengumuman yang tersedia. Jalankan seeder untuk
                        menampilkan data.</p>
                </div>
            @endforelse
        </div>

        <div id="announcement-load-more-container" class="mt-12 flex justify-center">
            @if ($news->hasMorePages())
                <a id="announcement-load-more" href="{{ $news->nextPageUrl() }}"
                    class="inline-flex items-center gap-2 px-8 py-3.5 rounded-lg border border-gray-200 bg-white text-heading font-bold text-sm hover:border-primary hover:text-primary transition-all shadow-sm">
                    Muat Lebih Banyak
                    <x-heroicon-o-arrow-down class="size-4" />
                </a>
            @elseif ($news->count() > 0)
                <span class="text-xs font-bold uppercase tracking-widest text-body/50">Semua pengumuman sudah
                    ditampilkan</span>
            @endif
        </div>



    </div>
