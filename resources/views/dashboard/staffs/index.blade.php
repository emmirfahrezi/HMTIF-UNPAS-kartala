<x-dashboard-layout pageTitle="Pengurus" :breadcrumbs="[['label' => 'Pengurus']]">
    <x-dashboard.data-table
        :headers="[
            ['label' => 'Nama'],
            ['label' => 'Jabatan'],
            ['label' => 'Divisi'],
            ['label' => 'BPH'],
            ['label' => 'Aktif'],
        ]"
        searchRoute="/dashboard/staffs"
        searchPlaceholder="Cari pengurus..."
        createRoute="/dashboard/staffs/create"
        createLabel="Tambah Pengurus">

        @forelse ($staffs ?? [] as $item)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs shrink-0">
                            {{ strtoupper(substr($item->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-medium text-slate-700">{{ $item->name }}</span>
                    </div>
                </td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->position }}</td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->division?->name ?? '-' }}</td>
                <td class="px-5 py-4">
                    @if ($item->is_bph)
                        <x-heroicon-s-check-circle class="size-5 text-primary" />
                    @else
                        <x-heroicon-o-minus-circle class="size-5 text-slate-300" />
                    @endif
                </td>
                <td class="px-5 py-4">
                    @if ($item->is_active)
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-100 px-2.5 py-1 rounded-full">Aktif</span>
                    @else
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full">Nonaktif</span>
                    @endif
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="/dashboard/staffs/{{ $item->id }}/edit"
                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition" title="Edit">
                            <x-heroicon-o-pencil-square class="size-4" />
                        </a>
                        <button onclick="openDeleteModal('/dashboard/staffs/{{ $item->id }}', 'Hapus pengurus &quot;{{ $item->name }}&quot;?')"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <x-heroicon-o-trash class="size-4" />
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-dashboard.empty-state title="Belum ada pengurus" icon="heroicon-o-users"
                    createRoute="/dashboard/staffs/create" />
            </x-slot:empty>
        @endforelse

        @if (isset($staffs) && method_exists($staffs, 'hasPages'))
            <x-slot:pagination>
                <x-dashboard.pagination :paginator="$staffs" />
            </x-slot:pagination>
        @endif
    </x-dashboard.data-table>

    <x-dashboard.modal-confirm />
</x-dashboard-layout>
