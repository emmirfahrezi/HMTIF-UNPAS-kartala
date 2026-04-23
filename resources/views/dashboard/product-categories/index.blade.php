<x-dashboard-layout pageTitle="Kategori Produk" :breadcrumbs="[['label' => 'Kategori Produk']]">
    <x-dashboard.data-table
        :headers="[
            ['label' => 'Nama'],
            ['label' => 'Slug'],
            ['label' => 'Jumlah Produk'],
        ]"
        searchRoute="/dashboard/product-categories"
        searchPlaceholder="Cari kategori..."
        createRoute="/dashboard/product-categories/create"
        createLabel="Tambah Kategori">

        @forelse ($categories ?? [] as $item)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-4 text-sm font-medium text-slate-700">{{ $item->name }}</td>
                <td class="px-5 py-4 text-sm text-slate-400 font-mono">{{ $item->slug }}</td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->products_count ?? $item->products->count() }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="/dashboard/product-categories/{{ $item->id }}/edit"
                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition" title="Edit">
                            <x-heroicon-o-pencil-square class="size-4" />
                        </a>
                        <button onclick="openDeleteModal('/dashboard/product-categories/{{ $item->id }}', 'Hapus kategori &quot;{{ $item->name }}&quot;?')"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <x-heroicon-o-trash class="size-4" />
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-dashboard.empty-state title="Belum ada kategori" icon="heroicon-o-rectangle-stack"
                    createRoute="/dashboard/product-categories/create" />
            </x-slot:empty>
        @endforelse

        @if (isset($categories) && method_exists($categories, 'hasPages'))
            <x-slot:pagination>
                <x-dashboard.pagination :paginator="$categories" />
            </x-slot:pagination>
        @endif
    </x-dashboard.data-table>

    <x-dashboard.modal-confirm />
</x-dashboard-layout>
