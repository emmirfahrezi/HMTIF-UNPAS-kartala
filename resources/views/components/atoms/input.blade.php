@props([
    'disabled' => false,
])

<input {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'w-full px-4 py-3 bg-white border border-border rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all duration-300 placeholder:text-body/40 text-heading font-medium']) }}>
