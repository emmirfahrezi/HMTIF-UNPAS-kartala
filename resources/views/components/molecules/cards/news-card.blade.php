@props([
    'image' => 'https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-4.0.3&q=80&w=600',
    'title' => 'Judul Pengumuman',
    'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit...',
    'date' => null,
    'href' => '#',
])

<div onclick="window.location.href='{{ $href }}'" 
    class="bg-white border border-border rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 group flex flex-col h-full cursor-pointer">
    {{-- Thumbnail --}}
    <div class="relative overflow-hidden aspect-video">
        <img src="{{ $image }}" 
             alt="{{ $title }}" 
             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
        <div class="absolute inset-0 bg-gradient-to-t from-primary-dark/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    </div>

    {{-- Content --}}
    <div class="p-6 flex flex-col flex-1">
        @if($date)
            <span class="text-xs font-semibold text-primary uppercase tracking-wider mb-2">
                {{ $date }}
            </span>
        @endif
        
        <h3 class="text-xl font-bold text-heading group-hover:text-primary transition-colors duration-300 line-clamp-2 mb-3">
            {{ $title }}
        </h3>
        
        <p class="text-body text-sm line-clamp-3 mb-6 flex-1">
            {{ $excerpt }}
        </p>

        <div class="mt-auto">
            <x-atoms.button variant="outline" class="w-full text-sm py-2">
                Selengkapnya
                <x-heroicon-o-arrow-right class="h-4 w-4 group-hover:translate-x-1 transition-transform" />
            </x-atoms.button>
        </div>
    </div>
</div>
