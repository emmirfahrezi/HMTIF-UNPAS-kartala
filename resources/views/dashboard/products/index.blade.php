<x-dashboard-layout pageTitle="Produk" :breadcrumbs="[['label' => 'Produk']]">
    <x-dashboard.data-table
        :headers="[
            ['label' => 'Nama'],
            ['label' => 'Kategori'],
            ['label' => 'Harga'],
            ['label' => 'Tersedia'],
        ]"
        searchRoute="/dashboard/products"
        searchPlaceholder="Cari produk..."
        createRoute="/dashboard/products/create"
        createLabel="Tambah Produk">

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
            <x-slot:empty>
                <x-dashboard.empty-state title="Belum ada produk" icon="heroicon-o-shopping-bag"
                    createRoute="/dashboard/products/create" createLabel="Tambah Produk" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-dashboard.pagination :paginator="$products" />
        </x-slot:pagination>
    </x-dashboard.data-table>

    <x-dashboard.modal-confirm />
</x-dashboard-layout>
