<x-layouts.dashboard pageTitle="Tambah Kategori Produk" :breadcrumbs="[['label' => 'Produk', 'href' => '/dashboard/products'], ['label' => 'Kategori', 'href' => '/dashboard/products/categories'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/products/categories">
        @csrf
        @include('dashboard.products.categories._form', ['category' => null])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/products/categories">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Tambah Kategori
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
