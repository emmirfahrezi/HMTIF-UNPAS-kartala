@props([
    'title' => 'Tidak Ada Data',
    'description' => 'Maaf, data yang Anda cari tidak ditemukan atau belum tersedia.',
    'icon' => 'heroicon-o-folder-open',
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center py-16 px-4 text-center bg-white dark:bg-slate-900/50 rounded-[2rem] transition-colors duration-300']) }}>
    <div class="size-20 bg-slate-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center mb-6">
        <x-dynamic-component :component="$icon" class="size-10 text-slate-300 dark:text-slate-700" />
    </div>
    
    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">{{ $title }}</h3>
    <p class="text-slate-500 dark:text-slate-400 max-w-sm mx-auto font-medium leading-relaxed">
        {{ $description }}
    </p>

    @if($slot->isNotEmpty())
        <div class="mt-8">
            {{ $slot }}
        </div>
    @endif
</div>

