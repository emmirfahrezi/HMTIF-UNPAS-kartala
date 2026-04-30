<x-layouts.dashboard pageTitle="Tambah Produk" :breadcrumbs="[['label' => 'Produk', 'href' => '/dashboard/products'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/products" enctype="multipart/form-data">
        @csrf
        @include('dashboard.products._form', ['product' => null])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/products">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Tambah Produk
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
