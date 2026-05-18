@props(['staff' => null])

@php
    $fallbackImage = asset('images/placeholders/member.svg');
@endphp

<section class="py-8 md:py-10">
    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
        @if ($staff)
            <x-organisms.pages.staff-detail.content :staff="$staff" :fallback-image="$fallbackImage" />
        @else
            <x-organisms.pages.staff-detail.empty />
        @endif
    </div>
</section>

