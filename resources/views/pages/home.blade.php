<x-layouts.app title="Beranda | HMTIF-UNPAS"
    description="Portal resmi HMTIF Universitas Pasundan. Wadah aspirasi, informasi kegiatan, dan pengembangan potensi mahasiswa Teknik Informatika UNPAS."
    keywords="HMTIF-UNPAS, Teknik Informatika UNPAS, Universitas Pasundan, Himpunan Mahasiswa" :transparent="true"
    lcpImage="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80">
    <x-slot:head>
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "Organization",
            "name": "HMTIF-UNPAS",
            "url": "{{ url('/') }}",
            "logo": "https://zbdknbyvmvbgsvmepdvk.supabase.co/storage/v1/object/public/images/rm-logo-hmtif-unpas.png",
            "description": "Himpunan Mahasiswa Teknik Informatika Universitas Pasundan Bandung.",
            "sameAs": [
                "https://www.instagram.com/hmtifunpas",
                "https://web.facebook.com/hmtifunpas",
                "https://www.tiktok.com/@hmtifunpas.kartala",
                "https://www.youtube.com/@hmtifunpas"
            ]
        }
        </script>
    </x-slot:head>
    <x-organisms.pages.home.hero :home-sections="$homeSections ?? []" />
    <x-organisms.pages.home.about :home-sections="$homeSections ?? []" />
    <x-organisms.pages.home.vision-mission :home-sections="$homeSections ?? []" />
    <x-organisms.pages.home.activities-preview :activities="$activities" />
    <x-organisms.pages.home.announcements-preview :announcements="$announcements" />
    <x-organisms.pages.home.stats :stats="$stats" :home-sections="$homeSections ?? []" />
</x-layouts.app>

