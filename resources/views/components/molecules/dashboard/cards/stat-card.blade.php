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
        'primary' => 'bg-primary/10 dark:bg-primary/20 text-primary',
        'blue' => 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-500',
        'amber' => 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-500',
        'rose' => 'bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-500',
        'emerald' => 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-500',
        'purple' => 'bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-500',
    ];
    $colorClass = $colorMap[$color] ?? $colorMap['primary'];
@endphp

<div class="bg-white dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 hover:shadow-md dark:hover:bg-slate-800/50 transition-all duration-300">
    <div class="flex items-center justify-between mb-4">
        <div class="w-11 h-11 rounded-xl {{ $colorClass }} flex items-center justify-center">
            <x-dynamic-component :component="$icon" class="size-5" />
        </div>
        @if ($href)
            <a href="{{ $href }}" class="text-xs text-slate-400 dark:text-slate-600 hover:text-primary dark:hover:text-primary transition font-medium">
                Lihat &rarr;
            </a>
        @endif
    </div>
    <p class="text-2xl font-black text-slate-800 dark:text-white tracking-tight">{{ number_format($value) }}</p>
    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $label }}</p>
</div>

