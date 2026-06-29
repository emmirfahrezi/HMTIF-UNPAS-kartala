@props([
    'badge' => null,
    'title' => null,
    'highlight' => null,
    'description' => null,
    'icon' => null,
])

<section class="relative pt-24 md:pt-28 pb-10 md:pb-12 overflow-hidden bg-white">
    {{-- Background Decoration --}}
    <div class="absolute inset-0 z-0 opacity-15 pointer-events-none">
        <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 0 L100 0 L100 100 L0 100 Z" fill="none" stroke="currentColor" stroke-width="1.2"
                class="text-primary" />
            <path d="M0 0 L100 100" stroke="currentColor" stroke-width="0.6" class="text-primary" />
        </svg>
    </div>

    {{-- Decorative Background Icons --}}
    @if ($icon)
        <div class="absolute inset-0 z-[1] pointer-events-none overflow-hidden" aria-hidden="true">
            {{-- Left icon --}}
            <div class="absolute -left-6 md:-left-4 top-1/2 -translate-y-1/2 text-primary/[0.04]">
                <x-dynamic-component :component="$icon" class="size-48 md:size-64 -rotate-12" />
            </div>
            {{-- Right icon --}}
            <div class="absolute -right-6 md:-right-4 top-1/2 -translate-y-1/2 text-primary/[0.04]">
                <x-dynamic-component :component="$icon" class="size-48 md:size-64 rotate-12" />
            </div>
        </div>
    @endif

    <div class="container mx-auto px-6 relative z-10 text-center">
        @if ($badge)
            <span
                class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-[0.3em] uppercase mb-6 reveal reveal-up reveal-delay-1"
            >
                {{ $badge }}
            </span>
        @endif

        @if ($title)
            <h1
                class="text-3xl md:text-5xl font-black text-heading mb-5 md:mb-6 uppercase italic tracking-tighter reveal reveal-up reveal-delay-2"
            >
                {{ $title }} @if ($highlight)
                    <span class="text-primary">{{ $highlight }}</span>
                @endif
            </h1>
        @endif

        @if ($description)
            <p
                class="text-gray-700 max-w-2xl mx-auto text-[1rem] md:text-[1.125rem] lowercase tracking-[0.2em] md:tracking-widest font-normal leading-relaxed reveal reveal-up reveal-delay-3"
            >
                {{ $description }}
            </p>
        @endif

        @if ($slot->isNotEmpty())
            <div class="mt-10">
                {{ $slot }}
            </div>
        @endif
    </div>
</section>
