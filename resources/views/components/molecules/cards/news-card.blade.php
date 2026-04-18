@props([
    'image' => '/images/placeholders/announcement.svg',
    'title' => 'Judul Pengumuman',
    'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit...',
    'date' => null,
    'href' => '#',
])

<div onclick="window.location.href='{{ $href }}'"
    class="group relative bg-white rounded-lg border border-gray-100 shadow-md hover:shadow-xl transition-all duration-700 flex flex-col overflow-hidden hover:-translate-y-2 cursor-pointer reveal reveal-up h-full">
    <div class="relative aspect-video bg-section/50 overflow-hidden">
        <img src="{{ $image }}" alt="{{ $title }}" width="600" height="338" loading="lazy" decoding="async"
            fetchpriority="low"
            onerror="this.onerror=null;this.src='{{ asset('images/placeholders/announcement.svg') }}';"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
        <div
            class="absolute inset-0 bg-linear-to-t from-primary-dark/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
        </div>

        @if ($date)
            <div
                class="absolute top-4 right-4 px-3 py-1 bg-white/95 rounded-lg text-[10px] font-bold text-primary uppercase tracking-wider border border-primary/10 shadow-sm z-10">
                {{ $date }}
            </div>
        @endif
    </div>

    <div class="p-6 flex flex-col flex-1">
        <div class="flex items-center gap-2 mb-3">
            <span
                class="px-3 py-0.5 rounded-full bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest border border-primary/10">
                Pengumuman
            </span>
            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Terbaru</span>
        </div>

        <h3
            class="text-xl font-bold text-heading group-hover:text-primary transition-colors leading-tight mb-2 italic uppercase tracking-tighter line-clamp-2">
            {{ $title }}
        </h3>

        <p class="text-sm text-gray-500 leading-relaxed line-clamp-3 flex-1 mb-6">
            {{ $excerpt }}
        </p>

        <div class="inline-flex items-center gap-2 text-sm font-bold text-primary group/link">
            <span class="relative">
                Baca Selengkapnya
                <span
                    class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary group-hover/link:w-full transition-all duration-300"></span>
            </span>
            <x-heroicon-o-arrow-long-right class="size-4 group-hover/link:translate-x-1 transition-transform" />
        </div>
    </div>
</div>
