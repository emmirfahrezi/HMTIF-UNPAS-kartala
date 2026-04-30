@props(['transparent' => false])

<header x-data="{ 
        mobileMenuOpen: false, 
        isTransparent: {{ $transparent ? 'true' : 'false' }},
        atTop: true
    }" x-init="
        window.addEventListener('scroll', () => {
            atTop = window.pageYOffset < 50
        })
    " :class="{
        'bg-white shadow-lg border-b border-slate-100': !atTop || !isTransparent,
        'bg-transparent': atTop && isTransparent
    }" class="fixed top-0 left-0 w-full z-50 transition-all duration-500">
    <nav aria-label="Global" class="mx-auto flex max-w-screen-2xl items-center justify-between px-6 py-4 xl:px-12">
        {{-- Logo --}}
        <div class="flex xl:flex-1">
            <a href="/" class="flex items-center gap-3 group">
                <div
                    class="p-2 bg-white/10 backdrop-blur-md rounded-xl transition-all duration-500 group-hover:scale-110 group-hover:bg-white/20 border border-white/10 shadow-sm">
                    <img src="{{ config('app.logo_url') }}" alt="Logo HMTIF UNPAS"
                        class="h-9 sm:h-10 w-auto object-contain logo-remove-bg" />
                </div>
                <h1 class="font-black text-xl tracking-tighter uppercase italic transition-colors duration-500"
                    :class="(!atTop || !isTransparent) ? 'text-slate-900' : 'text-white'">
                    HMTIF<span class="text-primary font-black">UNPAS</span>
                </h1>
            </a>
        </div>

        {{-- Mobile Menu Button --}}
        <div class="flex xl:hidden">
            <button type="button" @click="mobileMenuOpen = true"
                class="inline-flex items-center justify-center p-2.5 rounded-xl transition-all duration-300"
                :class="(!atTop || !isTransparent) ? 'text-slate-900 bg-slate-50' : 'text-white bg-white/10 backdrop-blur-md'">
                <x-heroicon-o-bars-3 class="size-7" />
            </button>
        </div>

        {{-- Desktop Menu --}}
        <div class="hidden xl:flex xl:gap-x-10 items-center">
            @php
                $navItems = [
                    ['label' => 'Beranda', 'href' => '/', 'match' => '/'],
                    ['label' => 'Pengurus', 'href' => '/staff', 'match' => 'staff*'],
                    ['label' => 'Kegiatan', 'href' => '/activities', 'match' => 'activit*'],
                    ['label' => 'Toko', 'href' => '/store', 'match' => ['store*', 'product*']],
                    ['label' => 'Pengumuman', 'href' => '/announcements', 'match' => 'announcement*'],
                    ['label' => 'Aspirasi', 'href' => '/aspirations', 'match' => 'aspirations*'],
                ];
            @endphp

            @foreach($navItems as $item)
                @php $isActive = request()->is($item['match']); @endphp
                <a href="{{ $item['href'] }}"
                    class="relative text-sm font-black uppercase tracking-widest transition-all duration-300 hover:text-primary group py-2"
                    :class="(!atTop || !isTransparent) ? '{{ $isActive ? 'text-primary' : 'text-slate-600' }}' : '{{ $isActive ? 'text-secondary' : 'text-white' }}'">
                    {{ $item['label'] }}
                    <span
                        class="absolute bottom-0 left-0 w-0 h-1 bg-primary rounded-full transition-all duration-300 group-hover:w-full {{ $isActive ? 'w-full' : '' }}"></span>
                </a>
            @endforeach
        </div>
    </nav>

    {{-- Mobile Menu Overlay --}}
    <div x-show="mobileMenuOpen" class="xl:hidden fixed inset-0 z-[100]" style="display: none;">
        {{-- Backdrop --}}
        <div x-show="mobileMenuOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>

        {{-- Panel --}}
        <div x-show="mobileMenuOpen" x-transition:enter="ease-out duration-500"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="ease-in duration-300" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed inset-y-0 right-0 w-full sm:max-w-sm bg-white shadow-2xl flex flex-col p-8">
            <div class="flex items-center justify-between mb-12">
                <div class="flex items-center gap-3">
                    <img src="{{ config('app.logo_url') }}" alt="Logo HMTIF" class="h-10 w-auto logo-remove-bg" />
                    <span class="font-black text-xl tracking-tighter uppercase italic text-slate-900">KARTALA</span>
                </div>
                <button @click="mobileMenuOpen = false"
                    class="p-2 text-slate-400 hover:text-slate-900 transition-colors">
                    <x-heroicon-o-x-mark class="size-7" />
                </button>
            </div>

            <div class="flex flex-col gap-4">
                @foreach($navItems as $item)
                    @php $isActive = request()->is($item['match']); @endphp
                    <a href="{{ $item['href'] }}"
                        class="flex items-center justify-between p-4 rounded-2xl text-lg font-black uppercase tracking-widest transition-all duration-300 {{ $isActive ? 'bg-primary text-white shadow-xl shadow-primary/20' : 'text-slate-600 hover:bg-slate-50' }}">
                        {{ $item['label'] }}
                        <x-heroicon-o-chevron-right class="size-5 {{ $isActive ? 'text-white/50' : 'text-slate-300' }}" />
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</header>