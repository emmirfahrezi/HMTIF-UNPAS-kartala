@props(['name' => null, 'id' => null, 'title' => '', 'maxWidth' => '2xl'])

@php
$modalName = $name ?? $id ?? 'default-modal';
$maxWidthClass = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth] ?? 'sm:max-w-2xl';
@endphp

<div
    x-data="{ show: false }"
    x-show="show"
    x-on:open-modal.window="if ($event.detail.name === '{{ $modalName }}') show = true"
    x-on:close-modal.window="if ($event.detail.name === '{{ $modalName }}') show = false"
    x-on:toggle-modal.window="if ($event.detail.name === '{{ $modalName }}') show = !show"
    x-on:keydown.escape.window="show = false"
    style="display: none;"
    class="fixed inset-0 z-50 overflow-y-auto"
>
    <div 
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
        @click="show = false"
    ></div>

    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="relative min-h-screen flex items-center justify-center p-4 pointer-events-none"
    >
        <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl w-full {{ $maxWidthClass }} overflow-hidden pointer-events-auto transition-colors duration-300">
            @if($title)
                <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/30">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $title }}</h3>
                    <button @click="show = false" class="text-slate-400 dark:text-slate-600 hover:text-slate-600 dark:hover:text-slate-400 transition-colors">
                        <x-heroicon-o-x-mark class="size-6" />
                    </button>
                </div>
            @endif

            <div class="p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

