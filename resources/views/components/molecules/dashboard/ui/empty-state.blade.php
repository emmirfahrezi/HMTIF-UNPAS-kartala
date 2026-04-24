{{-- Empty State --}}
@props([
    'title' => 'Belum ada data',
    'description' => 'Data yang ditambahkan akan tampil di sini.',
    'icon' => 'heroicon-o-inbox',
    'createRoute' => null,
    'createLabel' => 'Tambah Baru',
    'onclick' => null,
])

<div class="flex flex-col items-center justify-center py-16 px-6 text-center">
    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-5">
        <x-dynamic-component :component="$icon" class="size-7 text-slate-400" />
    </div>
    <h3 class="text-base font-bold text-slate-600 mb-1">{{ $title }}</h3>
    <p class="text-sm text-slate-400 max-w-sm">{{ $description }}</p>
    @if ($onclick)
        <button type="button" onclick="{{ $onclick }}"
            class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 transition active:scale-95">
            <x-heroicon-o-plus class="size-4" />
            {{ $createLabel }}
        </button>
    @elseif ($createRoute)
        <a href="{{ $createRoute }}"
            class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 transition active:scale-95">
            <x-heroicon-o-plus class="size-4" />
            {{ $createLabel }}
        </a>
    @endif
</div>
