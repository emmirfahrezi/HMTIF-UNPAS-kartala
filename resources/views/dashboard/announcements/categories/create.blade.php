<x-layouts.dashboard pageTitle="Tambah Kategori" :breadcrumbs="[['label' => 'Pengumuman', 'href' => '/dashboard/announcements'], ['label' => 'Kategori', 'href' => '/dashboard/announcements/categories'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/announcements/categories">@csrf
        <div class="space-y-6 max-w-4xl">
            <x-molecules.dashboard.forms.form-section title="Kategori Pengumuman">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-molecules.dashboard.forms.form-input label="Nama" name="name" required data-slug-source="slug" />
                    <x-molecules.dashboard.forms.form-input label="Slug" name="slug" required />
                </div>
            </x-dashboard.form-section>
            <div class="flex items-center gap-3">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">Tambah</button>
                <a href="/dashboard/announcements" class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">Batal</a>
            </div>
        </div>
    </form>
    @vite(['resources/js/dashboard/slug-helper.js'])

</x-layouts.dashboard>
