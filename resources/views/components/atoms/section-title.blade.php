@props([
    'align' => 'left',
])

@php
    $alignClasses = [
        'left' => 'text-left items-start',
        'center' => 'text-center items-center',
        'right' => 'text-right items-end',
    ];

    $classes = $alignClasses[$align] ?? $alignClasses['left'];
@endphp

<div class="flex flex-col {{ $classes }} gap-2 group">
    <h2 {{ $attributes->merge(['class' => 'text-3xl md:text-4xl font-bold text-heading']) }}>
        {{ $slot }}
    </h2>
    <div class="h-1.5 w-12 bg-primary rounded-full transition-all duration-500 group-hover:w-24"></div>
</div>
