@props([
    'title' => 'Manajemen Kategori',
    'subtitle' => 'Kelola kategori untuk modul ini',
    'addModalId',
    'manageRoute',
])

<div class="bg-white p-6 rounded-2xl border border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-sm hover:shadow-md transition-shadow mb-8">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary shrink-0">
            <x-heroicon-o-tag class="size-6" />
        </div>
        <div>
            <h3 class="text-base font-bold text-slate-800 leading-tight">{{ $title }}</h3>
            <p class="text-sm text-slate-400 mt-0.5">{{ $subtitle }}</p>
        </div>
    </div>
    <div class="flex items-center gap-3 w-full sm:w-auto">
        <button onclick="toggleModal('{{ $addModalId }}')" 
            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-primary/10 text-primary rounded-xl text-sm font-bold hover:bg-primary/20 transition active:scale-95">
            <x-heroicon-o-plus-circle class="size-4" />
            <span>Tambah Cepat</span>
        </button>
        <a href="{{ $manageRoute }}" 
            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-200 transition">
            <x-heroicon-o-table-cells class="size-4" />
            <span>Lihat Semua</span>
        </a>
    </div>
</div>
