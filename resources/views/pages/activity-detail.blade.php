<x-layouts.app 
    title="Detail Kegiatan | HMTIF UNPAS" 
    description="Lihat rincian lengkap kegiatan HMTIF UNPAS. Informasi waktu, lokasi, deskripsi acara, dan pendaftaran peserta untuk program kerja Informatika."
    keywords="Detail Acara HMTIF, Info Kegiatan Informatika, Event Mahasiswa UNPAS"
    :transparent="false"
>
    <x-pages.activity-detail.hero :activity="$activity" />

    <section class="pb-24 bg-section/30">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mt-8">
                <x-pages.activity-detail.event-details :activity="$activity" />
                <x-pages.activity-detail.sidebar-info :activity="$activity" />
            </div>
        </div>
    </section>
</x-layouts.app>
