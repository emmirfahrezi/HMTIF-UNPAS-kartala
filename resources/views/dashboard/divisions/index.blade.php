<x-dashboard-layout pageTitle="Bidang / Divisi" :breadcrumbs="[['label' => 'Divisi']]">
    <x-dashboard.data-table
        :headers="[
            ['label' => 'Nama'],
            ['label' => 'Slug'],
            ['label' => 'Jumlah Pengurus'],
            ['label' => 'Urutan'],
        ]"
        searchRoute="/dashboard/divisions"
        searchPlaceholder="Cari divisi..."
        createRoute="/dashboard/divisions/create"
        createLabel="Tambah Divisi">

        @forelse ($divisions ?? [] as $item)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-4 text-sm font-medium text-slate-700">{{ $item->name }}</td>
                <td class="px-5 py-4 text-sm text-slate-400 font-mono">{{ $item->slug }}</td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->staffs_count ?? $item->staffs->count() }}</td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->order }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="/dashboard/divisions/{{ $item->id }}/edit"
                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition" title="Edit">
                            <x-heroicon-o-pencil-square class="size-4" />
                        </a>
                        <button onclick="openDeleteModal('/dashboard/divisions/{{ $item->id }}', 'Hapus divisi &quot;{{ $item->name }}&quot;?')"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <x-heroicon-o-trash class="size-4" />
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-dashboard.empty-state title="Belum ada divisi" icon="heroicon-o-building-office"
                    createRoute="/dashboard/divisions/create" />
            </x-slot:empty>
        @endforelse

        @if (isset($divisions) && method_exists($divisions, 'hasPages'))
            <x-slot:pagination>
                <x-dashboard.pagination :paginator="$divisions" />
            </x-slot:pagination>
        @endif
    </x-dashboard.data-table>

    <x-dashboard.modal-confirm />
</x-dashboard-layout>
