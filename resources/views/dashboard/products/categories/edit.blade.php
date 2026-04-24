<x-layouts.dashboard pageTitle="Edit Kategori" :breadcrumbs="[['label' => 'Produk', 'href' => '/dashboard/products'], ['label' => 'Edit Kategori']]">
    <form method="POST" action="/dashboard/products/categories/{{ $category->id }}">@csrf @method('PUT')
        <div class="space-y-6 max-w-4xl">
            <x-molecules.dashboard.forms.form-section title="Kategori Produk">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-molecules.dashboard.forms.form-input label="Nama" name="name" :value="$category->name" required />
                    <x-molecules.dashboard.forms.form-input label="Slug" name="slug" :value="$category->slug" required />
                </div>
            </x-dashboard.form-section>
            <div class="flex items-center gap-3">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">Simpan</button>
                <a href="/dashboard/products" class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">Batal</a>
            </div>
        </div>
    </form>
</x-layouts.dashboard>
