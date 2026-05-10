<x-layouts.dashboard pageTitle="Log Aktivitas" :breadcrumbs="[['label' => 'Log Aktivitas']]">
    <x-slot:headerActions>
        <x-atoms.shared.button href="/dashboard/activity-logs/create" icon="heroicon-o-plus">
            Tambah Log
        </x-atoms.shared.button>
    </x-slot:headerActions>

    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/activity-logs" 
        searchPlaceholder="Cari judul atau pelaksana...">
        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Kategori</label>
            <div class="w-44">
                <x-molecules.shared.forms.form-input 
                    type="select"
                    name="category"
                    :value="request('category', '')"
                    placeholder="Semua Kategori"
                    :options="['' => 'Semua Kategori'] + collect($categories)->mapWithKeys(fn($cat) => [$cat => $cat])->toArray()"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)"
                />
            </div>
        </div>
    </x-molecules.dashboard.cards.filter-card>

    <x-molecules.dashboard.cards.data-table
        :selectable="false"
        :headers="[
            ['label' => 'Tanggal'],
            ['label' => 'Judul'],
            ['label' => 'Kategori'],
            ['label' => 'Pelaksana'],
        ]">

        @forelse ($logs ?? [] as $item)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $item->id }}">
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d M Y H:i') }}
                </td>
                <td class="px-5 py-4">
                    <div class="text-sm font-bold text-slate-800 dark:text-white">{{ $item->title }}</div>
                    @if($item->description)
                        <div class="text-xs text-slate-500 dark:text-slate-400 line-clamp-1 mt-0.5">{{ Str::limit($item->description, 50) }}</div>
                    @endif
                </td>
                <td class="px-5 py-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider bg-primary/10 text-primary border border-primary/20">
                        {{ $item->category }}
                    </span>
                </td>
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200">
                    <div class="flex items-center gap-2">
                        <div class="size-7 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-xs font-black text-slate-600 dark:text-slate-300 shrink-0 uppercase">
                            {{ substr($item->performed_by, 0, 1) }}
                        </div>
                        {{ $item->performed_by }}
                    </div>
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/activity-logs/{{ $item->id }}/edit"
                            class="size-9 !px-0"
                            title="Edit">
                            <x-heroicon-o-pencil-square class="size-5" />
                        </x-atoms.shared.button>
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            @click="openDeleteModal('/dashboard/activity-logs/{{ $item->id }}', 'Hapus log aktivitas &quot;{{ $item->title }}&quot;?')"
                            class="size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                            title="Hapus">
                            <x-heroicon-o-trash class="size-5" />
                        </x-atoms.shared.button>
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-molecules.shared.empty-state title="Belum ada log aktivitas" icon="heroicon-o-document-text"
                    createRoute="/dashboard/activity-logs/create" createLabel="Tambah Log" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-molecules.dashboard.cards.pagination :paginator="$logs" />
        </x-slot:pagination>
    </x-molecules.dashboard.cards.data-table>

</x-layouts.dashboard>
