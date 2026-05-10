<x-layouts.dashboard pageTitle="Bidang / Divisi" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Divisi']]">
    <x-slot:headerActions>
        <x-atoms.shared.button 
            type="button"
            onclick="toggleModal('quick-add-division')"
            icon="heroicon-o-plus">
            Tambah Divisi
        </x-atoms.shared.button>
    </x-slot:headerActions>

    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/staffs/divisions" 
        searchPlaceholder="Cari divisi..."
    />

    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Nama'],
            ['label' => 'Slug'],
            ['label' => 'Jumlah Pengurus'],
            ['label' => 'Urutan'],
        ]"
        bulkDeleteRoute="/dashboard/staffs/divisions/bulk-delete">

        @forelse ($divisions ?? [] as $item)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $item->id }}">
                <td class="px-4 py-4 w-12 text-center">
                    <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $item->id }}')" @change="toggleRow('{{ $item->id }}')" />
                </td>
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200">{{ $item->name }}</td>
                <td class="px-5 py-4 text-sm text-slate-400 dark:text-slate-500 font-mono">{{ $item->slug }}</td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->staffs_count ?? (isset($item->staffs) ? $item->staffs->count() : 0) }}</td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->order }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/staffs/divisions/{{ $item->id }}/edit"
                            class="size-9 !px-0"
                            title="Edit">
                            <x-heroicon-o-pencil-square class="size-5" />
                        </x-atoms.shared.button>
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            @click="openDeleteModal('/dashboard/staffs/divisions/{{ $item->id }}', 'Hapus divisi &quot;{{ $item->name }}&quot;?')"
                            class="size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                            title="Hapus">
                            <x-heroicon-o-trash class="size-5" />
                        </x-atoms.shared.button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-molecules.shared.empty-state title="Belum ada divisi" icon="heroicon-o-building-office">
                    <x-atoms.shared.button type="button" icon="heroicon-o-plus" onclick="toggleModal('quick-add-division')">
                        Tambah Divisi
                    </x-atoms.shared.button>
                </x-molecules.shared.empty-state>
            </x-slot:empty>
        @endforelse

        @if (isset($divisions) && method_exists($divisions, 'hasPages'))
            <x-slot:pagination>
                <x-molecules.dashboard.cards.pagination :paginator="$divisions" />
            </x-slot:pagination>
        @endif
    </x-molecules.dashboard.cards.data-table>

    <x-molecules.shared.modal-confirm />
</x-layouts.dashboard>
