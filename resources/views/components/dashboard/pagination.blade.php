{{-- Pagination --}}
@props(['paginator'])

@if ($paginator->hasPages())
    <nav class="flex items-center justify-between">
        <p class="text-sm text-slate-500">
            Menampilkan <span class="font-semibold text-slate-700">{{ $paginator->firstItem() }}</span>
            &ndash; <span class="font-semibold text-slate-700">{{ $paginator->lastItem() }}</span>
            dari <span class="font-semibold text-slate-700">{{ $paginator->total() }}</span> data
        </p>
        <div class="flex items-center gap-1">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-sm text-slate-300 rounded-lg cursor-not-allowed">&laquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-3 py-2 text-sm text-slate-600 hover:bg-slate-100 rounded-lg transition">&laquo;</a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="px-3 py-2 text-sm font-bold text-white bg-primary rounded-lg">{{ $page }}</span>
                @else
                    <a href="{{ $url }}"
                        class="px-3 py-2 text-sm text-slate-600 hover:bg-slate-100 rounded-lg transition">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-3 py-2 text-sm text-slate-600 hover:bg-slate-100 rounded-lg transition">&raquo;</a>
            @else
                <span class="px-3 py-2 text-sm text-slate-300 rounded-lg cursor-not-allowed">&raquo;</span>
            @endif
        </div>
    </nav>
@endif
