@props([
    'badge' => null,
    'title' => null,
    'highlight' => null,
    'description' => null,
])

<section class="relative pt-28 pb-12 overflow-hidden bg-white">
    {{-- Background Decoration --}}
    <div class="absolute inset-0 z-0 opacity-10 pointer-events-none">
        <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 0 L100 0 L100 100 L0 100 Z" fill="none" stroke="currentColor" stroke-width="1"
                class="text-primary" />
            <path d="M0 0 L100 100" stroke="currentColor" stroke-width="0.5" class="text-primary" />
        </svg>
    </div>

    <div class="container mx-auto px-6 relative z-10 text-center">
        @if($badge)
            <span class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-[0.3em] uppercase mb-6">
                {{ $badge }}
            </span>
        @endif

        @if($title)
            <h1 class="text-3xl md:text-5xl font-black text-heading mb-6 uppercase italic tracking-tighter">
                {{ $title }} @if($highlight)<span class="text-primary">{{ $highlight }}</span>@endif
            </h1>
        @endif

        @if($description)
            <p class="text-body/40 max-w-2xl mx-auto text-lg lowercase tracking-widest font-light leading-relaxed">
                {{ $description }}
            </p>
        @endif

        @if($slot->isNotEmpty())
            <div class=\"mt-10\">
                {{ $slot }}
            </div>
        @endif
    </div>
</section>
