
<x-layouts.dashboard pageTitle="Notulensi Rapat" :breadcrumbs="[['label' => 'Notulensi']]">
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
                href="/dashboard/minutes/create"
                icon="heroicon-o-plus">
                Buat Notulensi
            </x-atoms.shared.button>
        </x-slot:headerActions>
        @endif

    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/minutes" 
        searchPlaceholder="Cari nomor atau perihal...">
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
            ['label' => 'Nomor'],
            ['label' => 'Perihal / Agenda'],
            ['label' => 'Waktu & Tempat'],
        ]"
        :selectable="$permissions['delete']"
        :bulkDeleteEnabled="$permissions['delete']"
        :showActions="true"
        bulkDeleteRoute="/dashboard/minutes/bulk-delete">

        @forelse ($minutes as $item)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200 group" data-row-id="{{ $item->id }}">
                @if ($permissions['delete'])
                <td class="px-4 py-4 w-12">
                    <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $item->id }}')" @change="toggleRow('{{ $item->id }}')" />
                </td>
                @endif
                <td class="px-5 py-4 whitespace-nowrap">
                    <span class="text-xs font-black text-slate-400 dark:text-slate-500 bg-slate-100 dark:bg-slate-800 px-2.5 py-1 rounded-lg uppercase tracking-widest transition-colors">{{ $item->nomor }}</span>
                </td>
                <td class="px-5 py-4 max-w-[280px] md:max-w-[360px]">
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-slate-800 dark:text-white leading-tight mb-1 truncate" title="{{ $item->perihal }}">{{ $item->perihal }}</span>
                        <p class="text-[11px] text-slate-400 dark:text-slate-500 line-clamp-1 italic truncate" title="{{ strip_tags($item->agenda) }}">{{ strip_tags($item->agenda) }}</p>
                    </div>
                </td>
                <td class="px-5 py-4">
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-slate-300 whitespace-nowrap">
                            <x-heroicon-o-calendar class="size-4 text-slate-400 dark:text-slate-600" />
                            {{ $item->tanggal->format('d M Y') }}
                        </div>
                        <div class="flex items-center gap-2 text-xs text-slate-400 dark:text-slate-500 whitespace-nowrap">
                            <x-heroicon-o-map-pin class="size-3.5" />
                            {{ $item->tempat }}
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/minutes/{{ $item->id }}"
                            class="size-9 !px-0 text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200"
                            title="Detail & Cetak">
                            <x-heroicon-o-eye class="size-5" />
                        </x-atoms.shared.button>
                        @if ($permissions['update'])
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/minutes/{{ $item->id }}/edit"
                            class="size-9 !px-0 text-amber-500 hover:text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-500/10"
                            title="Edit">
                            <x-heroicon-o-pencil-square class="size-5" />
                        </x-atoms.shared.button>
                        @endif
                        @if ($permissions['delete'])
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            @click="openDeleteModal('/dashboard/minutes/{{ $item->id }}', 'Hapus notulensi &quot;{{ $item->perihal }}&quot;?')"
                            class="size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                            title="Hapus">
                            <x-heroicon-o-trash class="size-5" />
                        </x-atoms.shared.button>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-molecules.shared.empty-state title="Belum ada notulensi" icon="heroicon-o-document-text"
                    createRoute="/dashboard/minutes/create" createLabel="Buat Notulensi" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-molecules.dashboard.cards.pagination :paginator="$minutes" />
        </x-slot:pagination>
    </x-molecules.dashboard.cards.data-table>
    @endif
</x-layouts.dashboard>
