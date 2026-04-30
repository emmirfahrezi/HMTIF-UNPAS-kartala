<x-layouts.app title="Detail Produk | HMTIF Store"
    description="Rincian produk resmi HMTIF UNPAS. Cek spesifikasi bahan, ukuran, dan harga merchandise eksklusif HMTIF. Pesan sekarang melalui WhatsApp."
    keywords="Merchandise Informatika, Hoodie Kartala, Atribut HMTIF UNPAS, Jual Jaket Informatika" :transparent="false">
    <x-organisms.pages.product-detail.breadcrumb />

    <section class="py-16 bg-white overflow-hidden">
        <div class="container mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 items-start">
                <x-organisms.pages.product-detail.gallery :product="$product" />
                <x-organisms.pages.product-detail.product-info :product="$product" />
            </div>
        </div>
    </section>

    <x-organisms.pages.product-detail.related-products :products="$related" />
</x-layouts.app>

