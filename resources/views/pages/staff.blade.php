<x-layout 
    title="Daftar Pengurus | HMTIF UNPAS" 
    description="Kenali jajaran pengurus HMTIF UNPAS Kabinet Kartala. Mengenal struktur organisasi, profil pimpinan, dan departemen yang bergerak untuk kemajuan Informatika."
    keywords="Pengurus HMTIF, Struktur Organisasi HMTIF, Kabinet Kartala, Pimpinan HMTIF UNPAS"
    :transparent="false"
>
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
                "name": "Daftar Pengurus",
                "item": "{{ url()->current() }}"
            }]
        }
        </script>
    </x-slot:head>
    <x-pages.staff.hero />

    <div class="bg-white pt-10 pb-32">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <x-pages.staff.bph />
            <x-pages.staff.divisions />
        </div>
    </div>
</x-layout>