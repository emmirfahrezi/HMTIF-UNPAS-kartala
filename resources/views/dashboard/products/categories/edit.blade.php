<x-layouts.dashboard pageTitle="Edit Kategori Produk" :breadcrumbs="[['label' => 'Produk', 'href' => '/dashboard/products'], ['label' => 'Kategori', 'href' => '/dashboard/products/categories'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/products/categories/{{ $category->id }}">
        @csrf
        @method('PUT')
        @include('dashboard.products.categories._form', ['category' => $category])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/products/categories">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
