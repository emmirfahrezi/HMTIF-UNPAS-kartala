<div
    class="relative isolate px-6 pt-14 mt-0 lg:px-8 min-h-screen flex items-center bg-[url('/images/placeholders/hero-home.svg')] bg-cover bg-center bg-no-repeat z-0 transform">
    <div class="absolute inset-0 bg-linear-to-b from-primary-dark/60 via-primary-dark/20 to-transparent z-0"></div>
    <div class="mx-auto max-w-4xl py-24 sm:py-32 z-20 text-center">
        <div
            class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 backdrop-blur-md rounded-lg text-primary-soft text-sm font-semibold mb-6 shadow-xl ring-1 ring-white/20 reveal reveal-up reveal-delay-1">
            <span class="relative flex h-2 w-2">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-soft opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-soft"></span>
            </span>
            Selamat Datang di Portal Resmi HMTIF
        </div>
        <h1
            class="text-4xl font-extrabold tracking-tight text-white sm:text-7xl mb-6 drop-shadow-2xl reveal reveal-up reveal-delay-2">
            HMTIF UNPAS <br>
            <span
                class="bg-clip-text text-transparent bg-linear-to-r from-primary-soft to-white italic text-3xl sm:text-5xl">Kabinet
                Kartala</span>
        </h1>
        <p
            class="mt-4 text-base font-medium text-white/90 leading-relaxed max-w-2xl mx-auto sm:text-lg reveal reveal-up reveal-delay-3">
            Membangun harmoni, menginspirasi perubahan, dan mewujudkan Teknik Informatika yang lebih progresif melalui
            dedikasi dan kerja nyata.
        </p>
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 reveal reveal-up reveal-delay-4">
            <x-atoms.button variant="primary" onclick="window.location.href='/activities'"
                class="px-8 py-3 text-base shadow-xl shadow-primary/30 w-full sm:w-auto transform hover:-translate-y-1 transition-all group">
                <span>Jelajahi Program</span>
                <x-heroicon-o-rocket-launch class="size-5 group-hover:rotate-12 transition-transform" />
            </x-atoms.button>
            <x-atoms.button variant="outline" onclick="window.location.href='/staff'"
                class="px-8 py-3 text-base border-white/40 text-white backdrop-blur-md hover:bg-white/10 w-full sm:w-auto transform hover:-translate-y-1 transition-all group rounded-lg">
                <span>Tentang Kami</span>
                <x-heroicon-o-information-circle class="size-5 group-hover:animate-bounce" />
            </x-atoms.button>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div
        class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/40 animate-bounce">
        <span class="text-[10px] uppercase tracking-[0.3em] font-bold">Scroll Down</span>
        <x-heroicon-o-chevron-double-down class="h-6 w-6" />
    </div>
</div>
