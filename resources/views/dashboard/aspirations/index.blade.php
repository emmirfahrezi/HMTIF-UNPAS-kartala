<x-dashboard-layout pageTitle="Aspirasi" :breadcrumbs="[['label' => 'Aspirasi']]">
    <x-dashboard.data-table
        :headers="[
            ['label' => 'Subjek'],
            ['label' => 'Status'],
            ['label' => 'Spotlight'],
            ['label' => 'Tanggal'],
        ]"
        searchRoute="/dashboard/aspirations"
        searchPlaceholder="Cari aspirasi..."
        createRoute="/dashboard/aspirations/create"
        createLabel="Tambah Aspirasi">

        @forelse ($aspirations as $item)
            @php
                $statusColors = [
                    'pending' => 'bg-amber-100 text-amber-700',
                    'reviewed' => 'bg-blue-100 text-blue-700',
                    'resolved' => 'bg-emerald-100 text-emerald-700',
                    'rejected' => 'bg-red-100 text-red-700',
                ];
            @endphp
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-4 text-sm font-medium text-slate-700 max-w-xs truncate">{{ $item->subject }}</td>
                <td class="px-5 py-4">
                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-full uppercase {{ $statusColors[$item->status] ?? 'bg-slate-100 text-slate-600' }}">
                        {{ $item->status }}
                    </span>
                </td>
                <td class="px-5 py-4">
                    @if ($item->is_spotlight)
                        <x-heroicon-s-star class="size-5 text-amber-400" />
                    @else
                        <x-heroicon-o-star class="size-5 text-slate-300" />
                    @endif
                </td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->created_at?->format('d M Y') }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="/dashboard/aspirations/{{ $item->id }}/edit"
                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition" title="Edit">
                            <x-heroicon-o-pencil-square class="size-4" />
                        </a>
                        <button onclick="openDeleteModal('/dashboard/aspirations/{{ $item->id }}', 'Hapus aspirasi ini?')"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <x-heroicon-o-trash class="size-4" />
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-dashboard.empty-state title="Belum ada aspirasi" icon="heroicon-o-chat-bubble-left-right"
                    createRoute="/dashboard/aspirations/create" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-dashboard.pagination :paginator="$aspirations" />
        </x-slot:pagination>
    </x-dashboard.data-table>

    <x-dashboard.modal-confirm />
</x-dashboard-layout>
