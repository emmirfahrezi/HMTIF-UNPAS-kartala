{{-- Section: Otorisasi Role Akses --}}
<div
    class="bg-white dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden transition-colors duration-300 relative">
    <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-primary pointer-events-none">
        <x-heroicon-o-shield-check class="size-32" />
    </div>

    {{-- Header --}}
    <div
        class="p-6 border-b border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h3 class="text-lg font-black text-slate-800 dark:text-white flex items-center gap-3 relative z-10">
            <span
                class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
                <x-heroicon-s-shield-check class="size-5" />
            </span>
            Otorisasi Role Akses
        </h3>
        <div
            class="shrink-0 bg-slate-100 dark:bg-slate-800 px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700">
            <span class="text-sm font-semibold text-slate-600 dark:text-slate-300">Total: <span
                    class="text-primary font-bold">{{ count($roles) }} Role</span></span>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr
                    class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                    <th
                        class="px-6 py-4 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        Role</th>
                    <th class="px-4 py-4 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider text-center"
                        title="Create">C</th>
                    <th class="px-4 py-4 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider text-center"
                        title="Read">R</th>
                    <th class="px-4 py-4 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider text-center"
                        title="Update">U</th>
                    <th class="px-4 py-4 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider text-center"
                        title="Delete">D</th>
                    <th
                        class="px-6 py-4 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider text-center">
                        Status</th>
                    <th
                        class="px-6 py-4 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider text-right">
                        Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                @foreach ($roles as $role)
                    <tr x-data="{ 
                        roleId: '{{ $role->id }}',
                        roleName: '{{ $role->name }}',
                        menuAccess: {{ json_encode($role->menu_access ?? []) }},
                        canCreate: {{ $role->can_create ? 'true' : 'false' }}, 
                        canRead: {{ $role->can_read ? 'true' : 'false' }}, 
                        canUpdate: {{ $role->can_update ? 'true' : 'false' }}, 
                        canDelete: {{ $role->can_delete ? 'true' : 'false' }},
                        async toggle(field, currentVal) {
                            const newVal = !currentVal;
                            try {
                                const res = await fetch(`/dashboard/settings/${this.roleId}`, {
                                    method: 'PUT',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({ field: field, value: newVal })
                                });
                                const data = await res.json();
                                if (data.success) {
                                    if (field === 'can_create') this.canCreate = newVal;
                                    if (field === 'can_read') this.canRead = newVal;
                                    if (field === 'can_update') this.canUpdate = newVal;
                                    if (field === 'can_delete') this.canDelete = newVal;
                                    toast('Izin berhasil diperbarui!', 'success');
                                } else {
                                    toast('Gagal memperbarui izin.', 'error');
                                }
                            } catch (err) {
                                toast('Terjadi kesalahan koneksi.', 'error');
                            }
                        },
                        confirmToggle(field, label, currentVal) {
                            const actionWord = currentVal ? 'mencabut' : 'memberikan';
                            window.dispatchEvent(new CustomEvent('open-confirm-modal', {
                                detail: {
                                    title: 'Konfirmasi Perizinan',
                                    message: `Apakah Anda yakin ingin ${actionWord} izin '${label}' untuk role '${this.roleName}'?`,
                                    confirmLabel: 'Ya, Lanjutkan',
                                    variant: 'warning',
                                    icon: 'warning',
                                    callback: () => this.toggle(field, currentVal)
                                }
                            }));
                        }
                    }" class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-1.5 h-1.5 rounded-full transition-colors duration-300"
                                    :class="canRead ? 'bg-emerald-500' : 'bg-slate-300'">
                                </div>
                                <span
                                    class="text-sm font-bold text-slate-700 dark:text-slate-200 whitespace-nowrap">{{ $role->name }}</span>
                            </div>
                        </td>

                        {{-- Toggles --}}
                        <td class="px-2 sm:px-4 py-5 text-center">
                            <label class="relative inline-flex items-center cursor-pointer" title="Create">
                                <input type="checkbox" class="sr-only peer" :checked="canCreate" @change="$el.checked = canCreate; confirmToggle('can_create', 'Create', canCreate)">
                                <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-slate-600 peer-checked:bg-emerald-600 dark:peer-checked:bg-emerald-500 shadow-inner animate-all duration-300"></div>
                            </label>
                        </td>
                        <td class="px-2 sm:px-4 py-5 text-center">
                            <label class="relative inline-flex items-center cursor-pointer" title="Read">
                                <input type="checkbox" class="sr-only peer" :checked="canRead" @change="$el.checked = canRead; confirmToggle('can_read', 'Read', canRead)">
                                <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-slate-600 peer-checked:bg-emerald-600 dark:peer-checked:bg-emerald-500 shadow-inner animate-all duration-300"></div>
                            </label>
                        </td>
                        <td class="px-2 sm:px-4 py-5 text-center">
                            <label class="relative inline-flex items-center cursor-pointer" title="Update">
                                <input type="checkbox" class="sr-only peer" :checked="canUpdate" @change="$el.checked = canUpdate; confirmToggle('can_update', 'Update', canUpdate)">
                                <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-slate-600 peer-checked:bg-emerald-600 dark:peer-checked:bg-emerald-500 shadow-inner animate-all duration-300"></div>
                            </label>
                        </td>
                        <td class="px-2 sm:px-4 py-5 text-center">
                            <label class="relative inline-flex items-center cursor-pointer" title="Delete">
                                <input type="checkbox" class="sr-only peer" :checked="canDelete" @change="$el.checked = canDelete; confirmToggle('can_delete', 'Delete', canDelete)">
                                <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-slate-600 peer-checked:bg-emerald-600 dark:peer-checked:bg-emerald-500 shadow-inner animate-all duration-300"></div>
                            </label>
                        </td>

                        <td class="px-6 py-5 text-center">
                            <div
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full transition-all duration-300"
                                :class="canRead ? 'bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 text-emerald-600 dark:text-emerald-400' : 'bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 text-slate-400 dark:text-slate-500'">
                                <x-heroicon-o-check class="size-4" x-show="canRead" />
                                <x-heroicon-o-x-mark class="size-4" x-show="!canRead" style="display: none;" />
                            </div>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <div class="flex items-center justify-end gap-1 sm:gap-2">
                                <x-atoms.shared.button variant="ghost" size="sm"
                                    @click="$dispatch('open-modal', { 
                                        name: 'role-menu-settings', 
                                        roleId: roleId, 
                                        roleName: roleName, 
                                        menuAccess: menuAccess 
                                    })"
                                    class="size-8 sm:size-9 !px-0 text-blue-500 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-500/10"
                                    title="Atur Menu">
                                    <x-heroicon-o-cog-8-tooth class="size-4 sm:size-5" />
                                </x-atoms.shared.button>
                                <x-atoms.shared.button variant="ghost" size="sm"
                                    @click="openDeleteModal('/dashboard/settings/{{ $role->id }}', 'Hapus role &quot;{{ $role->name }}&quot;?')"
                                    class="size-8 sm:size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                                    title="Hapus Role">
                                    <x-heroicon-o-trash class="size-4 sm:size-5" />
                                </x-atoms.shared.button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
