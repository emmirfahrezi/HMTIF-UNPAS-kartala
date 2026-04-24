<x-layouts.dashboard pageTitle="Produk" :breadcrumbs="[['label' => 'Produk']]">
    <x-slot:headerActions>
        <a href="/dashboard/products/create"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all active:scale-95 shrink-0">
            <x-heroicon-o-plus class="size-4" />
            Tambah Produk
        </a>
    </x-slot:headerActions>

    <x-molecules.dashboard.cards.category-card 
        title="Kategori Produk"
        subtitle="Kelola kategori produk untuk toko HMTIF"
        addModalId="quick-add-category-product"
        manageRoute="/dashboard/products/categories"
    />

    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/products" 
        searchPlaceholder="Cari produk...">
        <div class="flex items-center gap-2 border-l border-slate-100 pl-3">
            <label class="text-xs font-bold text-slate-400 uppercase tracking-wider whitespace-nowrap">Kategori</label>
            <select name="category" onchange="this.form.submit()"
                class="pl-3 pr-8 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary/20 transition cursor-pointer appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20stroke%3D%22%236B7280%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%221.5%22%20d%3D%22m6%208%204%204%204-4%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_0.5rem_center] bg-no-repeat">
                <option value="">Semua</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
    </x-dashboard.filter-card>

    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Nama'],
            ['label' => 'Kategori'],
            ['label' => 'Harga'],
            ['label' => 'Tersedia'],
        ]">

        @forelse ($products as $item)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-4 text-sm font-medium text-slate-700">{{ $item->name }}</td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->category?->name ?? '-' }}</td>
                <td class="px-5 py-4 text-sm text-slate-700 font-semibold">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="px-5 py-4">
                    @if ($item->is_available)
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-100 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Ya
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Tidak
                        </span>
                    @endif
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="/dashboard/products/{{ $item->id }}/edit"
                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition" title="Edit">
                            <x-heroicon-o-pencil-square class="size-4" />
                        </a>
                        <button onclick="openDeleteModal('/dashboard/products/{{ $item->id }}', 'Hapus produk &quot;{{ $item->name }}&quot;?')"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <x-heroicon-o-trash class="size-4" />
                        </button>
                    </div>
                </td>
            </tr>
        @empty
        @endforelse

        <x-slot:empty>
            @if ($products->isEmpty())
                <x-molecules.dashboard.ui.empty-state title="Belum ada produk" icon="heroicon-o-shopping-bag"
                    createRoute="/dashboard/products/create" createLabel="Tambah Produk" />
            @endif
        </x-slot:empty>

        <x-slot:pagination>
            <x-molecules.dashboard.cards.pagination :paginator="$products" />
        </x-slot:pagination>
    </x-dashboard.data-table>

    <x-molecules.dashboard.ui.modal id="quick-add-category-product" title="Tambah Kategori Produk">
        <form action="/dashboard/products/categories" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Kategori</label>
                <input type="text" name="name" required placeholder="Masukan nama kategori..."
                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" />
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="toggleModal('quick-add-category-product')"
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
