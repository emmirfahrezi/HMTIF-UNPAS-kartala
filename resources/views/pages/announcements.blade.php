<x-layouts.app 
    title="Pengumuman & Warta | HMTIF-UNPAS" 
    description="Pusat informasi resmi HMTIF-UNPAS. Dapatkan update terbaru mengenai akademik, organisasi, dan berita penting lainnya bagi civitas Informatika."
    keywords="Pengumuman HMTIF, Berita Informatika UNPAS, Warta Kartala, Info Akademik"
    :transparent="false"
>
    <x-organisms.pages.announcements.hero />

    <div class="bg-section/30 py-16">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                <x-organisms.pages.announcements.main-content :announcements="$announcements" />
                <x-organisms.pages.announcements.sidebar :categories="$categories" />
            </div>
        </div>
    </div>
</x-layouts.app>
