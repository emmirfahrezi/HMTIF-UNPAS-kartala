{{-- Form Section - Shared Molecule --}}
@props([
    'title' => '',
    'description' => '',
])

<div class="bg-white/80 dark:bg-slate-900/40 backdrop-blur-md rounded-[2rem] border border-slate-200/60 dark:border-slate-800/60 p-8 lg:p-10 transition-all duration-500 hover:shadow-2xl hover:shadow-primary/5 group/section">
    @if ($title)
        <div class="mb-8 relative">
            <div class="flex items-center gap-4 mb-2">
                <div class="h-8 w-1.5 bg-primary rounded-full group-hover/section:scale-y-110 transition-transform duration-300"></div>
                <h3 class="text-xl font-black tracking-tight text-slate-800 dark:text-white uppercase">{{ $title }}</h3>
            </div>
            @if ($description)
                <p class="text-sm text-slate-500 dark:text-slate-400 max-w-2xl leading-relaxed ml-5.5">{{ $description }}</p>
            @endif
        </div>
    @endif

    <div class="space-y-6">
        {{ $slot }}
    </div>
</div>
