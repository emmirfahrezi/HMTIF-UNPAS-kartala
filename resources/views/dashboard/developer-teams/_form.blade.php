@php
    $periodValue = $activePeriod?->label ?? ($period ?? null)?->label ?? request('period', '');
    $members = ($content['members'] ?? collect())->values();
    $milestones = ($content['milestones'] ?? collect())->values();
    $staffOptions = collect($staffs ?? $staffOptions ?? [])
        ->map(function ($staff) {
            $divisionName = data_get($staff, 'division.name') ?: data_get($staff, 'division_name') ?: 'Tanpa Divisi';

            return [
                'id' => data_get($staff, 'id'),
                'label' => trim(data_get($staff, 'name', 'Staff') . ' - ' . $divisionName),
            ];
        })
        ->filter(fn ($staff) => filled(data_get($staff, 'id')))
        ->values();
    $milestoneStatusOptions = $milestoneStatusOptions ?? [
        'done' => 'Selesai',
        'current' => 'Berjalan',
        'planned' => 'Rencana',
    ];
@endphp

<div
    x-data="{
        members: @js($members),
        milestones: @js($milestones),
        init() {
            if (!this.members.length) this.addMember();
            if (!this.milestones.length) this.addMilestone();
        },
        addMember() {
            this.members.push({ staff_id: '', role: '' });
        },
        removeMember(index) {
            this.members.splice(index, 1);
            if (!this.members.length) this.addMember();
        },
        addMilestone() {
            this.milestones.push({ period_label: @js($periodValue), title: '', description: '', status: 'planned' });
        },
        removeMilestone(index) {
            this.milestones.splice(index, 1);
            if (!this.milestones.length) this.addMilestone();
        },
    }"
    class="grid grid-cols-1 gap-8 lg:grid-cols-3"
