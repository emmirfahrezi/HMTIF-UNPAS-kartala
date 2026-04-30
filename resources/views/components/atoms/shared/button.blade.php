@props([
    'variant' => 'primary',
    'type' => 'button',
    'size' => 'md',
    'icon' => null,
    'iconRight' => null,
    'rounded' => 'rounded-2xl',
])

@php
    $baseClasses = $rounded . ' font-bold transition-all duration-300 active:scale-95 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:scale-100';

    $sizes = [
        'xs' => 'px-3 py-1.5 text-[10px]',
        'sm' => 'px-4 py-2 text-xs',
        'md' => 'px-6 py-2.5 text-sm',
        'lg' => 'px-8 py-3 text-base',
    ];

    $variants = [
        'primary' => 'bg-primary text-white hover:bg-primary-hover shadow-lg shadow-primary/20',
        'secondary' => 'bg-secondary text-primary-dark hover:bg-secondary-hover shadow-lg shadow-secondary/20',
        'danger' => 'bg-red-500 text-white hover:bg-red-600 shadow-lg shadow-red-500/20',
        'warning' => 'bg-amber-500 text-white hover:bg-amber-600 shadow-lg shadow-amber-500/20',
        'success' => 'bg-emerald-500 text-white hover:bg-emerald-600 shadow-lg shadow-emerald-500/20',
        'dark' => 'bg-slate-900 text-white hover:bg-slate-800 shadow-lg shadow-slate-900/20',
        'white' => 'bg-white text-slate-900 hover:bg-slate-50 shadow-lg shadow-black/5',
        'outline' => 'border-2 border-primary text-primary hover:bg-primary hover:text-white',
        'outline-primary' => 'border-2 border-primary text-primary hover:bg-primary hover:text-white',
        'outline-secondary' => 'border-2 border-secondary text-secondary hover:bg-secondary hover:text-primary-dark',
        'outline-slate' => 'border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-900',
        'outline-white' => 'border-2 border-white text-white hover:bg-white hover:text-slate-900',
        'ghost' => 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-700 dark:hover:text-slate-200',
        'soft' => 'bg-primary/5 dark:bg-primary/10 text-primary hover:bg-primary/10 dark:hover:bg-primary/20',
        'soft-warning' => 'bg-amber-500/10 text-amber-600 hover:bg-amber-500 hover:text-white',
        'soft-success' => 'bg-emerald-500/10 text-emerald-600 hover:bg-emerald-500 hover:text-white',
        'on-primary' => 'bg-white text-primary border border-white/60 hover:bg-white/90 shadow-sm hover:shadow-md',
    ];

    $classes = $baseClasses . ' ' . ($sizes[$size] ?? $sizes['md']) . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($attributes->has('href'))
    <a {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <x-dynamic-component :component="$icon" class="size-4" />
        @endif
        {{ $slot }}
        @if ($iconRight)
            <x-dynamic-component :component="$iconRight" class="size-4" />
        @endif
    </a>
@else
    <button {{ $attributes->merge(['type' => $type, 'class' => $classes]) }}>
        @if ($icon)
            <x-dynamic-component :component="$icon" class="size-4" />
        @endif
        {{ $slot }}
        @if ($iconRight)
            <x-dynamic-component :component="$iconRight" class="size-4" />
        @endif
    </button>
@endif
