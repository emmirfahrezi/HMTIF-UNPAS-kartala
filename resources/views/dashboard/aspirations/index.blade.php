<x-layouts.dashboard pageTitle="Aspirasi" :breadcrumbs="[['label' => 'Aspirasi']]">
    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/aspirations" 
        searchPlaceholder="Cari aspirasi...">
        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Urutkan</label>
            <div class="w-44">
                <x-molecules.shared.forms.form-input 
                    type="select"
                    name="sort"
                    :value="request('sort', 'latest')"
                    :options="['latest' => 'Terbaru', 'oldest' => 'Terlama']"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)"
                />
            </div>
        </div>
    </x-molecules.dashboard.cards.filter-card>

    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Subjek'],
            ['label' => 'Status'],
            ['label' => 'Spotlight'],
            ['label' => 'Tanggal'],
        ]"
        bulkDeleteRoute="/dashboard/aspirations/bulk-delete">

        @forelse ($aspirations as $item)
            @php
                $statusColors = [
                    'pending' => 'bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400',
                    'reviewed' => 'bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400',
                    'resolved' => 'bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400',
                    'rejected' => 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400',
                ];
            @endphp
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $item->id }}">
                <td class="px-4 py-4 w-12">
                    <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $item->id }}')" @change="toggleRow('{{ $item->id }}')" />
                </td>
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200 max-w-xs truncate">{{ $item->subject }}</td>
                <td class="px-5 py-4">
                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-full uppercase {{ $statusColors[$item->status] ?? 'bg-slate-100 text-slate-600' }}">
                        {{ $item->status }}
                    </span>
                </td>
                <td class="px-5 py-4">
                    @if ($item->is_spotlight)
                        <x-heroicon-s-star class="size-5 text-amber-400" />
                    @else
                        <x-heroicon-o-star class="size-5 text-slate-300 dark:text-slate-700" />
                    @endif
                </td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->created_at?->format('d M Y') }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/aspirations/{{ $item->id }}"
                            class="size-9 !px-0"
                            title="Lihat Detail">
                            <x-heroicon-o-eye class="size-5" />
                        </x-atoms.shared.button>
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/aspirations/{{ $item->id }}/edit"
                            class="size-9 !px-0"
                            title="Edit">
                            <x-heroicon-o-pencil-square class="size-5" />
                        </x-atoms.shared.button>
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            @click="openDeleteModal('/dashboard/aspirations/{{ $item->id }}', 'Hapus aspirasi ini?')"
                            class="size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                            title="Hapus">
                            <x-heroicon-o-trash class="size-5" />
                        </x-atoms.shared.button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-molecules.shared.empty-state title="Belum ada aspirasi" icon="heroicon-o-chat-bubble-left-right"
                    createRoute="/dashboard/aspirations/create" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-molecules.dashboard.cards.pagination :paginator="$aspirations" />
        </x-slot:pagination>
    </x-molecules.dashboard.cards.data-table>


</x-layouts.dashboard>