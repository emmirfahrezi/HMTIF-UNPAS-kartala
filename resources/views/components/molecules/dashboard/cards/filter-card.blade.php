@props([
    'searchRoute' => null,
    'searchPlaceholder' => 'Cari data...',
])

<div class="bg-white/40 dark:bg-white/5 backdrop-blur-2xl p-5 rounded-2xl border border-slate-200/50 dark:border-white/10 mb-8 shadow-xl shadow-slate-200/20 dark:shadow-black/20 transition-all duration-300">
    <form method="GET" action="{{ $searchRoute }}" id="filter-form" class="flex flex-col lg:flex-row lg:items-center gap-6">
        {{-- Search Section --}}
        @if ($searchRoute)
            <div class="relative w-full lg:w-[32rem] group" x-data="{ 
                init() {
                    window.addEventListener('keydown', (e) => {
                        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                            e.preventDefault();
                            $refs.searchInput.focus();
                        }
                    });
                }
            }">
                <x-heroicon-o-magnifying-glass class="size-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors duration-300" />
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="{{ $searchPlaceholder }}"
                    x-ref="searchInput"
                    oninput="debounceSubmit()"
                    class="w-full pl-12 pr-20 py-3 bg-transparent dark:bg-transparent border border-slate-200/50 dark:border-white/10 rounded-2xl text-sm dark:text-white focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all duration-300 placeholder:text-slate-400 dark:placeholder:text-slate-600" />
                <div class="absolute right-4 top-1/2 -translate-y-1/2 hidden sm:flex items-center gap-1 px-2 py-1 bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-lg pointer-events-none group-focus-within:opacity-0 transition-opacity">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Ctrl</span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">K</span>
                </div>
            </div>
        @endif

        {{-- Filters Section --}}
        <div class="flex flex-wrap items-center gap-6">
            {{-- Custom Slot for Module-specific filters --}}
            {{ $slot }}

            {{-- Reset Button --}}
            @if (request()->hasAny(['search', 'sort', 'category', 'status', 'division', 'role']))
                <div class="flex items-center border-l border-slate-100 dark:border-white/10 pl-4">
                    <a href="{{ $searchRoute }}" 
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-transparent border border-red-500/30 text-red-500 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all duration-300 active:scale-95">
                        <x-heroicon-o-arrow-path class="size-4" />
                        Reset
                    </a>
                </div>
            @endif
        </div>
    </form>
</div>

<script>
    if (typeof window.debounceTimer === 'undefined') {
        window.debounceTimer = null;
    }
    function debounceSubmit() {
        clearTimeout(window.debounceTimer);
        window.debounceTimer = setTimeout(() => {
            document.getElementById('filter-form').submit();
        }, 600);
    }
</script>
