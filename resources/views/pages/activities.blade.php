<x-layout 
    title="Kegiatan & Program Kerja | HMTIF UNPAS" 
    description="Jelajahi berbagai program kerja dan kegiatan inovatif HMTIF UNPAS. Dari kompetisi teknologi hingga pengabdian masyarakat untuk mahasiswa Informatika."
    keywords="Kegiatan HMTIF, Proker HMTIF, Informatics Championship, Event Teknik Informatika"
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
                "name": "Kegiatan",
                "item": "{{ url()->current() }}"
            }]
        }
        </script>
    </x-slot:head>
    {{-- Hero Section --}}
    <x-pages.activities.hero />
    <x-pages.activities.upcoming-timeline />
    <x-pages.activities.filter-bar />
    <x-pages.activities.program-grid />
</x-layout>
