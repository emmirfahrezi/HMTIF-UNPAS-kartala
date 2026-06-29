@props([
    'title' => 'Manajemen Kategori',
    'subtitle' => 'Kelola kategori untuk modul ini',
    'addModalId' => null,
    'manageRoute' => null,
    'manageItems' => [],
    'showQuickAdd' => true,
    'showManage' => true,
    'manageLabel' => 'Lihat Semua',
])

@php
    $manageItems = collect($manageItems ?? [])->filter(fn ($item) => filled($item['href'] ?? null))->values();
@endphp

<div class="bg-white dark:bg-slate-900/50 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-sm hover:shadow-md transition-all duration-300 mb-8">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary shrink-0">
            <x-heroicon-o-tag class="size-6" />
        </div>
        <div>
            <h3 class="text-base font-bold text-slate-800 dark:text-white leading-tight">{{ $title }}</h3>
            <p class="text-sm text-slate-400 dark:text-slate-500 mt-0.5">{{ $subtitle }}</p>
        </div>
    </div>
    @if ($showQuickAdd || ($showManage && $manageRoute))
    <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
        @if ($showQuickAdd && $addModalId)
        <button type="button" @click="$dispatch('open-modal', { name: '{{ $addModalId }}' })" 
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-primary/10 dark:bg-primary/20 text-primary rounded-xl text-sm font-bold hover:bg-primary/20 dark:hover:bg-primary/30 transition active:scale-95">
            <x-heroicon-o-plus-circle class="size-4" />
            <span>Tambah Cepat</span>
        </button>
        @endif
        @if ($showManage && $manageItems->isNotEmpty())
        <div class="relative w-full sm:w-auto" x-data="{ open: false }">
            <button type="button" @click="open = !open"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-xl text-sm font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                <x-heroicon-o-table-cells class="size-4" />
                <span>{{ $manageLabel }}</span>
                <x-heroicon-o-chevron-down class="size-4 transition-transform" x-bind:class="{ 'rotate-180': open }" />
            </button>

            <div x-show="open" x-transition @click.outside="open = false" x-cloak
                class="absolute right-0 z-40 mt-3 w-72 overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-xl shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-950 dark:shadow-black/40">
                @foreach ($manageItems as $item)
                    <a href="{{ $item['href'] }}"
                        class="flex items-start gap-3 rounded-xl px-3 py-3 text-left transition hover:bg-slate-50 dark:hover:bg-slate-900">
                        <span class="mt-0.5 flex size-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <x-dynamic-component :component="$item['icon'] ?? 'heroicon-o-table-cells'" class="size-5" />
                        </span>
                        <span class="min-w-0">
                            <span class="block text-sm font-black text-slate-700 dark:text-slate-200">{{ $item['label'] ?? 'Kelola Data' }}</span>
                            @if (filled($item['description'] ?? null))
                                <span class="mt-1 block text-xs font-medium leading-5 text-slate-400 dark:text-slate-500">{{ $item['description'] }}</span>
                            @endif
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
        @elseif ($showManage && $manageRoute)
        <a href="{{ $manageRoute }}"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-xl text-sm font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition">
            <x-heroicon-o-table-cells class="size-4" />
            <span>{{ $manageLabel }}</span>
        </a>
        @endif
    </div>
    @endif
</div>

