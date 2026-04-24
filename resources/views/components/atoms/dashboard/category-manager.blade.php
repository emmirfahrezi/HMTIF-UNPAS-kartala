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
        <h2 class="text-lg font-bold text-slate-800">{{ $title }}</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Quick Add Form --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm h-fit">
            <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                <x-heroicon-o-plus-circle class="size-4 text-primary" />
                Tambah Cepat
            </h3>
            <form action="{{ $storeRoute }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama</label>
                    <input type="text" name="name" required placeholder="Nama..."
                        class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" />
                </div>
                <button type="submit"
                    class="w-full py-2.5 bg-primary text-white rounded-xl text-sm font-bold hover:bg-primary/90 transition shadow-lg shadow-primary/10">
                    Simpan
                </button>
            </form>
        </div>

        {{-- Category Table --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-5 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama</th>
                            <th class="px-5 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $countLabel }}</th>
                            <th class="px-5 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($categories as $category)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-5 py-4">
                                    <span class="text-sm font-semibold text-slate-700">{{ $category->name }}</span>
                                    <p class="text-[10px] text-slate-400 font-mono mt-0.5">{{ $category->slug }}</p>
                                </td>
                                <td class="px-5 py-4 text-sm text-slate-500">
                                    {{ $category->announcements_count ?? ($category->products_count ?? ($category->staffs_count ?? ($category->staffs?->count() ?? 0))) }}
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ $updateRoutePrefix }}/{{ $category->id }}/edit"
                                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/5 rounded-lg transition" title="Edit">
                                            <x-heroicon-o-pencil-square class="size-4" />
                                        </a>
                                        <button onclick="openDeleteModal('{{ $deleteRoutePrefix }}/{{ $category->id }}', 'Hapus &quot;{{ $category->name }}&quot;?')"
                                            class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                            <x-heroicon-o-trash class="size-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-5 py-8 text-center text-sm text-slate-400 italic">
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
