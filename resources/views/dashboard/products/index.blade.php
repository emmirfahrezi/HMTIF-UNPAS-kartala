<x-layouts.dashboard pageTitle="Produk" :breadcrumbs="[['label' => 'Produk']]">
    <x-slot:headerActions>
        <x-atoms.shared.button 
            href="/dashboard/products/create"
            icon="heroicon-o-plus">
            Tambah Produk
        </x-atoms.shared.button>
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
        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Urutkan</label>
            <div class="w-44">
                <x-molecules.shared.forms.form-input 
                    type="select"
                    name="sort"
                    :value="request('sort', 'latest')"
                    :options="['latest' => 'Terbaru', 'oldest' => 'Terlama', 'az' => 'Nama A-Z', 'za' => 'Nama Z-A', 'cheap' => 'Termurah', 'expensive' => 'Termahal']"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)"
                />
            </div>
        </div>

        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Kategori</label>
            <div class="w-44">
                <x-molecules.shared.forms.form-input 
                    type="select"
                    name="category"
                    :value="request('category')"
                    :options="$categories->pluck('name', 'id')->prepend('Semua', '')->toArray()"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)"
                />
            </div>
        </div>
    </x-molecules.dashboard.cards.filter-card>

    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Nama'],
            ['label' => 'Kategori'],
            ['label' => 'Harga'],
            ['label' => 'Tersedia'],
        ]"
        bulkDeleteRoute="/dashboard/products/bulk-delete">

        @forelse ($products as $item)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $item->id }}">
                <td class="px-4 py-4 w-12">
                    <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $item->id }}')" @change="toggleRow('{{ $item->id }}')" />
                </td>
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200">{{ $item->name }}</td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->category?->name ?? '-' }}</td>
                <td class="px-5 py-4 text-sm text-slate-700 dark:text-slate-200 font-semibold">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="px-5 py-4">
                    @if ($item->is_available)
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-500/10 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Ya
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Tidak
                        </span>
                    @endif
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/products/{{ $item->id }}/edit"
                            class="size-9 !px-0"
                            title="Edit">
                            <x-heroicon-o-pencil-square class="size-5" />
                        </x-atoms.shared.button>
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            @click="openDeleteModal('/dashboard/products/{{ $item->id }}', 'Hapus produk &quot;{{ $item->name }}&quot;?')"
                            class="size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                            title="Hapus">
                            <x-heroicon-o-trash class="size-5" />
                        </x-atoms.shared.button>
                    </div>
                </td>
            </tr>
        @empty
        @endforelse

        <x-slot:empty>
            @if ($products->isEmpty())
                <x-molecules.shared.empty-state title="Belum ada produk" icon="heroicon-o-shopping-bag"
                    createRoute="/dashboard/products/create" createLabel="Tambah Produk" />
            @endif
        </x-slot:empty>

        <x-slot:pagination>
            <x-molecules.dashboard.cards.pagination :paginator="$products" />
        </x-slot:pagination>
    </x-molecules.dashboard.cards.data-table>

    <x-molecules.shared.modal id="quick-add-category-product" title="Tambah Kategori Produk">
        <form action="/dashboard/products/categories" method="POST" class="space-y-4" x-data="slugHelper(@js(old('name')), @js(old('slug')))">
            @csrf
            <x-molecules.shared.forms.form-input 
                label="Nama Kategori"
                name="name"
                required
                placeholder="Masukan nama kategori..."
                x-model="sourceValue"
            />
            <x-molecules.shared.forms.form-input 
                label="Slug"
                name="slug"
                readonly
                placeholder="auto-generated"
                x-model="slugValue"
                helper="Slug akan terisi otomatis berdasarkan nama"
            />
            <div class="flex justify-end gap-3 mt-6">
                <x-atoms.shared.button 
                    variant="ghost"
                    type="button"
                    onclick="toggleModal('quick-add-category-product')">
                    Batal
                </x-atoms.shared.button>
                <x-atoms.shared.button 
                    type="submit">
                    Simpan Kategori
                </x-atoms.shared.button>
            </div>
        </form>
    </x-molecules.shared.modal>


</x-layouts.dashboard>


