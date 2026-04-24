@props([
    'searchRoute' => null,
    'searchPlaceholder' => 'Cari data...',
])

<div class="bg-white p-5 rounded-2xl border border-slate-200 mb-6 shadow-sm">
    <form method="GET" action="{{ $searchRoute }}" id="filter-form" class="flex flex-col lg:flex-row lg:items-center gap-4">
        {{-- Search Section --}}
        @if ($searchRoute)
            <div class="relative flex-1">
                <x-heroicon-o-magnifying-glass class="size-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" />
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="{{ $searchPlaceholder }}"
                    oninput="debounceSubmit()"
                    class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" />
            </div>
        @endif

        {{-- Filters Section --}}
        <div class="flex flex-wrap items-center gap-3">
            {{-- Sort Filter --}}
            <div class="flex items-center gap-2">
                <label class="text-xs font-bold text-slate-400 uppercase tracking-wider whitespace-nowrap">Urutkan</label>
                <select name="sort" onchange="this.form.submit()"
                    class="pl-3 pr-8 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary/20 transition cursor-pointer appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20stroke%3D%22%236B7280%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%221.5%22%20d%3D%22m6%208%204%204%204-4%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_0.5rem_center] bg-no-repeat">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>A - Z</option>
                    <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Z - A</option>
                </select>
            </div>

            {{-- Custom Slot for Module-specific filters --}}
            {{ $slot }}

            {{-- Reset Button --}}
            @if (request()->hasAny(['search', 'sort', 'category', 'status', 'division', 'role']))
                <div class="flex items-center gap-2 ml-auto lg:ml-0 border-l border-slate-100 pl-3">
                    <a href="{{ $searchRoute }}" 
                        class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-xl text-xs font-bold hover:bg-red-100 transition">
                        <x-heroicon-o-arrow-path class="size-3.5" />
                        Reset
                    </a>
                </div>
            @endif
        </div>
    </form>
</div>

<script>
    let debounceTimer;
    function debounceSubmit() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            document.getElementById('filter-form').submit();
        }, 500);
    }
</script>
