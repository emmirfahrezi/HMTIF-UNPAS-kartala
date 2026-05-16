<x-layouts.dashboard pageTitle="Pengurus" :breadcrumbs="[['label' => 'Pengurus']]">
    <x-slot:headerActions>
        <x-atoms.shared.button 
            href="/dashboard/staffs/create"
            icon="heroicon-o-plus">
            Tambah Pengurus
        </x-atoms.shared.button>
    </x-slot:headerActions>

    <x-molecules.dashboard.cards.category-card title="Manajemen Bidang / Divisi"
        subtitle="Kelola struktur organisasi dan divisi pengurus" addModalId="quick-add-division"
        manageRoute="/dashboard/staffs/divisions" />

    <x-molecules.dashboard.cards.filter-card searchRoute="/dashboard/staffs" searchPlaceholder="Cari pengurus...">
        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
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

        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Divisi</label>
            <div class="w-44">
                <x-molecules.shared.forms.form-input 
                    type="select"
                    name="division"
                    :value="request('division')"
                    :options="$divisions->pluck('name', 'id')->prepend('Semua', '')->toArray()"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)"
                />
            </div>
        </div>
    </x-molecules.dashboard.cards.filter-card>

    {{-- Division Sections --}}
    @foreach ($divisions as $division)
        <div class="mb-12">
            <div class="flex items-center justify-between mb-4 px-1">
                <h2 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-3">
                    <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                    {{ $division->name }}
                </h2>
                <span
                    class="text-xs font-bold text-slate-400 dark:text-slate-500 bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-full uppercase tracking-wider">
                    {{ $division->staffs->count() }} Anggota
                </span>
            </div>

            <x-molecules.dashboard.cards.data-table :headers="[
                ['label' => '', 'width' => 'w-10'],
                ['label' => 'Nama'],
                ['label' => 'Jabatan'],
                ['label' => 'BPH'],
                ['label' => 'Status'],
            ]"
                bulkDeleteRoute="/dashboard/staffs/bulk-delete">

                @forelse ($division->staffs as $item)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200 group/row" data-row-id="{{ $item->id }}">
                        <td class="px-4 py-4 w-12 text-center">
                            <x-atoms.shared.checkbox 
                                x-bind:checked="isSelected('{{ $item->id }}')"
                                @change="toggleRow('{{ $item->id }}')"
                            />
                        </td>
                        <td class="px-3 py-4 w-10">
                            <div
                                class="cursor-grab active:cursor-grabbing text-slate-300 dark:text-slate-600 hover:text-slate-400 dark:hover:text-slate-400 transition sort-handle">
                                <x-heroicon-s-bars-3-bottom-left class="size-5" />
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-primary/10 dark:bg-primary/20 flex items-center justify-center text-primary font-bold text-xs shrink-0 shadow-inner">
                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $item->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400 font-medium">{{ $item->position }}</td>
                        <td class="px-5 py-4">
                            @if ($item->is_bph)
                                <span class="text-primary" title="Badan Pengurus Harian">
                                    <x-heroicon-s-check-circle class="size-5" />
                                </span>
                            @else
                                <span class="text-slate-200 dark:text-slate-800">
                                    <x-heroicon-o-minus-circle class="size-5" />
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-sm">
                            @if ($item->is_active)
                                <span
                                    class="inline-flex items-center gap-1 text-[10px] font-black text-emerald-600 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 px-2.5 py-0.5 rounded-full uppercase tracking-tight">Aktif</span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1 text-[10px] font-black text-slate-400 dark:text-slate-600 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-800 px-2.5 py-0.5 rounded-full uppercase tracking-tight">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <x-atoms.shared.button 
                                    variant="ghost"
                                    size="sm"
                                    href="/dashboard/staffs/{{ $item->id }}/edit"
                                    class="size-9 !px-0"
                                    title="Edit">
                                    <x-heroicon-o-pencil-square class="size-5" />
                                </x-atoms.shared.button>
                                <x-atoms.shared.button 
                                    variant="ghost"
                                    size="sm"
                                    @click="openDeleteModal('/dashboard/staffs/{{ $item->id }}', 'Hapus pengurus &quot;{{ $item->name }}&quot;?')"
                                    class="size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                                    title="Hapus">
                                    <x-heroicon-o-trash class="size-5" />
                                </x-atoms.shared.button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <x-slot:empty>
                        <x-molecules.shared.empty-state title="Belum ada data pengurus di divisi ini"
                            icon="heroicon-o-users" createRoute="/dashboard/staffs/create" />
                    </x-slot:empty>
                @endforelse

                @if (isset($division->staffs) && method_exists($division->staffs, 'hasPages'))
                    <x-slot:pagination>
                        <x-molecules.dashboard.cards.pagination :paginator="$division->staffs" />
                    </x-slot:pagination>
                @endif
            </x-molecules.dashboard.cards.data-table>
        </div>
    @endforeach

    <x-molecules.shared.modal id="quick-add-division" title="Tambah Bidang / Divisi">
        <form action="/dashboard/staffs/divisions" method="POST" class="space-y-4"
            x-data="slugHelper(@js(old('name')), @js(old('slug')))">
            @csrf
            <x-molecules.shared.forms.form-input 
                label="Nama Divisi"
                name="name"
                required
                placeholder="Masukan nama divisi..."
                x-model="sourceValue"
            />
            <x-molecules.shared.forms.form-input 
                label="Slug"
                name="slug"
                readonly
                placeholder="dibuat otomatis"
                x-model="slugValue"
                helper="Slug akan terisi otomatis berdasarkan nama"
            />
            <div class="flex justify-end gap-3 mt-6">
                <x-atoms.shared.button 
                    variant="ghost"
                    type="button"
                    @click="$dispatch('close-modal', { name: 'quick-add-division' })">
                    Batal
                </x-atoms.shared.button>
                <x-atoms.shared.button 
                    type="submit">
                    Simpan Divisi
                </x-atoms.shared.button>
            </div>
        </form>
    </x-molecules.shared.modal>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tables = document.querySelectorAll('tbody');

                tables.forEach(table => {
                    new Sortable(table, {
                        handle: '.sort-handle',
                        animation: 150,
                        ghostClass: 'bg-primary/5',
                        dragClass: 'opacity-0',
                        onEnd: function (evt) {
                            const rowIds = Array.from(table.querySelectorAll('tr[data-row-id]'))
                                .map(tr => tr.getAttribute('data-row-id'));

                            // Simulasi loading/toast
                            if (window.showToast) {
                                showToast('Menyimpan urutan baru...', 'info');
                            }

                            fetch('/dashboard/staffs/reorder', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ ids: rowIds })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success && window.showToast) {
                                    showToast('Urutan berhasil disimpan!', 'success');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                if (window.showToast) {
                                    showToast('Gagal menyimpan urutan', 'error');
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-layouts.dashboard>
