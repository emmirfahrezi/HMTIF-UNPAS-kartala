<x-layouts.dashboard pageTitle="Edit Produk" :breadcrumbs="[['label' => 'Produk', 'href' => '/dashboard/products'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/products/{{ $product->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.products._form', ['product' => $product])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/products">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
