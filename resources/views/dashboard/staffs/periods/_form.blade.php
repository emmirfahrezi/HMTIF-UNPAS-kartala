<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
            <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-calendar-days class="size-32" />
            </div>

            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
                    <x-heroicon-s-calendar-days class="size-5" />
                </span>
                Informasi Periode
            </h3>

            <div class="space-y-6">
                <x-molecules.shared.forms.form-input
                    label="Label Periode"
                    name="label"
                    placeholder="Contoh: 2026/2027"
                    :value="$period?->label ?? ''"
                    required />
            </div>
        </div>
    </div>

    <div class="space-y-8">
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
            <div class="absolute top-0 right-0 p-6 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-adjustments-horizontal class="size-24" />
            </div>

            <h3 class="text-xs font-black text-slate-800 dark:text-white mb-6 uppercase tracking-widest text-center">Pengaturan</h3>

            <div class="space-y-6">
                <x-molecules.shared.forms.form-input
                    label="Urutan Tampil"
                    name="display_order"
                    type="number"
                    :value="$period?->display_order ?? 0"
                    helper="Urutan periode pada dropdown publik dan dashboard" />

                <x-molecules.shared.forms.form-input
                    type="toggle"
                    label="Periode Aktif"
                    name="is_active"
                    :value="$period?->is_active ?? false" />
            </div>
        </div>

        <div class="bg-primary/5 dark:bg-primary/10 rounded-2xl p-6 border border-primary/10 dark:border-primary/20 transition-colors duration-300">
            <div class="flex gap-4">
                <div class="size-10 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center shrink-0">
                    <x-heroicon-s-information-circle class="size-5" />
                </div>
                <div>
                    <h4 class="text-xs font-black text-primary uppercase tracking-widest mb-1">Info</h4>
                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        Periode aktif menjadi default pada halaman publik dan dashboard.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
