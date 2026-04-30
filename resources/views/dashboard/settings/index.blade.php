<x-layouts.dashboard pageTitle="Pengaturan" :breadcrumbs="[['label' => 'Pengaturan']]">
    <x-slot:headerActions>
        <x-atoms.shared.button 
            href="/dashboard/settings/create"
            icon="heroicon-o-plus">
            Tambah Setting
        </x-atoms.shared.button>
    </x-slot:headerActions>

    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Key'],
            ['label' => 'Value'],
            ['label' => 'Group'],
        ]"
        searchRoute="/dashboard/settings"
        searchPlaceholder="Cari pengaturan..."
        bulkDeleteRoute="/dashboard/settings/bulk-delete">

        @forelse ($settings ?? [] as $item)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $item->id }}">
                <td class="px-4 py-4 w-12 text-center">
                    <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $item->id }}')" @change="toggleRow('{{ $item->id }}')" />
                </td>
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200 font-mono">{{ $item->key }}</td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400 max-w-xs truncate">{{ $item->value }}</td>
                <td class="px-5 py-4 text-sm">
                    <span class="text-[11px] font-black px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 uppercase tracking-wider border border-slate-200 dark:border-slate-700">
                        {{ $item->group }}
                    </span>
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/settings/{{ $item->id }}/edit"
                            class="size-9 !px-0"
                            title="Edit">
                            <x-heroicon-o-pencil-square class="size-5" />
                        </x-atoms.shared.button>
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            @click="openDeleteModal('/dashboard/settings/{{ $item->id }}', 'Hapus setting &quot;{{ $item->key }}&quot;?')"
                            class="size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                            title="Hapus">
                            <x-heroicon-o-trash class="size-5" />
                        </x-atoms.shared.button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-molecules.shared.empty-state title="Belum ada pengaturan" icon="heroicon-o-cog-6-tooth"
                    createRoute="/dashboard/settings/create" createLabel="Tambah Setting" />
            </x-slot:empty>
        @endforelse

        @if (isset($settings) && method_exists($settings, 'hasPages'))
            <x-slot:pagination>
                <x-molecules.dashboard.cards.pagination :paginator="$settings" />
            </x-slot:pagination>
        @endif
    </x-molecules.dashboard.cards.data-table>

    <x-molecules.shared.modal-confirm />
</x-layouts.dashboard>
