@props([
    'title' => 'Manajemen Kategori',
    'categories' => [],
    'storeRoute' => '',
    'updateRoutePrefix' => '',
    'deleteRoutePrefix' => '',
    'countLabel' => 'Jumlah Item',
    'icon' => 'heroicon-o-tag',
])

<div class="mt-12">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-1.5 h-6 bg-primary rounded-full"></div>
        <h2 class="text-lg font-bold text-slate-800 dark:text-white">{{ $title }}</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Quick Add Form --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm h-fit transition-colors duration-300">
            <h3 class="text-sm font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <x-heroicon-o-plus-circle class="size-4 text-primary" />
                Tambah Cepat
            </h3>
            <form action="{{ $storeRoute }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Nama</label>
                    <input type="text" name="name" required placeholder="Nama..."
                        class="w-full px-4 py-2 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl text-sm dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" />
                </div>
                <button type="submit"
                    class="w-full py-2.5 bg-primary text-white rounded-xl text-sm font-bold hover:bg-primary/90 transition shadow-lg shadow-primary/10">
                    Simpan
                </button>
            </form>
        </div>

        {{-- Category Table --}}
        <div class="lg:col-span-2 bg-white dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm transition-colors duration-300">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/80 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                            <th class="px-5 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama</th>
                            <th class="px-5 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ $countLabel }}</th>
                            <th class="px-5 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                        @forelse ($categories as $category)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition">
                                <td class="px-5 py-4">
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $category->name }}</span>
                                    <p class="text-[10px] text-slate-400 dark:text-slate-500 font-mono mt-0.5">{{ $category->slug }}</p>
                                </td>
                                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">
                                    {{ $category->announcements_count ?? ($category->products_count ?? ($category->staffs_count ?? ($category->staffs?->count() ?? 0))) }}
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ $updateRoutePrefix }}/{{ $category->id }}/edit"
                                            class="p-2 text-slate-400 dark:text-slate-500 hover:text-primary hover:bg-primary/5 dark:hover:bg-primary/10 rounded-lg transition" title="Edit">
                                            <x-heroicon-o-pencil-square class="size-4" />
                                        </a>
                                        <button onclick="openDeleteModal('{{ $deleteRoutePrefix }}/{{ $category->id }}', 'Hapus &quot;{{ $category->name }}&quot;?')"
                                            class="p-2 text-slate-400 dark:text-slate-500 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition" title="Hapus">
                                            <x-heroicon-o-trash class="size-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-5 py-8 text-center text-sm text-slate-400 dark:text-slate-600 italic">
                                    Belum ada data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
