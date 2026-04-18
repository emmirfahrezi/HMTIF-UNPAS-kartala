@props([
    'variant' => 'primary',
    'type' => 'button',
])

@php
    $baseClasses =
        'px-6 py-2.5 rounded-xl font-semibold transition-all duration-300 active:scale-95 flex items-center justify-center gap-2';

    $variants = [
        'primary' => 'bg-primary text-white hover:bg-primary-hover shadow-lg shadow-primary/20',
        'secondary' => 'bg-secondary text-heading hover:bg-secondary-hover shadow-lg shadow-secondary/30',
        'outline' => 'border-2 border-primary text-primary hover:bg-primary hover:text-white',
        'outline-secondary' => 'border-2 border-secondary text-secondary hover:bg-secondary hover:text-black',
        'soft' => 'bg-primary-soft text-primary hover:bg-primary/20',
        'on-primary' =>
            'bg-white text-primary border border-white/60 hover:bg-white/90 hover:text-primary shadow-sm hover:shadow-md',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button {{ $attributes->merge(['type' => $type, 'class' => $classes]) }}>
    {{ $slot }}
</button>
