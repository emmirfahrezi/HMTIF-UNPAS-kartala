@props([
    'name',
    'position',
    'image' => '/images/placeholders/member.svg',
    'size' => 'normal', // xl, lg, normal
    'dept' => '',
    'href' => null,
])
@php
    $sizeClasses = 'h-[500px] md:h-[600px]';

    $fallbackImage = asset('images/placeholders/member.svg');
    $imageSrc = blank($image) ? $fallbackImage : $image;

    $textClasses = match ($size) {
        'xl' => 'text-3xl md:text-5xl',
        'lg' => 'text-2xl md:text-4xl',
        'normal' => 'text-xl md:text-3xl',
        default => 'text-xl',
    };
@endphp

<div class="reveal reveal-up h-full">
    @if ($href)
        <a href="{{ $href }}"
            class="group relative overflow-hidden rounded-lg bg-section shadow-md transition-all duration-700 md:hover:-translate-y-3 border border-gray-100 md:hover:border-primary {{ $sizeClasses }} block h-full">
        @else
            <div
                class="group relative overflow-hidden rounded-lg bg-section shadow-md transition-all duration-700 md:hover:-translate-y-3 border border-gray-100 md:hover:border-primary {{ $sizeClasses }} h-full">
    @endif

{{-- Intense Green Inner Shadow --}}
<div
    class="absolute inset-0 z-20 pointer-events-none shadow-[inset_0_0_40px_rgba(36,130,50,0.2)] ring-1 ring-inset ring-primary/5 md:group-hover:shadow-[inset_0_0_56px_rgba(36,130,50,0.3)] transition-all duration-700 delay-100 md:delay-0 md:group-hover:delay-0">
</div>


{{-- Member Image --}}
<div class="absolute inset-0 z-10 overflow-hidden animate-shimmer">
    <img src="{{ $imageSrc }}" alt="{{ $name }}"
        class="relative h-full w-full object-cover object-top transition-all duration-1000 md:group-hover:scale-110"
        loading="lazy" decoding="async" fetchpriority="low" width="400" height="600"
        data-fallback-src="{{ $fallbackImage }}">
    {{-- Elegant Fade Overlay --}}
    <div
        class="absolute inset-0 bg-linear-to-t from-white via-white/20 to-transparent opacity-95 md:group-hover:opacity-80 transition-opacity duration-700">
    </div>
</div>

{{-- Dept Vertical Label (Subtle Branding) --}}
<div class="absolute top-10 right-6 z-20">
    @if ($dept)
        <span class="text-6xl font-black text-primary/5 tracking-tighter uppercase select-none italic"
            style="writing-mode: vertical-rl;">{{ $dept }}</span>
    @endif
</div>

{{-- Member Info --}}
<div class="absolute inset-x-0 bottom-0 z-30 p-10">
    <div class="mb-3 flex items-center gap-3">
        <div class="h-[3px] w-10 bg-primary rounded-full transition-all duration-500 md:group-hover:w-16"></div>
        <div class="relative">
            <span
                class="relative z-10 text-xs font-black uppercase tracking-[0.3em] text-primary">{{ $position }}</span>
        </div>
    </div>
    <div class="relative inline-block">
        <h3 class="relative z-10 font-black text-heading leading-none tracking-tighter italic {{ $textClasses }}">
            {{ strtoupper($name) }}
        </h3>
    </div>
</div>
@if ($href)
    </a>
@else
    </div>
@endif
</div>

