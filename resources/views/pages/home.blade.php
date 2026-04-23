<x-layout title="Beranda | HMTIF UNPAS"
    description="Portal resmi HMTIF Universitas Pasundan. Wadah aspirasi, informasi kegiatan, dan pengembangan potensi mahasiswa Teknik Informatika UNPAS."
    keywords="HMTIF UNPAS, Teknik Informatika UNPAS, Universitas Pasundan, Himpunan Mahasiswa" :transparent="true">
    <x-slot:head>
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "Organization",
            "name": "HMTIF UNPAS",
            "url": "{{ url('/') }}",
            "logo": "{{ asset('images/placeholders/logo.svg') }}",
            "description": "Himpunan Mahasiswa Teknik Informatika Universitas Pasundan Bandung.",
            "sameAs": [
                "https://www.instagram.com/hmtifunpas",
                "https://github.com/hmtifunpas"
            ]
        }
        </script>
    </x-slot:head>

    <x-pages.home.hero />
    <x-pages.home.about />
    <x-pages.home.vision-mission />
    <x-pages.home.activities-preview :activities="$activities" />
    <x-pages.home.announcements-preview :announcements="$announcements" />
    <x-pages.home.stats :stats="$stats" />
</x-layout>
