<x-dashboard-layout pageTitle="Edit Produk" :breadcrumbs="[['label' => 'Produk', 'href' => '/dashboard/products'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/products/{{ $product->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.products._form', ['product' => $product])
    </form>
</x-dashboard-layout>
