
<x-layouts.dashboard pageTitle="Kegiatan" :breadcrumbs="[['label' => 'Kegiatan']]">
    @if (!$canRead)
        <div class="flex flex-col items-center justify-center pt-16 pb-24 px-4 bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm mt-8">
            <div class="w-16 h-16 bg-red-50 dark:bg-red-500/10 rounded-2xl flex items-center justify-center text-red-500 mb-6 shadow-inner animate-pulse">
                <x-heroicon-o-lock-closed class="size-8" />
            </div>
            <h2 class="text-xl font-extrabold text-slate-800 dark:text-white mb-2 tracking-tight text-center">Akses Terbatas</h2>
            <p class="text-sm text-slate-400 dark:text-slate-500 max-w-md text-center leading-relaxed">Anda tidak memiliki izin untuk melihat data pada halaman ini. Silakan hubungi Administrator jika ini merupakan kesalahan.</p>
        </div>
    @else
        @if ($canCreate)
        <x-slot:headerActions>
            <x-atoms.shared.button 
                href="/dashboard/activities/create"
                icon="heroicon-o-plus">
                Tambah Kegiatan
            </x-atoms.shared.button>
        </x-slot:headerActions>
        @endif

    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/activities" 
        searchPlaceholder="Cari kegiatan...">
        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Urutkan</label>
            <div class="w-44">
                <x-molecules.shared.forms.form-input 
                    type="select"
                    name="sort"
                    :value="request('sort', 'latest')"
                    :options="['latest' => 'Terbaru', 'oldest' => 'Terlama', 'az' => 'Judul A-Z', 'za' => 'Judul Z-A']"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)"
                />
            </div>
        </div>

        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Status</label>
            <div class="w-32">
                <x-molecules.shared.forms.form-input 
                    type="select"
                    name="status"
                    :value="request('status')"
                    :options="['' => 'Semua', 'upcoming' => 'Mendatang', 'ongoing' => 'Berlangsung', 'past' => 'Selesai']"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)"
                />
            </div>
        </div>
    </x-molecules.dashboard.cards.filter-card>

    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Judul'],
            ['label' => 'Status'],
            ['label' => 'Tanggal Mulai'],
            ['label' => 'Lokasi'],
        ]"
        :selectable="$canDelete"
        :bulkDeleteEnabled="$canDelete"
        :showActions="$canUpdate || $canDelete"
        bulkDeleteRoute="/dashboard/activities/bulk-delete">

        @forelse ($activities as $item)
            @php
                $statusColors = [
                    'upcoming' => 'bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400',
                    'ongoing' => 'bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400',
                    'past' => 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400',
                ];
            @endphp
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $item->id }}">
                @if ($canDelete)
                <td class="px-4 py-4 w-12">
                    <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $item->id }}')" @change="toggleRow('{{ $item->id }}')" />
                </td>
                @endif
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200 max-w-xs truncate">{{ $item->title }}</td>
                <td class="px-5 py-4">
                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-full uppercase {{ $statusColors[$item->status] ?? 'bg-slate-100 text-slate-600' }}">
                        {{ $item->status }}
                    </span>
                </td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->start_date?->format('d M Y H:i') }}</td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->location ?? '-' }}</td>
                @if ($canUpdate || $canDelete)
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        @if ($canUpdate)
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/activities/{{ $item->id }}/edit"
                            class="size-9 !px-0"
                            title="Edit">
                            <x-heroicon-o-pencil-square class="size-5" />
                        </x-atoms.shared.button>
                        @endif
                        @if ($canDelete)
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            @click="openDeleteModal('/dashboard/activities/{{ $item->id }}', 'Hapus kegiatan &quot;{{ $item->title }}&quot;?')"
                            class="size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                            title="Hapus">
                            <x-heroicon-o-trash class="size-5" />
                        </x-atoms.shared.button>
                        @endif
                    </div>
                </td>
                @endif
            </tr>
        @empty
            <x-slot:empty>
                <x-molecules.shared.empty-state title="Belum ada kegiatan" icon="heroicon-o-calendar"
                    createRoute="/dashboard/activities/create" createLabel="Tambah Kegiatan" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-molecules.dashboard.cards.pagination :paginator="$activities" />
        </x-slot:pagination>
    </x-molecules.dashboard.cards.data-table>
    @endif

    @push('scripts')
        @vite(['resources/js/pages/activities.js'])
    @endpush
</x-layouts.dashboard>

