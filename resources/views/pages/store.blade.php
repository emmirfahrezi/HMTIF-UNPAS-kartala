<x-layout title="HMTIF Store | Official Merch"
    description="Dapatkan atribut resmi dan merchandise eksklusif HMTIF UNPAS. Dukung identitas almamater dengan produk berkualitas dari Niaga Kartala."
    keywords="HMTIF Store, Merchandise Informatika, Jaket HMTIF, Atribut Teknik Informatika" :transparent="false">
    <x-slot:head>
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "BreadcrumbList",
            "itemListElement": [{
                "@@type": "ListItem",
                "position": 1,
                "name": "Beranda",
                "item": "{{ url('/') }}"
            },{
                "@@type": "ListItem",
                "position": 2,
                "name": "Niaga Kartala",
                "item": "{{ url()->current() }}"
            }]
        }
        </script>
    </x-slot:head>
    <x-pages.store.hero />
    <x-pages.store.category-strip />
    <x-pages.store.product-grid />
    <x-pages.store.custom-cta />
</x-layout>