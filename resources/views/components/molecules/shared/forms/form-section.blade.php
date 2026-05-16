{{-- Form Section - Shared Molecule --}}
@props([
    'title' => '',
    'description' => '',
    'icon' => 'heroicon-s-cube',
    'bgIcon' => 'heroicon-o-cube',
])

<div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
    <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-primary pointer-events-none">
        <x-dynamic-component :component="$bgIcon" class="size-32" />
    </div>
    
    @if ($title)
        <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3 relative z-10">
            <span class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
                <x-dynamic-component :component="$icon" class="size-5" />
            </span>
            {{ $title }}
        </h3>
        @if ($description)
            <p class="text-sm text-slate-500 dark:text-slate-400 max-w-2xl leading-relaxed mb-6 -mt-3 ml-11 relative z-10">{{ $description }}</p>
        @endif
    @endif

    <div class="space-y-6 relative z-10">
        {{ $slot }}
    </div>
</div>
