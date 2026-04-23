<x-dashboard-layout pageTitle="Tambah Stat" :breadcrumbs="[['label' => 'Statistik', 'href' => '/dashboard/stats'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/stats">@csrf
        <div class="space-y-6 max-w-4xl">
            <x-dashboard.form-section title="Data Statistik">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-dashboard.form-input label="Label" name="label" required placeholder="Contoh: Anggota Aktif" />
                    <x-dashboard.form-input label="Nilai" name="value" required placeholder="Contoh: 150+" />
                    <x-dashboard.form-input label="Icon" name="icon" placeholder="heroicon-o-users" helper="Nama komponen Heroicon" />
                    <x-dashboard.form-input type="number" label="Urutan" name="order" value="0" />
                </div>
            </x-dashboard.form-section>
            <div class="flex items-center gap-3">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">Tambah</button>
                <a href="/dashboard/stats" class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">Batal</a>
            </div>
        </div>
    </form>
</x-dashboard-layout>
