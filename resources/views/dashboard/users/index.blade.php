<x-layouts.dashboard pageTitle="Pengguna" :breadcrumbs="[['label' => 'Pengguna']]">
    <x-slot:headerActions>
        <a href="/dashboard/users/create"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all active:scale-95 shrink-0">
            <x-heroicon-o-plus class="size-4" />
            Tambah Pengguna
        </a>
    </x-slot:headerActions>

    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/users" 
        searchPlaceholder="Cari pengguna...">
        <div class="flex items-center gap-2 border-l border-slate-100 pl-3">
            <label class="text-xs font-bold text-slate-400 uppercase tracking-wider whitespace-nowrap">Role</label>
            <select name="role" onchange="this.form.submit()"
                class="pl-3 pr-8 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary/20 transition cursor-pointer appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20stroke%3D%22%236B7280%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%221.5%22%20d%3D%22m6%208%204%204%204-4%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_0.5rem_center] bg-no-repeat">
                <option value="">Semua</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="bph" {{ request('role') == 'bph' ? 'selected' : '' }}>BPH</option>
                <option value="koordinator" {{ request('role') == 'koordinator' ? 'selected' : '' }}>Koordinator</option>
                <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff</option>
            </select>
        </div>
    </x-dashboard.filter-card>

    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Nama'],
            ['label' => 'Email'],
            ['label' => 'Role'],
            ['label' => 'Bergabung'],
        ]">

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
                <x-molecules.dashboard.ui.empty-state title="Belum ada pengguna" icon="heroicon-o-user-circle"
                    createRoute="/dashboard/users/create" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-molecules.dashboard.cards.pagination :paginator="$users" />
        </x-slot:pagination>
    </x-dashboard.data-table>

    <x-molecules.dashboard.ui.modal-confirm />
</x-layouts.dashboard>
