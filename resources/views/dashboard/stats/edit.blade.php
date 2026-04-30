<x-layouts.dashboard pageTitle="Edit Stat" :breadcrumbs="[['label' => 'Statistik', 'href' => '/dashboard/stats'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/stats/{{ $stat->id }}">@csrf @method('PUT')
        <div class="space-y-6 max-w-4xl">
            <x-molecules.shared.forms.form-section title="Data Statistik">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-molecules.shared.forms.form-input label="Label" name="label" :value="$stat->label" required />
                    <x-molecules.shared.forms.form-input label="Nilai" name="value" :value="$stat->value" required />
                    <x-molecules.shared.forms.form-input label="Icon" name="icon" :value="$stat->icon" />
                    <x-molecules.shared.forms.form-input type="number" label="Urutan" name="order" :value="$stat->order" />
                </div>
            </x-molecules.shared.forms.form-section>
            <div class="flex items-center gap-3 mt-8">
                <x-atoms.shared.button type="submit">
                    Simpan Perubahan
                </x-atoms.shared.button>
                <x-atoms.shared.button variant="ghost" href="/dashboard/stats">
                    Batal
                </x-atoms.shared.button>
            </div>
        </div>
    </form>
</x-layouts.dashboard>

