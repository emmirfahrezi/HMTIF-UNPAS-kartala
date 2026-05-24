{{-- Dashboard Topbar --}}
@props([
    'pageTitle' => 'Dashboard',
    'breadcrumbs' => [],
])

<header class="h-16 bg-white/80 dark:bg-slate-950/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-900 flex items-center justify-between px-6 shrink-0 sticky top-0 z-30 transition-colors duration-300">
    <div class="flex items-center gap-4">
        {{-- Mobile Menu Toggle --}}
        <button @click="sidebarOpen = true" class="lg:hidden p-2.5 -ml-2 rounded-xl text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900 transition-all active:scale-95">
            <x-heroicon-o-bars-3 class="size-6" />
        </button>

        {{-- Desktop Dynamic Header --}}
        @php
            $currentPath = request()->path();
            $categoryName = 'Dashboard';
            
            if (str_contains($currentPath, '/activities') || str_contains($currentPath, '/announcements')) {
                $categoryName = 'Manajemen Konten';
            } elseif (str_contains($currentPath, '/staffs') || str_contains($currentPath, '/aspirations') || str_contains($currentPath, '/minutes')) {
                $categoryName = 'Manajemen Organisasi';
            } elseif (str_contains($currentPath, '/products')) {
                $categoryName = 'Manajemen Store';
            } elseif (str_contains($currentPath, '/users') || str_contains($currentPath, '/stats') || str_contains($currentPath, '/activity-logs')) {
                $categoryName = 'Manajemen Sistem';
            }
        @endphp

        <div class="hidden lg:flex items-center">
            <h1 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tighter italic">{{ $categoryName }}</h1>
        </div>

        {{-- Page Info (Mobile only title) --}}
        <h2 class="text-sm font-bold text-slate-800 dark:text-slate-100 lg:hidden truncate max-w-[150px]">{{ $pageTitle }}</h2>
    </div>

    {{-- User Menu --}}
    <div class="flex items-center gap-4" x-data="{ userMenuOpen: false }">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-slate-900 dark:text-white leading-none mb-1">{{ auth()->user()?->name ?? 'Admin Kartala' }}</p>
            <p class="text-[10px] text-slate-400 dark:text-slate-600 font-black uppercase tracking-widest">{{ auth()->user()?->role_label ?? 'Administrator' }}</p>
        </div>

        <div class="relative">
            <button 
                @click="userMenuOpen = !userMenuOpen"
                @click.away="userMenuOpen = false"
                class="group flex items-center gap-1 focus:outline-none"
            >
                <div class="size-10 rounded-2xl bg-primary/10 dark:bg-primary/20 flex items-center justify-center text-primary font-black text-sm border-2 border-transparent group-hover:border-primary/20 transition-all">
                    {{ auth()->user()?->initial ?? 'A' }}
                </div>
                <span class="transition-transform duration-300" :class="userMenuOpen ? 'rotate-180' : ''">
                    <x-heroicon-o-chevron-down class="size-4 text-black dark:text-white" />
                </span>
            </button>

            {{-- Dropdown --}}
            <div 
                x-show="userMenuOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                class="absolute right-0 mt-3 w-56 bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-100 dark:border-slate-800 py-2 z-50 transition-colors duration-300"
                style="display: none;"
            >
                <div class="px-4 py-3 border-b border-slate-50 dark:border-slate-800 mb-1">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-600 uppercase tracking-widest">Akun Saya</p>
                </div>
                
                <div class="px-4 py-3 space-y-1">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ auth()->user()?->email ?? 'admin@kartala.local' }}</p>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Akses akun dikelola melalui modul pengguna.</p>
                </div>

                <div class="h-px bg-slate-50 dark:bg-slate-800 my-2"></div>

                <div class="px-2">
                    <x-atoms.shared.button 
                        variant="ghost"
                        @click="openLogoutModal('{{ route('logout') }}')" 
                        class="w-full !justify-start text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                        icon="heroicon-o-arrow-right-on-rectangle">
                        Keluar
                    </x-atoms.shared.button>
                </div>
            </div>
        </div>
    </div>
</header>
