@props(['staff' => null])

@php
    $fallbackImage = asset('images/placeholders/member.svg');
@endphp

<section class="py-8 md:py-10">
    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
        <a href="/staff"
            class="inline-flex items-center gap-2 text-primary font-bold text-sm hover:translate-x-1 transition-transform group mb-6">
            <x-heroicon-o-arrow-left class="size-4" />
            Kembali ke Daftar Pengurus
        </a>

        @if ($staff)
            <x-organisms.pages.detail-member.content :staff="$staff" :fallback-image="$fallbackImage" />
        @else
            <x-organisms.pages.detail-member.empty />
        @endif
    </div>
</section>
