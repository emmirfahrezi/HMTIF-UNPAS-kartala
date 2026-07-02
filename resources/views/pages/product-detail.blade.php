<x-layouts.app :title="$product->name . ' | HMTIF Store'"
    :description="\Illuminate\Support\Str::limit(strip_tags($product->description ?: 'Produk merchandise resmi HMTIF-UNPAS. Pesan sekarang melalui WhatsApp.'), 155)"
    :keywords="$product->name . ', Merchandise HMTIF, Atribut HMTIF-UNPAS, HMTIF Store'" :transparent="false">
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

