<x-dashboard-layout pageTitle="Pengumuman" :breadcrumbs="[['label' => 'Pengumuman']]">
    <x-dashboard.data-table
        :headers="[
            ['label' => 'Judul'],
            ['label' => 'Kategori'],
            ['label' => 'Tanggal Terbit'],
        ]"
        searchRoute="/dashboard/announcements"
        searchPlaceholder="Cari pengumuman..."
        createRoute="/dashboard/announcements/create"
        createLabel="Tambah Pengumuman">

        @forelse ($announcements as $item)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-4 text-sm font-medium text-slate-700 max-w-xs truncate">{{ $item->title }}</td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->category?->name ?? '-' }}</td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->published_at?->format('d M Y') ?? '-' }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="/dashboard/announcements/{{ $item->id }}/edit"
                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition" title="Edit">
                            <x-heroicon-o-pencil-square class="size-4" />
                        </a>
                        <button onclick="openDeleteModal('/dashboard/announcements/{{ $item->id }}', 'Hapus pengumuman &quot;{{ $item->title }}&quot;?')"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <x-heroicon-o-trash class="size-4" />
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-dashboard.empty-state title="Belum ada pengumuman" icon="heroicon-o-megaphone"
                    createRoute="/dashboard/announcements/create" createLabel="Tambah Pengumuman" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-dashboard.pagination :paginator="$announcements" />
        </x-slot:pagination>
    </x-dashboard.data-table>

    <x-dashboard.modal-confirm />
</x-dashboard-layout>
