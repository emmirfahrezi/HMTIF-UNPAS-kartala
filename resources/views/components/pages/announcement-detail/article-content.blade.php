@props(['announcement'])

@php
    $thumbnail = (string) ($announcement?->thumbnail ?? '');
    $isLocalThumbnail =
        $thumbnail !== '' && \Illuminate\Support\Str::startsWith($thumbnail, ['/', 'storage/', 'images/', url('/')]);
    $announcementImage = $isLocalThumbnail ? $thumbnail : asset('images/placeholders/announcement.svg');
@endphp

{{-- Main Article Content --}}
<div class="lg:col-span-2 space-y-12 reveal reveal-up">
    <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-video border-8 border-white bg-white">
        <img src="{{ $announcementImage }}" alt="Thumbnail Pengumuman Resmi HMTIF UNPAS" class="w-full h-full object-cover"
            onerror="this.onerror=null;this.src='{{ asset('images/placeholders/announcement.svg') }}';">
    </div>

    <div class="prose prose-lg max-w-none text-body leading-relaxed space-y-6">
        <p class="font-bold text-xl text-heading italic uppercase tracking-tighter">
            {{ $announcement?->excerpt ?: 'Informasi terbaru dari HMTIF UNPAS.' }}
        </p>
        <p>
            {{ $announcement?->body ?: 'Belum ada detail pengumuman tersedia.' }}
        </p>
    </div>

    <div class="pt-8 border-t border-gray-100 flex items-center gap-4">
        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Share ke teman:</span>
        <div class="flex gap-2">
            @foreach (['chat-bubble-bottom-center-text', 'share'] as $icon)
                <button
                    class="size-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-primary hover:border-primary transition-all">
                    <x-dynamic-component :component="'heroicon-o-' . $icon" class="size-4" />
                </button>
            @endforeach
        </div>
    </div>
</div>
