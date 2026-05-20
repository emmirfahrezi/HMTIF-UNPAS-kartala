@props(['homeSections' => []])

@php
    $tagline = data_get($homeSections, 'hero.tagline', 'Selamat Datang di Portal Resmi HMTIF-UNPAS');
    $title = data_get($homeSections, 'hero.title', 'HMTIF-UNPAS');
    $subtitle = data_get($homeSections, 'hero.description', 'Membangun harmoni, menginspirasi perubahan, dan mewujudkan Teknik Informatika yang lebih progresif melalui dedikasi dan kerja nyata.');
    $btnPrimary = data_get($homeSections, 'hero.btn_primary', 'Jelajahi Program');
    $btnSecondary = data_get($homeSections, 'hero.btn_secondary', 'Tentang Kami');
@endphp

<div
    class="relative isolate px-6 pt-14 mt-0 lg:px-8 min-h-screen flex items-center bg-[url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80')] bg-cover bg-center bg-no-repeat z-0 transform">
    <div class="absolute inset-0 bg-linear-to-b from-black via-black/45 to-transparent z-0"></div>
    <div class="mx-auto max-w-4xl py-24 sm:py-32 z-20 text-center">
        <div
            class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 backdrop-blur-md rounded-lg text-secondary text-sm font-semibold mb-6 shadow-xl ring-1 ring-white/20 reveal reveal-up reveal-delay-1">
            <span class="relative flex h-2 w-2">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-secondary"></span>
            </span>
            {{ $tagline }}
        </div>
        <h1
            class="text-4xl font-extrabold tracking-tight text-white sm:text-7xl mb-6 drop-shadow-2xl reveal reveal-up reveal-delay-2">
            {{ $title }} <br>
        </h1>
        <p
            class="mt-4 text-[1rem] font-medium text-white/90 leading-relaxed max-w-2xl mx-auto sm:text-[1.125rem] reveal reveal-up reveal-delay-3">
            {{ $subtitle }}
        </p>
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 reveal reveal-up reveal-delay-4">
            <x-atoms.shared.button variant="primary" href="{{ route('activities') }}"
                class="px-8 py-3 text-base shadow-xl shadow-primary/30 w-full sm:w-auto transform hover:translate-y-1 transition-all group">
                <span>{{ $btnPrimary }}</span>
                <x-heroicon-o-rocket-launch class="size-5 group-hover:rotate-12 transition-transform" />
            </x-atoms.shared.button>
            <x-atoms.shared.button variant="outline-secondary" href="#about"
                class="px-8 py-3 text-base w-full sm:w-auto transform hover:translate-y-1 transition-all group">
                <span>{{ $btnSecondary }}</span>
                <x-heroicon-o-information-circle class="size-5 group-hover:animate-bounce" />
            </x-atoms.shared.button>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div
        class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/40 animate-bounce">
        <span class="text-[10px] uppercase tracking-[0.3em] font-bold">Scroll Down</span>
        <x-heroicon-o-chevron-double-down class="h-6 w-6" />
    </div>
</div>
