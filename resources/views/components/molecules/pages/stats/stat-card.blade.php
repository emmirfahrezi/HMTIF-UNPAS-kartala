@props([
    'label' => '',
    'value' => '',
    'icon' => null,
])

<div
    {{ $attributes->merge(['class' => 'bg-white p-8 rounded-2xl border border-border shadow-sm hover:shadow-lg transition-all duration-500 hover:-translate-y-2 relative overflow-hidden reveal reveal-up']) }}>
    {{-- Decorative Icon Background --}}
    @if ($icon)
        <div
            class="absolute -right-4 -bottom-4 text-gray-50 group-hover:text-primary/5 transition-colors duration-500 transform group-hover:scale-110">
            @php
                $iconName = match ($icon) {
                    'users' => 'heroicon-o-users',
                    'calendar' => 'heroicon-o-calendar',
                    'puzzle' => 'heroicon-o-puzzle-piece',
                    'academic' => 'heroicon-o-academic-cap',
                    default => 'heroicon-o-' . $icon,
                };
            @endphp
            <x-dynamic-component :component="$iconName" class="h-32 w-32" />
        </div>
    @endif

    <div class="flex flex-col gap-2 relative z-10 text-left">
        <span
            class="text-4xl md:text-5xl font-extrabold text-primary group-hover:scale-110 transition-transform duration-300 inline-block origin-left">
            {{ $value }}
        </span>
        <h4 class="text-lg font-bold text-heading uppercase tracking-widest border-l-4 border-primary pl-3">
            {{ $label }}
        </h4>
        <p
            class="text-sm text-body mt-2 leading-relaxed opacity-60 group-hover:opacity-100 transition-opacity duration-300">
            Terdaftar secara resmi dalam database keanggotaan HMTIF-UNPAS.
        </p>
    </div>
</div>

