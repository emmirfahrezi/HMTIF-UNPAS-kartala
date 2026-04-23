<x-dashboard-layout pageTitle="Pengguna" :breadcrumbs="[['label' => 'Pengguna']]">
    <x-dashboard.data-table
        :headers="[
            ['label' => 'Nama'],
            ['label' => 'Email'],
            ['label' => 'Role'],
            ['label' => 'Bergabung'],
        ]"
        searchRoute="/dashboard/users"
        searchPlaceholder="Cari pengguna..."
        createRoute="/dashboard/users/create"
        createLabel="Tambah Pengguna">

        @forelse ($users as $item)
            @php
                $roleColors = [
                    'admin' => 'bg-red-100 text-red-700',
                    'bph' => 'bg-purple-100 text-purple-700',
                    'koordinator' => 'bg-blue-100 text-blue-700',
                    'staff' => 'bg-slate-100 text-slate-600',
                ];
            @endphp
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs shrink-0">
                            {{ strtoupper(substr($item->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-medium text-slate-700">{{ $item->name }}</span>
                    </div>
                </td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->email }}</td>
                <td class="px-5 py-4">
                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-full uppercase {{ $roleColors[$item->role] ?? 'bg-slate-100 text-slate-600' }}">
                        {{ $item->role }}
                    </span>
                </td>
                <td class="px-5 py-4 text-sm text-slate-500">{{ $item->created_at?->format('d M Y') }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="/dashboard/users/{{ $item->id }}/edit"
                            class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition" title="Edit">
                            <x-heroicon-o-pencil-square class="size-4" />
                        </a>
                        <button onclick="openDeleteModal('/dashboard/users/{{ $item->id }}', 'Hapus pengguna &quot;{{ $item->name }}&quot;?')"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <x-heroicon-o-trash class="size-4" />
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-dashboard.empty-state title="Belum ada pengguna" icon="heroicon-o-user-circle"
                    createRoute="/dashboard/users/create" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-dashboard.pagination :paginator="$users" />
        </x-slot:pagination>
    </x-dashboard.data-table>

    <x-dashboard.modal-confirm />
</x-dashboard-layout>
