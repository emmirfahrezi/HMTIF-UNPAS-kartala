{{-- Stat Card --}}
@props([
    'label' => '',
    'value' => 0,
    'icon' => 'heroicon-o-chart-bar',
    'color' => 'primary',
    'href' => null,
])

@php
    $colorMap = [
        'primary' => 'bg-primary/10 text-primary',
        'blue' => 'bg-blue-50 text-blue-600',
        'amber' => 'bg-amber-50 text-amber-600',
        'rose' => 'bg-rose-50 text-rose-600',
        'emerald' => 'bg-emerald-50 text-emerald-600',
        'purple' => 'bg-purple-50 text-purple-600',
    ];
    $colorClass = $colorMap[$color] ?? $colorMap['primary'];
@endphp

<div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-md transition-shadow">
    <div class="flex items-center justify-between mb-4">
        <div class="w-11 h-11 rounded-xl {{ $colorClass }} flex items-center justify-center">
            <x-dynamic-component :component="$icon" class="size-5" />
        </div>
        @if ($href)
            <a href="{{ $href }}" class="text-xs text-slate-400 hover:text-primary transition font-medium">
                Lihat &rarr;
            </a>
        @endif
    </div>
    <p class="text-2xl font-black text-slate-800 tracking-tight">{{ number_format($value) }}</p>
    <p class="text-sm text-slate-500 mt-1">{{ $label }}</p>
</div>
