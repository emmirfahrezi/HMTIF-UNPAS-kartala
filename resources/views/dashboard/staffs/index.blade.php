<x-layouts.dashboard pageTitle="Pengurus" :breadcrumbs="[['label' => 'Pengurus']]">
    <x-slot:headerActions>
        <a href="/dashboard/staffs/create"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all active:scale-95 shrink-0">
            <x-heroicon-o-plus class="size-4" />
            Tambah Pengurus
        </a>
    </x-slot:headerActions>

    <x-dashboard.category-card 
        title="Manajemen Bidang / Divisi"
        subtitle="Kelola struktur organisasi dan divisi pengurus"
        addModalId="quick-add-division"
        manageRoute="/dashboard/staffs/divisions"
    />

    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/staffs" 
        searchPlaceholder="Cari pengurus...">
        <div class="flex items-center gap-2 border-l border-slate-100 pl-3">
            <label class="text-xs font-bold text-slate-400 uppercase tracking-wider whitespace-nowrap">Divisi</label>
            <select name="division" onchange="this.form.submit()"
                class="pl-3 pr-8 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary/20 transition cursor-pointer appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20stroke%3D%22%236B7280%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%221.5%22%20d%3D%22m6%208%204%204%204-4%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_0.5rem_center] bg-no-repeat">
                <option value="">Semua</option>
                @foreach ($divisions as $div)
                    <option value="{{ $div->id }}" {{ request('division') == $div->id ? 'selected' : '' }}>{{ $div->name }}</option>
                @endforeach
            </select>
        </div>
    </x-dashboard.filter-card>

    {{-- Division Sections --}}
    @foreach ($divisions as $division)
        <div class="mb-12">
            <div class="flex items-center justify-between mb-4 px-1">
                <h2 class="text-lg font-bold text-slate-800 flex items-center gap-3">
                    <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                    {{ $division->name }}
                </h2>
                <span class="text-xs font-bold text-slate-400 bg-slate-100 px-3 py-1 rounded-full uppercase tracking-wider">
                    {{ $division->staffs->count() }} Anggota
                </span>
            </div>
            
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-100">
                                <th class="px-5 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama</th>
                                <th class="px-5 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Jabatan</th>
                                <th class="px-5 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">BPH</th>
                                <th class="px-5 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                <th class="px-5 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse ($division->staffs as $item)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs shrink-0 shadow-inner">
                                                {{ strtoupper(substr($item->name, 0, 1)) }}
                                            </div>
                                            <span class="text-sm font-semibold text-slate-700">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 text-sm text-slate-500 font-medium">{{ $item->position }}</td>
                                    <td class="px-5 py-4">
                                        @if ($item->is_bph)
                                            <span class="text-primary" title="Badan Pengurus Harian">
                                                <x-heroicon-s-check-circle class="size-5" />
                                            </span>
                                        @else
                                            <span class="text-slate-200">
                                                <x-heroicon-o-minus-circle class="size-5" />
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        @if ($item->is_active)
                                            <span class="inline-flex items-center gap-1 text-[10px] font-black text-emerald-600 bg-emerald-50 border border-emerald-100 px-2.5 py-0.5 rounded-full uppercase tracking-tight">Aktif</span>
                                        @else
                                            <span class="inline-flex items-center gap-1 text-[10px] font-black text-slate-400 bg-slate-50 border border-slate-100 px-2.5 py-0.5 rounded-full uppercase tracking-tight">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="/dashboard/staffs/{{ $item->id }}/edit"
                                                class="p-2 text-slate-400 hover:text-primary hover:bg-primary/5 rounded-lg transition" title="Edit">
                                                <x-heroicon-o-pencil-square class="size-4" />
                                            </a>
                                            <button onclick="openDeleteModal('/dashboard/staffs/{{ $item->id }}', 'Hapus pengurus &quot;{{ $item->name }}&quot;?')"
                                                class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                <x-heroicon-o-trash class="size-4" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-12 text-center">
                                        <div class="flex flex-col items-center gap-2 text-slate-400">
                                            <x-heroicon-o-users class="size-8 opacity-20" />
                                            <p class="text-sm font-medium">Belum ada data pengurus di divisi ini</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach

    <x-molecules.dashboard.ui.modal id="quick-add-division" title="Tambah Bidang / Divisi">
        <form action="/dashboard/staffs/divisions" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Divisi</label>
                <input type="text" name="name" required placeholder="Masukan nama divisi..."
                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" />
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="toggleModal('quick-add-division')"
                    class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 rounded-xl transition">Batal</button>
                <button type="submit"
                    class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold hover:bg-primary/90 transition shadow-lg shadow-primary/20">
                    Simpan Divisi
                </button>
            </div>
        </form>
    </x-dashboard.modal>

    <x-molecules.dashboard.ui.modal-confirm />
</x-layouts.dashboard>
