<x-layouts.dashboard pageTitle="Edit Stat" :breadcrumbs="[['label' => 'Statistik', 'href' => '/dashboard/stats'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/stats/{{ $stat->id }}">@csrf @method('PUT')
        <div class="space-y-6 max-w-4xl">
            <x-molecules.dashboard.forms.form-section title="Data Statistik">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-molecules.dashboard.forms.form-input label="Label" name="label" :value="$stat->label" required />
                    <x-molecules.dashboard.forms.form-input label="Nilai" name="value" :value="$stat->value" required />
                    <x-molecules.dashboard.forms.form-input label="Icon" name="icon" :value="$stat->icon" />
                    <x-molecules.dashboard.forms.form-input type="number" label="Urutan" name="order" :value="$stat->order" />
                </div>
            </x-dashboard.form-section>
            <div class="flex items-center gap-3">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">Simpan</button>
                <a href="/dashboard/stats" class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">Batal</a>
            </div>
        </div>
    </form>
</x-layouts.dashboard>
