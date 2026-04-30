@props([
    'title' => 'Manajemen Kategori',
    'subtitle' => 'Kelola kategori untuk modul ini',
    'addModalId',
    'manageRoute',
])

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
    <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
        <button onclick="toggleModal('{{ $addModalId }}')" 
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-primary/10 dark:bg-primary/20 text-primary rounded-xl text-sm font-bold hover:bg-primary/20 dark:hover:bg-primary/30 transition active:scale-95">
            <x-heroicon-o-plus-circle class="size-4" />
            <span>Tambah Cepat</span>
        </button>
        <a href="{{ $manageRoute }}" 
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-xl text-sm font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition">
            <x-heroicon-o-table-cells class="size-4" />
            <span>Lihat Semua</span>
        </a>
    </div>
</div>

