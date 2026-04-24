<x-layouts.dashboard pageTitle="Kategori Pengumuman" :breadcrumbs="[['label' => 'Pengumuman', 'href' => '/dashboard/announcements'], ['label' => 'Kategori']]">
    <x-slot:headerActions>
        <button type="button" onclick="toggleModal('quick-add-category')"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all active:scale-95 shrink-0">
            <x-heroicon-o-plus class="size-4" />
            Tambah Kategori
        </button>
    </x-slot:headerActions>

    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/announcements/categories" 
        searchPlaceholder="Cari kategori..."
    />

    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Nama'],
            ['label' => 'Slug'],
            ['label' => 'Jumlah Pengumuman'],
        ]">

        @forelse ($categories ?? [] as $item)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-4 text-sm font-medium text-slate-700">{{ $item->name }}</td>
                <td class="px-5 py-4 text-sm text-slate-400 font-mono">{{ $item->slug }}</td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->announcements_count ?? $item->announcements->count() }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="/dashboard/announcements/categories/{{ $item->id }}/edit"
                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition" title="Edit">
                            <x-heroicon-o-pencil-square class="size-4" />
                        </a>
                        <button onclick="openDeleteModal('/dashboard/announcements/categories/{{ $item->id }}', 'Hapus kategori &quot;{{ $item->name }}&quot;?')"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <x-heroicon-o-trash class="size-4" />
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-dashboard.empty-state title="Belum ada kategori" icon="heroicon-o-tag"
                    onclick="toggleModal('quick-add-category')" />
            </x-slot:empty>
        @endforelse

        @if (isset($categories) && method_exists($categories, 'hasPages'))
            <x-slot:pagination>
                <x-molecules.dashboard.cards.pagination :paginator="$categories" />
            </x-slot:pagination>
        @endif
    </x-dashboard.data-table>

    <x-molecules.dashboard.ui.modal id="quick-add-category" title="Tambah Kategori Pengumuman">
        <form action="/dashboard/announcements/categories" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Kategori</label>
                <input type="text" name="name" required placeholder="Masukan nama kategori..."
                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" />
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="toggleModal('quick-add-category')"
                    class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 rounded-xl transition">Batal</button>
                <button type="submit"
                    class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold hover:bg-primary/90 transition shadow-lg shadow-primary/20">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </x-dashboard.modal>

    <x-molecules.dashboard.ui.modal-confirm />
</x-layouts.dashboard>
