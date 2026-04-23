{{-- Data Table --}}
@props([
    'headers' => [],
    'searchRoute' => null,
    'searchPlaceholder' => 'Cari...',
    'createRoute' => null,
    'createLabel' => 'Tambah Baru',
])

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

    {{-- Table Toolbar --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-5 border-b border-slate-100">
        {{-- Search --}}
        @if ($searchRoute)
            <form method="GET" action="{{ $searchRoute }}" class="flex items-center gap-2 w-full sm:w-auto">
                <div class="relative flex-1 sm:flex-none">
                    <x-heroicon-o-magnifying-glass class="size-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" />
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="{{ $searchPlaceholder }}"
                        class="w-full sm:w-72 pl-9 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" />
                </div>
                <button type="submit"
                    class="px-4 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-medium hover:bg-slate-200 transition">
                    Cari
                </button>
            </form>
        @else
            <div></div>
        @endif

        {{-- Create Button --}}
        @if ($createRoute)
            <a href="{{ $createRoute }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all active:scale-95 shrink-0">
                <x-heroicon-o-plus class="size-4" />
                {{ $createLabel }}
            </a>
        @endif
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/80">
                    @foreach ($headers as $header)
                        <th class="px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap {{ $header['class'] ?? '' }}">
                            {{ $header['label'] }}
                        </th>
                    @endforeach
                    <th class="px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    {{-- Empty state fallback --}}
    {{ $empty ?? '' }}

    {{-- Pagination --}}
    @if (isset($pagination))
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $pagination }}
        </div>
    @endif
</div>
