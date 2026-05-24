<x-layouts.dashboard pageTitle="Aspirasi" :breadcrumbs="[['label' => 'Aspirasi']]">
    <x-molecules.dashboard.cards.filter-card searchRoute="/dashboard/aspirations" searchPlaceholder="Cari aspirasi...">
        <div
            class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
            <label
                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Urutkan</label>
            <div class="w-44">
                <x-molecules.shared.forms.form-input type="select" name="sort" :value="request('sort', 'latest')"
                    :options="['latest' => 'Terbaru', 'oldest' => 'Terlama']"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)" />
            </div>
        </div>
    </x-molecules.dashboard.cards.filter-card>

    <x-molecules.dashboard.cards.data-table :selectable="false" :headers="[
        ['label' => 'Pengirim'],
        ['label' => 'Subjek'],
        ['label' => 'Status'],
        ['label' => 'Tanggal'],
        ['label' => 'Kode Tracking'],
    ]">

        @forelse ($aspirations as $item)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200"
                data-row-id="{{ $item->id }}">
                <td class="px-5 py-4 text-sm text-slate-600 dark:text-slate-300">
                    <div class="font-semibold text-slate-700 dark:text-slate-200">{{ $item->name ?: 'Anonim' }}</div>
                    <div class="text-xs text-slate-400 dark:text-slate-500">{{ $item->nim ?: ($item->email ?: '-') }}</div>
                </td>
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200 max-w-xs truncate">
                    {{ $item->subject }}</td>
                <td class="px-5 py-4">
                    <span
                        class="text-[11px] font-bold px-2.5 py-1 rounded-full uppercase {{ $item->status_color_class }}">
                        {{ $item->status }}
                    </span>
                </td>

                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->created_at?->format('d M Y') }}
                </td>
                <td class="px-5 py-4 text-xs font-mono text-primary">{{ $item->tracking_code ?: '-' }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/aspirations/{{ $item->id }}"
                            class="size-9 !px-0"
                            title="Detail Aspirasi">
                            <x-heroicon-o-eye class="size-5 text-slate-400 hover:text-primary transition-colors" />
                        </x-atoms.shared.button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-molecules.shared.empty-state title="Belum ada aspirasi" icon="heroicon-o-chat-bubble-left-right" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-molecules.dashboard.cards.pagination :paginator="$aspirations" />
        </x-slot:pagination>
    </x-molecules.dashboard.cards.data-table>


</x-layouts.dashboard>