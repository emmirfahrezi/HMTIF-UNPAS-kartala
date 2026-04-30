<x-layouts.app 
    title="Detail Pengumuman | HMTIF UNPAS" 
    description="Baca pengumuman resmi dan berita terbaru dari HMTIF UNPAS. Informasi terverifikasi mengenai akademik, organisasi, dan agenda penting."
    keywords="Info Penting HMTIF, Warta Terbaru Informatika, Pengumuman Mahasiswa"
    :transparent="false"
>
    <x-pages.announcement-detail.hero :announcement="$announcement" />

    <section class="pb-24 bg-section/30 min-h-screen">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mt-8">
                <x-pages.announcement-detail.article-content :announcement="$announcement" />
                <x-pages.announcement-detail.sidebar :announcements="$relatedAnnouncements" />
            </div>
        </div>
    </section>
</x-layouts.app>

