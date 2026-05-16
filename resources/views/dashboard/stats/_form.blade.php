<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mx-auto">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        <x-molecules.shared.forms.form-section title="Data Statistik" icon="heroicon-s-chart-bar"
            bg-icon="heroicon-o-chart-bar">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <x-molecules.shared.forms.form-input label="Label" name="label" :value="$stat?->label" required
                    placeholder="Contoh: Anggota Aktif" />
                <x-molecules.shared.forms.form-input label="Nilai" name="value" :value="$stat?->value" required
                    placeholder="Contoh: 150+" />
                <x-molecules.shared.forms.form-input label="Icon" name="icon" :value="$stat?->icon"
                    placeholder="heroicon-o-users" helper="Nama komponen Heroicon" />
                <x-molecules.shared.forms.form-input type="number" label="Urutan" name="order"
                    :value="$stat?->order ?? 0" />
            </div>
        </x-molecules.shared.forms.form-section>
    </div>

    {{-- Sidebar Content --}}
    <div class="space-y-8">
        <div
            class="bg-indigo-500/5 dark:bg-indigo-500/10 rounded-2xl p-6 border border-indigo-500/10 dark:border-indigo-500/20 transition-colors duration-300">
            <div class="flex gap-4">
                <div
                    class="size-10 rounded-xl bg-indigo-500/10 dark:bg-indigo-500/20 text-indigo-500 flex items-center justify-center shrink-0">
                    <x-heroicon-s-information-circle class="size-5" />
                </div>
                <div>
                    <h4 class="text-xs font-black text-indigo-500 uppercase tracking-widest mb-1">Informasi Icon
                    </h4>
                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        Masukkan nama komponen dari <strong>Blade Heroicons</strong>. Contoh:
                        <code>heroicon-o-users</code> untuk outline, atau <code>heroicon-s-users</code> untuk
                        solid.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 flex items-center justify-end gap-3">
    <x-atoms.shared.button variant="ghost" href="/dashboard/stats">
        Batal
    </x-atoms.shared.button>
    <x-atoms.shared.button type="submit">
        {{ $stat ? 'Simpan Perubahan' : 'Tambah Stat' }}
    </x-atoms.shared.button>
</div>

