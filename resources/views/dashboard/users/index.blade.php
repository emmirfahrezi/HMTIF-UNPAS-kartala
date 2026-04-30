<x-layouts.dashboard pageTitle="Pengguna" :breadcrumbs="[['label' => 'Pengguna']]">
    <x-slot:headerActions>
        <x-atoms.shared.button 
            href="/dashboard/users/create"
            icon="heroicon-o-plus">
            Tambah Pengguna
        </x-atoms.shared.button>
    </x-slot:headerActions>

    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/users" 
        searchPlaceholder="Cari pengguna...">
        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3">
            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Urutkan</label>
            <div class="w-44">
                <x-molecules.shared.forms.form-input 
                    type="select"
                    name="sort"
                    :value="request('sort', 'latest')"
                    :options="['latest' => 'Terbaru', 'oldest' => 'Terlama', 'az' => 'Nama A-Z', 'za' => 'Nama Z-A']"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)"
                />
            </div>
        </div>

        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3">
            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Role</label>
            <div class="w-32">
                <x-molecules.shared.forms.form-input 
                    type="select"
                    name="role"
                    :value="request('role')"
                    :options="['' => 'Semua', 'admin' => 'Admin', 'bph' => 'BPH', 'koordinator' => 'Koordinator', 'staff' => 'Staff']"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)"
                />
            </div>
        </div>
    </x-molecules.dashboard.cards.filter-card>

    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Nama'],
            ['label' => 'Email'],
            ['label' => 'Role'],
            ['label' => 'Bergabung'],
        ]"
        bulkDeleteRoute="/dashboard/users/bulk-delete">

        @forelse ($users as $item)
            @php
                $roleColors = [
                    'admin' => 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-500',
                    'bph' => 'bg-purple-100 dark:bg-purple-500/10 text-purple-700 dark:text-purple-500',
                    'koordinator' => 'bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-500',
                    'staff' => 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400',
                ];
            @endphp
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition" data-row-id="{{ $item->id }}">
                <td class="px-4 py-4 w-12">
                    <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $item->id }}')" @change="toggleRow('{{ $item->id }}')" />
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-primary/10 dark:bg-primary/20 flex items-center justify-center text-primary font-bold text-xs shrink-0">
                            {{ strtoupper(substr($item->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-200">{{ $item->name }}</span>
                    </div>
                </td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->email }}</td>
                <td class="px-5 py-4">
                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-full uppercase {{ $roleColors[$item->role] ?? 'bg-slate-100 text-slate-600' }}">
                        {{ $item->role }}
                    </span>
                </td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->created_at?->format('d M Y') }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/users/{{ $item->id }}/edit"
                            class="size-9 !px-0"
                            title="Edit">
                            <x-heroicon-o-pencil-square class="size-5" />
                        </x-atoms.shared.button>
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            @click="openDeleteModal('/dashboard/users/{{ $item->id }}', 'Hapus pengguna &quot;{{ $item->name }}&quot;?')"
                            class="size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                            title="Hapus">
                            <x-heroicon-o-trash class="size-5" />
                        </x-atoms.shared.button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-molecules.shared.empty-state title="Belum ada pengguna" icon="heroicon-o-user-circle"
                    createRoute="/dashboard/users/create" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-molecules.dashboard.cards.pagination :paginator="$users" />
        </x-slot:pagination>
    </x-molecules.dashboard.cards.data-table>


</x-layouts.dashboard>