>
    <div class="lg:col-span-2 space-y-8">
        <div class="relative rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900/50">
            <div class="pointer-events-none absolute right-0 top-0 p-8 text-primary opacity-[0.03]">
                <x-heroicon-o-code-bracket-square class="size-32" />
            </div>

            <h3 class="mb-6 flex items-center gap-3 text-lg font-black text-slate-800 dark:text-white">
                <span class="flex size-8 items-center justify-center rounded-xl bg-primary/10 text-primary dark:bg-primary/20">
                    <x-heroicon-s-information-circle class="size-5" />
                </span>
                Header Halaman
            </h3>

            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <x-molecules.shared.forms.form-input
                        label="Periode"
                        name="period"
                        type="select"
                        :options="$periods"
                        option-value-key="label"
                        option-label-key="display_label"
                        :value="$periodValue"
                        required />
                    <x-molecules.shared.forms.form-input label="Judul Halaman" name="title" placeholder="Tim Pengembang" :value="$content['title'] ?? 'Tim Pengembang'" required />
                </div>

                <x-molecules.shared.forms.form-input
                    label="Deskripsi"
                    name="description"
                    type="textarea"
                    :rows="4"
                    placeholder="Tuliskan pengantar singkat halaman..."
                    :value="$content['description'] ?? ''" />
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900/50">
            <div class="mb-6 flex items-center justify-between gap-4">
                <h3 class="flex items-center gap-3 text-lg font-black text-slate-800 dark:text-white">
                    <span class="flex size-8 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-500">
                        <x-heroicon-s-user-group class="size-5" />
                    </span>
                    Anggota Tim
                </h3>
                <x-atoms.shared.button type="button" variant="soft" size="sm" icon="heroicon-o-plus" @click="addMember()">
                    Tambah Anggota
                </x-atoms.shared.button>
            </div>

            <div class="space-y-5">
                <template x-for="(member, index) in members" :key="'member-' + index">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5 dark:border-slate-800 dark:bg-slate-950">
                        <div class="mb-5 flex items-center justify-between gap-4">
                            <p class="text-xs font-black uppercase text-slate-400">Anggota <span x-text="index + 1"></span></p>
                            <button type="button" @click="removeMember(index)"
                                class="inline-flex size-9 items-center justify-center rounded-xl text-red-400 transition hover:bg-red-500/10 hover:text-red-500">
                                <x-heroicon-o-trash class="size-4" />
                            </button>
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Staff / Pengurus</label>
                                <x-molecules.shared.forms.form-input
                                    type="search-select"
                                    name="members[][staff_id]"
                                    name-expression="'members[' + index + '][staff_id]'"
                                    selected-expression="member.staff_id || ''"
                                    model-expression="member.staff_id"
                                    :options="$staffOptions"
                                    option-value-key="id"
                                    option-label-key="label"
                                    placeholder="Pilih staff..."
                                    required />
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Role</label>
                                <x-atoms.shared.input type="text" x-model="member.role" x-bind:name="'members[' + index + '][role]'" placeholder="Frontend Developer..." />
                            </div>
                            <p class="text-xs font-medium leading-relaxed text-slate-400 dark:text-slate-500 md:col-span-2">
                                Nama, foto, dan bidang otomatis mengikuti data staff yang dipilih.
                            </p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900/50">
            <div class="mb-6 flex items-center justify-between gap-4">
                <h3 class="flex items-center gap-3 text-lg font-black text-slate-800 dark:text-white">
                    <span class="flex size-8 items-center justify-center rounded-xl bg-blue-500/10 text-blue-500">
                        <x-heroicon-s-map class="size-5" />
                    </span>
                    Alur Pengembangan
                </h3>
                <x-atoms.shared.button type="button" variant="soft" size="sm" icon="heroicon-o-plus" @click="addMilestone()">
                    Tambah Alur
                </x-atoms.shared.button>
            </div>

            <div class="space-y-5">
                <template x-for="(milestone, index) in milestones" :key="'milestone-' + index">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5 dark:border-slate-800 dark:bg-slate-950">
                        <div class="mb-5 flex items-center justify-between gap-4">
                            <p class="text-xs font-black uppercase text-slate-400">Milestone <span x-text="index + 1"></span></p>
                            <button type="button" @click="removeMilestone(index)"
                                class="inline-flex size-9 items-center justify-center rounded-xl text-red-400 transition hover:bg-red-500/10 hover:text-red-500">
                                <x-heroicon-o-trash class="size-4" />
                            </button>
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Periode Label</label>
                                <x-atoms.shared.input type="text" x-model="milestone.period_label" x-bind:name="'milestones[' + index + '][period]'" placeholder="2025/2026" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Status</label>
                                <x-molecules.shared.forms.form-input
                                    type="select"
                                    name="milestones[][status]"
                                    name-expression="'milestones[' + index + '][status]'"
                                    selected-expression="milestone.status || 'planned'"
                                    model-expression="milestone.status"
                                    :options="$milestoneStatusOptions"
                                    required />
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Judul</label>
                                <x-atoms.shared.input type="text" x-model="milestone.title" x-bind:name="'milestones[' + index + '][title]'" placeholder="Pengembangan Fitur Lanjutan..." />
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Deskripsi</label>
                                <textarea x-model="milestone.description" x-bind:name="'milestones[' + index + '][description]'" rows="3"
                                    placeholder="Tuliskan deskripsi milestone..."
                                    class="w-full resize-none rounded-2xl border border-slate-200/50 bg-white px-4 py-3 text-sm font-medium text-slate-700 shadow-sm outline-none transition-all duration-300 placeholder:text-slate-400 focus:border-primary focus:ring-4 focus:ring-primary/10 dark:border-slate-800/70 dark:bg-slate-950/45 dark:text-white dark:placeholder:text-slate-600"></textarea>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <aside class="space-y-8">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900/50">
            <h3 class="mb-6 text-xs font-black uppercase text-slate-800 dark:text-white">Status Konten</h3>
            <div class="space-y-4">
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950">
                    <p class="text-[10px] font-black uppercase text-slate-400">Mode</p>
                    <p class="mt-1 text-sm font-bold text-primary">Database</p>
                </div>
                <p class="text-xs font-medium leading-relaxed text-slate-500 dark:text-slate-400">
                    Perubahan form ini menyimpan hero global dan konten anggota/alur untuk periode yang dipilih.
                </p>
            </div>
        </div>
    </aside>
</div>
