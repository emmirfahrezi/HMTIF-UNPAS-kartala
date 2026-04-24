{{-- Data Table --}}
@props([
    'headers' => [],
])

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
    @if (isset($actions))
        <div class="flex items-center justify-end gap-3 p-5 border-b border-slate-100 bg-slate-50/30">
            {{ $actions }}
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/80 border-b border-slate-100">
                    @foreach ($headers as $header)
                        <th class="px-5 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap {{ $header['class'] ?? '' }}">
                            {{ $header['label'] }}
                        </th>
                    @endforeach
                    <th class="px-5 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
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
        <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/30">
            {{ $pagination }}
        </div>
    @endif
</div>
