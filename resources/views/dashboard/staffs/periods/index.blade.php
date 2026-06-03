<x-layouts.dashboard pageTitle="Periode Kepengurusan" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Periode']]">
    @if (!$permissions['read'])
        <div class="flex flex-col items-center justify-center pt-16 pb-24 px-4 bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm mt-8">
            <div class="w-16 h-16 bg-red-50 dark:bg-red-500/10 rounded-2xl flex items-center justify-center text-red-500 mb-6 shadow-inner animate-pulse">
                <x-heroicon-o-lock-closed class="size-8" />
            </div>
            <h2 class="text-xl font-extrabold text-slate-800 dark:text-white mb-2 tracking-tight text-center">Akses Terbatas</h2>
            <p class="text-sm text-slate-400 dark:text-slate-500 max-w-md text-center leading-relaxed">Anda tidak memiliki izin untuk melihat data pada halaman ini. Silakan hubungi Administrator jika ini merupakan kesalahan.</p>
        </div>
    @else
        @if ($permissions['create'])
            <x-slot:headerActions>
                <x-atoms.shared.button
                    href="{{ route('dashboard.staffs.periods.create') }}"
                    icon="heroicon-o-plus">
                    Tambah Periode
                </x-atoms.shared.button>
            </x-slot:headerActions>
        @endif

        <x-molecules.dashboard.cards.filter-card
            searchRoute="/dashboard/staffs/periods"
            searchPlaceholder="Cari periode..." />

        <x-molecules.dashboard.cards.data-table
            :headers="[
                ['label' => 'Periode'],
                ['label' => 'Status'],
                ['label' => 'Pengurus'],
                ['label' => 'Tim Pengembang'],
                ['label' => 'Urutan'],
            ]"
            :selectable="$permissions['delete']"
            :bulkDeleteEnabled="$permissions['delete']"
            :showActions="$permissions['update'] || $permissions['delete']"
            bulkDeleteRoute="/dashboard/staffs/periods/bulk-delete">

            @forelse ($periods ?? [] as $item)
                @php
                    $developerCount = ($item->developer_team_members_count ?? 0) + ($item->developer_team_milestones_count ?? 0);
                    $isLocked = ($item->staff_periods_count ?? 0) > 0 || $developerCount > 0;
                @endphp
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $item->id }}">
                    @if ($permissions['delete'])
                        <td class="px-4 py-4 w-12 text-center">
                            <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $item->id }}')" @change="toggleRow('{{ $item->id }}')" />
                        </td>
                    @endif
                    <td class="px-5 py-4 text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $item->label }}</td>
                    <td class="px-5 py-4 text-sm">
                        @if ($item->is_active)
                            <span class="inline-flex items-center gap-1 text-[10px] font-black text-emerald-600 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 px-2.5 py-0.5 rounded-full uppercase tracking-tight">Aktif</span>
                        @else
                            <span class="inline-flex items-center gap-1 text-[10px] font-black text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-800 px-2.5 py-0.5 rounded-full uppercase tracking-tight">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->staff_periods_count ?? 0 }}</td>
                    <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $developerCount }}</td>
                    <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->display_order }}</td>
                    @if ($permissions['update'] || $permissions['delete'])
                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                @if ($permissions['update'])
                                    <x-atoms.shared.button
                                        variant="ghost"
                                        size="sm"
                                        href="/dashboard/staffs/periods/{{ $item->id }}/edit"
                                        class="size-9 !px-0"
                                        title="Edit">
                                        <x-heroicon-o-pencil-square class="size-5" />
                                    </x-atoms.shared.button>
                                @endif
                                @if ($permissions['delete'])
                                    @if ($isLocked)
                                        <x-atoms.shared.button
                                            variant="ghost"
                                            size="sm"
                                            disabled
                                            class="size-9 !px-0 text-slate-300 dark:text-slate-700"
                                            title="Periode masih dipakai">
                                            <x-heroicon-o-trash class="size-5" />
                                        </x-atoms.shared.button>
                                    @else
                                        <x-atoms.shared.button
                                            variant="ghost"
                                            size="sm"
                                            @click="openDeleteModal('/dashboard/staffs/periods/{{ $item->id }}', 'Hapus periode &quot;{{ $item->label }}&quot;?')"
                                            class="size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                                            title="Hapus">
                                            <x-heroicon-o-trash class="size-5" />
                                        </x-atoms.shared.button>
                                    @endif
                                @endif
                            </div>
                        </td>
                    @endif
                </tr>
            @empty
                <x-slot:empty>
                    <x-molecules.shared.empty-state title="Belum ada periode" icon="heroicon-o-calendar-days">
                        <x-atoms.shared.button href="{{ route('dashboard.staffs.periods.create') }}" icon="heroicon-o-plus">
                            Tambah Periode
                        </x-atoms.shared.button>
                    </x-molecules.shared.empty-state>
                </x-slot:empty>
            @endforelse

            @if (isset($periods) && method_exists($periods, 'hasPages'))
                <x-slot:pagination>
                    <x-molecules.dashboard.cards.pagination :paginator="$periods" />
                </x-slot:pagination>
            @endif
        </x-molecules.dashboard.cards.data-table>

        <x-molecules.shared.modal-confirm />
    @endif
</x-layouts.dashboard>
