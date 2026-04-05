<x-layout 
    title="Detail Produk | HMTIF Store" 
    description="Rincian produk resmi HMTIF UNPAS. Cek spesifikasi bahan, ukuran, dan harga merchandise eksklusif Kabinet Kartala. Pesan sekarang melalui WhatsApp."
    keywords="Merchandise Informatika, Hoodie Kartala, Atribut HMTIF UNPAS, Jual Jaket Informatika"
    :transparent="false"
>
    <x-pages.product-detail.breadcrumb />

    <section class="py-16 bg-white overflow-hidden">
        <div class="container mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 items-start">
                <x-pages.product-detail.gallery />
                <x-pages.product-detail.product-info />
            </div>
        </div>
    </section>

    <x-pages.product-detail.related-products />
</x-layout>
