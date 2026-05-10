<x-layouts.dashboard pageTitle="Statistik" :breadcrumbs="[['label' => 'Statistik']]">
    <x-slot:headerActions>
        <x-atoms.shared.button 
            href="/dashboard/stats/create"
            icon="heroicon-o-plus">
            Tambah Stat
        </x-atoms.shared.button>
    </x-slot:headerActions>

    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/stats" 
        searchPlaceholder="Cari label statistik...">
        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Urutkan</label>
            <div class="w-44">
                <x-molecules.shared.forms.form-input 
                    type="select"
                    name="sort"
                    :value="request('sort', 'latest')"
                    :options="['latest' => 'Terbaru', 'oldest' => 'Terlama', 'az' => 'A - Z', 'za' => 'Z - A']"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)"
                />
            </div>
        </div>
    </x-molecules.dashboard.cards.filter-card>

    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Label'],
            ['label' => 'Nilai'],
            ['label' => 'Icon'],
            ['label' => 'Urutan'],
        ]"
        bulkDeleteRoute="/dashboard/stats/bulk-delete">

        @forelse ($stats ?? [] as $item)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $item->id }}">
                <td class="px-4 py-4 w-12 text-center">
                    <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $item->id }}')" @change="toggleRow('{{ $item->id }}')" />
                </td>
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200">{{ $item->label }}</td>
                <td class="px-5 py-4 text-sm text-slate-700 dark:text-slate-200 font-semibold">{{ $item->value }}</td>
                <td class="px-5 py-4 text-sm text-slate-400 dark:text-slate-500 font-mono">
                    <div class="flex items-center gap-2">
                        @php
                            $iconName = $item->icon;
                            if (!Str::startsWith($iconName, ['heroicon-', 'x-'])) {
                                $iconName = 'heroicon-o-' . $iconName;
                            }
                        @endphp
                        <x-dynamic-component :component="$iconName" class="size-4" />
                        {{ $item->icon }}
                    </div>
                </td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->order }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/stats/{{ $item->id }}/edit"
                            class="size-9 !px-0"
                            title="Edit">
                            <x-heroicon-o-pencil-square class="size-5" />
                        </x-atoms.shared.button>
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            @click="openDeleteModal('/dashboard/stats/{{ $item->id }}', 'Hapus stat &quot;{{ $item->label }}&quot;?')"
                            class="size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                            title="Hapus">
                            <x-heroicon-o-trash class="size-5" />
                        </x-atoms.shared.button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-molecules.shared.empty-state title="Belum ada statistik" icon="heroicon-o-chart-bar"
                    createRoute="/dashboard/stats/create" createLabel="Tambah Stat" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-molecules.dashboard.cards.pagination :paginator="$stats" />
        </x-slot:pagination>
    </x-molecules.dashboard.cards.data-table>


</x-layouts.dashboard>
