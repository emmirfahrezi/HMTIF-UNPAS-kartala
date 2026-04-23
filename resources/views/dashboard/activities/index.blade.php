<x-dashboard-layout pageTitle="Kegiatan" :breadcrumbs="[['label' => 'Kegiatan']]">
    <x-dashboard.data-table
        :headers="[
            ['label' => 'Judul'],
            ['label' => 'Status'],
            ['label' => 'Tanggal Mulai'],
            ['label' => 'Lokasi'],
        ]"
        searchRoute="/dashboard/activities"
        searchPlaceholder="Cari kegiatan..."
        createRoute="/dashboard/activities/create"
        createLabel="Tambah Kegiatan">

        @forelse ($activities as $item)
            @php
                $statusColors = [
                    'upcoming' => 'bg-blue-100 text-blue-700',
                    'ongoing' => 'bg-emerald-100 text-emerald-700',
                    'past' => 'bg-slate-100 text-slate-600',
                ];
            @endphp
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-4 text-sm font-medium text-slate-700 max-w-xs truncate">{{ $item->title }}</td>
                <td class="px-5 py-4">
                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-full uppercase {{ $statusColors[$item->status] ?? 'bg-slate-100 text-slate-600' }}">
                        {{ $item->status }}
                    </span>
                </td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->start_date?->format('d M Y H:i') }}</td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->location ?? '-' }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="/dashboard/activities/{{ $item->id }}/edit"
                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition" title="Edit">
                            <x-heroicon-o-pencil-square class="size-4" />
                        </a>
                        <button onclick="openDeleteModal('/dashboard/activities/{{ $item->id }}', 'Hapus kegiatan &quot;{{ $item->title }}&quot;?')"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <x-heroicon-o-trash class="size-4" />
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-dashboard.empty-state title="Belum ada kegiatan" icon="heroicon-o-calendar"
                    createRoute="/dashboard/activities/create" createLabel="Tambah Kegiatan" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-dashboard.pagination :paginator="$activities" />
        </x-slot:pagination>
    </x-dashboard.data-table>

    <x-dashboard.modal-confirm />
</x-dashboard-layout>
