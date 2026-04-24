<x-layouts.dashboard pageTitle="Pengaturan" :breadcrumbs="[['label' => 'Pengaturan']]">
    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Key'],
            ['label' => 'Value'],
            ['label' => 'Group'],
        ]"
        searchRoute="/dashboard/settings"
        searchPlaceholder="Cari pengaturan..."
        createRoute="/dashboard/settings/create"
        createLabel="Tambah Setting">

        @forelse ($settings ?? [] as $item)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-4 text-sm font-medium text-slate-700 font-mono">{{ $item->key }}</td>
                <td class="px-5 py-4 text-sm text-slate-500 max-w-xs truncate">{{ $item->value }}</td>
                <td class="px-5 py-4">
                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 uppercase">
                        {{ $item->group }}
                    </span>
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="/dashboard/settings/{{ $item->id }}/edit"
                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition" title="Edit">
                            <x-heroicon-o-pencil-square class="size-4" />
                        </a>
                        <button onclick="openDeleteModal('/dashboard/settings/{{ $item->id }}', 'Hapus setting &quot;{{ $item->key }}&quot;?')"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <x-heroicon-o-trash class="size-4" />
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-dashboard.empty-state title="Belum ada pengaturan" icon="heroicon-o-cog-6-tooth"
                    createRoute="/dashboard/settings/create" />
            </x-slot:empty>
        @endforelse
    </x-dashboard.data-table>

    <x-molecules.dashboard.ui.modal-confirm />
</x-layouts.dashboard>
