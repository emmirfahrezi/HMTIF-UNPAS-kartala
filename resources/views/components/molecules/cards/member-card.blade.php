@props([
    'name',
    'position',
    'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&h=600&auto=format&fit=crop',
    'size' => 'normal', // xl, lg, normal
    'dept' => '',
])
@php
    $sizeClasses = 'h-[500px] md:h-[600px]';

    $textClasses = match ($size) {
        'xl' => 'text-3xl md:text-5xl',
        'lg' => 'text-2xl md:text-4xl',
        'normal' => 'text-xl md:text-3xl',
        default => 'text-xl'
    };
@endphp

<div class="group relative overflow-hidden rounded-lg bg-white shadow-lg transition-all duration-500 hover:-translate-y-3 border border-gray-100 hover:border-primary {{ $sizeClasses }}">
    
    {{-- Intense Green Inner Shadow --}}
    <div class="absolute inset-0 z-20 pointer-events-none shadow-[inset_0_0_80px_rgba(36,130,50,0.25)] ring-1 ring-inset ring-primary/5 group-hover:shadow-[inset_0_0_100px_rgba(36,130,50,0.4)] transition-all duration-700"></div>


            {{-- Member Image --}}
    <div class="absolute inset-0 z-10 overflow-hidden">
        <img src="{{ $image }}" alt="{{ $name }}" 
            class="h-full w-full object-cover object-top transition-all duration-1000 group-hover:scale-110">
        {{-- Elegant Fade Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-t from-white via-white/20 to-transparent opacity-95 gr
           oup-hover:opacity-80 transition-opacity"></div>
    </div>

    {{-- Dept Vertical Label (Subtle Branding) --}}
    <div class="absolute top-10 right-6 z-20">
        @if($dept)
            <span class="text-6xl font-black text-primary/5 tracking-tighter uppercase select-none italic" style="writing-mode: vertical-rl;">{{ $dept }}</span>
        @endif
    </div>

    {{-- Member Info --}}
    <div class="absolute inset-x-0 bottom-0 z-30 p-10">
        <div class="mb-3 flex items-center gap-3">
            <div class="h-[3px] w-10 bg-primary rounded-full transition-all duration-500 group-hover:w-16"></div>
            <span class="text-xs font-black uppercase tracking-[0.3em] text-primary">{{ $position }}</span>
        </div>
        <h3 class="font-black text-heading leading-none tracking-tighter italic {{ $textClasses }}">
            {{ strtoupper($name) }}
        </h3>
    </div>
</div>
