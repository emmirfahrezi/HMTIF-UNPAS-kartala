<x-layouts.dashboard pageTitle="Notulensi Rapat" :breadcrumbs="[['label' => 'Notulensi']]">
    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Nomor'],
            ['label' => 'Perihal'],
            ['label' => 'Tanggal'],
            ['label' => 'Dipimpin Oleh'],
        ]"
        searchRoute="/dashboard/minutes"
        searchPlaceholder="Cari notulensi..."
        createRoute="/dashboard/minutes/create"
        createLabel="Tambah Notulensi">

        @forelse ($minutes ?? [] as $item)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-4 text-sm font-medium text-slate-700 font-mono">{{ $item->nomor }}</td>
                <td class="px-5 py-4 text-sm text-slate-700 max-w-xs truncate">{{ $item->perihal }}</td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->tanggal?->format('d M Y') }}</td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->dipimpin_oleh }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="/dashboard/minutes/{{ $item->id }}/edit"
                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition" title="Edit">
                            <x-heroicon-o-pencil-square class="size-4" />
                        </a>
                        <button onclick="openDeleteModal('/dashboard/minutes/{{ $item->id }}', 'Hapus notulensi &quot;{{ $item->nomor }}&quot;?')"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <x-heroicon-o-trash class="size-4" />
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-dashboard.empty-state title="Belum ada notulensi" icon="heroicon-o-clipboard-document-list"
                    createRoute="/dashboard/minutes/create" />
            </x-slot:empty>
        @endforelse

        @if (isset($minutes) && method_exists($minutes, 'hasPages'))
            <x-slot:pagination>
                <x-molecules.dashboard.cards.pagination :paginator="$minutes" />
            </x-slot:pagination>
        @endif
    </x-dashboard.data-table>

    <x-molecules.dashboard.ui.modal-confirm />
</x-layouts.dashboard>
