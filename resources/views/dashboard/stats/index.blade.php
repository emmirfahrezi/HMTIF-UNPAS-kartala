<x-layouts.dashboard pageTitle="Statistik" :breadcrumbs="[['label' => 'Statistik']]">
    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Label'],
            ['label' => 'Nilai'],
            ['label' => 'Icon'],
            ['label' => 'Urutan'],
        ]"
        createRoute="/dashboard/stats/create"
        createLabel="Tambah Stat">

        @forelse ($stats ?? [] as $item)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-4 text-sm font-medium text-slate-700">{{ $item->label }}</td>
                <td class="px-5 py-4 text-sm text-slate-700 font-semibold">{{ $item->value }}</td>
                <td class="px-5 py-4 text-sm text-slate-400 font-mono">{{ $item->icon }}</td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->order }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="/dashboard/stats/{{ $item->id }}/edit"
                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition" title="Edit">
                            <x-heroicon-o-pencil-square class="size-4" />
                        </a>
                        <button onclick="openDeleteModal('/dashboard/stats/{{ $item->id }}', 'Hapus stat &quot;{{ $item->label }}&quot;?')"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <x-heroicon-o-trash class="size-4" />
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-dashboard.empty-state title="Belum ada statistik" icon="heroicon-o-chart-bar"
                    createRoute="/dashboard/stats/create" />
            </x-slot:empty>
        @endforelse
    </x-dashboard.data-table>

    <x-molecules.dashboard.ui.modal-confirm />
</x-layouts.dashboard>
