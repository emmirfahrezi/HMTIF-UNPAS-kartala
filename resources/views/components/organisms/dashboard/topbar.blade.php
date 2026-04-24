{{-- Dashboard Topbar --}}
@props([
    'pageTitle' => 'Dashboard',
    'breadcrumbs' => [],
])

<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 shrink-0 sticky top-0 z-30">
    <div class="flex items-center gap-4">
        {{-- Mobile Menu Toggle --}}
        <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 rounded-lg text-slate-500 hover:bg-slate-100 transition">
            <x-heroicon-o-bars-3 class="size-5" />
        </button>

    <div class="flex items-center gap-4">
        {{-- Mobile Menu Toggle --}}
        <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 rounded-lg text-slate-500 hover:bg-slate-100 transition">
            <x-heroicon-o-bars-3 class="size-5" />
        </button>
    </div>

    {{-- User Menu --}}
    <div class="flex items-center gap-3">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-semibold text-slate-700">{{ auth()->user()?->name ?? 'Admin' }}</p>
            <p class="text-xs text-slate-400 capitalize">{{ auth()->user()?->role ?? 'admin' }}</p>
        </div>
        <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm">
            {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
        </div>
        <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
            @csrf
            <button type="submit"
                class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"
                title="Logout">
                <x-heroicon-o-arrow-right-on-rectangle class="size-5" />
            </button>
        </form>
    </div>
</header>
