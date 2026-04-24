<x-layouts.dashboard pageTitle="Tambah Produk" :breadcrumbs="[['label' => 'Produk', 'href' => '/dashboard/products'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/products" enctype="multipart/form-data">
        @csrf
        @include('dashboard.products._form', ['product' => null])
    </form>
</x-layouts.dashboard>
