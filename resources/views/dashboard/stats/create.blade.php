<x-layouts.dashboard pageTitle="Tambah Stat" :breadcrumbs="[['label' => 'Statistik', 'href' => '/dashboard/stats'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/stats">@csrf
        <div class="space-y-6 max-w-4xl">
            <x-molecules.shared.forms.form-section title="Data Statistik">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-molecules.shared.forms.form-input label="Label" name="label" required placeholder="Contoh: Anggota Aktif" />
                    <x-molecules.shared.forms.form-input label="Nilai" name="value" required placeholder="Contoh: 150+" />
                    <x-molecules.shared.forms.form-input label="Icon" name="icon" placeholder="heroicon-o-users" helper="Nama komponen Heroicon" />
                    <x-molecules.shared.forms.form-input type="number" label="Urutan" name="order" value="0" />
                </div>
            </x-molecules.shared.forms.form-section>
            <div class="flex items-center gap-3 mt-8">
                <x-atoms.shared.button type="submit">
                    Tambah Stat
                </x-atoms.shared.button>
                <x-atoms.shared.button variant="ghost" href="/dashboard/stats">
                    Batal
                </x-atoms.shared.button>
            </div>
        </div>
    </form>
</x-layouts.dashboard>

