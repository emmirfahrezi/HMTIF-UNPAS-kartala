<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $akademik      = AnnouncementCategory::where('slug', 'akademik')->first();
        $kemahasiswaan = AnnouncementCategory::where('slug', 'kemahasiswaan')->first();
        $lomba         = AnnouncementCategory::where('slug', 'lomba-kompetisi')->first();
        $organisasi    = AnnouncementCategory::where('slug', 'organisasi')->first();
        $beasiswa      = AnnouncementCategory::where('slug', 'beasiswa')->first();

        $announcements = [
            [
                'announcement_category_id' => $organisasi->id,
                'title'        => 'Musyawarah Besar HMTIF 2026 Segera Digelar',
                'slug'         => 'musyawarah-besar-hmtif-2026-segera-digelar',
                'excerpt'      => 'MUBES HMTIF UNPAS 2026 akan digelar pada 15 Mei 2026. Seluruh mahasiswa Teknik Informatika diharapkan hadir sebagai delegasi.',
                'body'         => '<p>Diberitahukan kepada seluruh mahasiswa Teknik Informatika Universitas Pasundan bahwa Musyawarah Besar (MUBES) HMTIF 2026 akan segera digelar. Agenda ini merupakan forum tertinggi organisasi yang akan menentukan arah gerak himpunan untuk satu periode ke depan.</p><h3>Informasi Pelaksanaan:</h3><ul><li>Tanggal: 15 Mei 2026</li><li>Tempat: Gedung Mandala, Kampus IV UNPAS</li><li>Dresscode: Almamater UNPAS</li></ul><p>Seluruh mahasiswa Teknik Informatika aktif diwajibkan hadir sebagai delegasi.</p>',
                'thumbnail'    => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=1200&auto=format&fit=crop',
                'published_at' => '2026-04-15 08:00:00',
            ],
            [
                'announcement_category_id' => $kemahasiswaan->id,
                'title'        => 'Open Recruitment Panitia LDKM Kartala Generation 2026',
                'slug'         => 'open-recruitment-panitia-ldkm-kartala-generation-2026',
                'excerpt'      => 'HMTIF UNPAS membuka rekrutmen panitia untuk LDKM 2026. Jadilah bagian dari tim yang membentuk generasi pemimpin Informatika!',
                'body'         => '<p>HMTIF UNPAS membuka kesempatan bagi seluruh mahasiswa Teknik Informatika untuk bergabung sebagai panitia LDKM Kartala Generation 2026.</p><h3>Persyaratan:</h3><ul><li>Mahasiswa aktif minimal semester 2</li><li>Memiliki dedikasi dan semangat tinggi</li><li>Bersedia mengikuti seluruh rangkaian kepanitiaan</li></ul><p>Daftarkan dirimu sekarang melalui link pendaftaran yang tersedia.</p>',
                'thumbnail'    => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200&auto=format&fit=crop',
                'published_at' => '2026-04-10 09:00:00',
            ],
            [
                'announcement_category_id' => $lomba->id,
                'title'        => 'Pendaftaran Informatics Championship 2026 Telah Dibuka',
                'slug'         => 'pendaftaran-informatics-championship-2026-telah-dibuka',
                'excerpt'      => 'Informatics Championship 2026 kini membuka pendaftaran peserta. Buktikan kemampuanmu di bidang programming, UI/UX, dan hackathon!',
                'body'         => '<p>Informatics Championship 2026 resmi membuka pendaftaran! Kompetisi bergengsi ini terbuka untuk mahasiswa Teknik Informatika se-Jawa Barat.</p><h3>Kategori Lomba:</h3><ul><li>Competitive Programming</li><li>UI/UX Design Challenge</li><li>Mini Hackathon</li></ul><h3>Total Hadiah:</h3><p>Rp 10.000.000 untuk seluruh kategori.</p><p>Pendaftaran dibuka hingga 10 Juni 2026.</p>',
                'thumbnail'    => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=1200&auto=format&fit=crop',
                'published_at' => '2026-04-08 10:00:00',
            ],
            [
                'announcement_category_id' => $akademik->id,
                'title'        => 'Jadwal Ujian Akhir Semester Genap 2025/2026',
                'slug'         => 'jadwal-ujian-akhir-semester-genap-2025-2026',
                'excerpt'      => 'Informasi jadwal Ujian Akhir Semester (UAS) Genap 2025/2026 untuk mahasiswa Teknik Informatika UNPAS.',
                'body'         => '<p>Diberitahukan kepada seluruh mahasiswa Teknik Informatika UNPAS bahwa Ujian Akhir Semester (UAS) Genap 2025/2026 akan dilaksanakan mulai 9 Juni hingga 20 Juni 2026.</p><p>Mahasiswa diwajibkan membawa Kartu Ujian yang sudah divalidasi dan hadir 15 menit sebelum ujian dimulai.</p><p>Detail jadwal per mata kuliah akan diumumkan melalui portal akademik UNPAS.</p>',
                'thumbnail'    => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=1200&auto=format&fit=crop',
                'published_at' => '2026-04-05 07:00:00',
            ],
            [
                'announcement_category_id' => $beasiswa->id,
                'title'        => 'Beasiswa Yayasan Pasundan untuk Mahasiswa Berprestasi',
                'slug'         => 'beasiswa-yayasan-pasundan-untuk-mahasiswa-berprestasi',
                'excerpt'      => 'Yayasan Pasundan kembali membuka program beasiswa bagi mahasiswa Teknik Informatika yang berprestasi akademik dan non-akademik.',
                'body'         => '<p>Yayasan Pasundan kembali membuka program beasiswa untuk mahasiswa berprestasi Teknik Informatika UNPAS. Program ini memberikan keringanan biaya kuliah hingga 100% bagi penerima terpilih.</p><h3>Persyaratan Umum:</h3><ul><li>IPK minimal 3.50</li><li>Aktif berorganisasi</li><li>Tidak sedang menerima beasiswa lain</li><li>Melampirkan surat rekomendasi dari dosen pembimbing</li></ul><p>Berkas pendaftaran diterima paling lambat 30 April 2026.</p>',
                'thumbnail'    => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1200&auto=format&fit=crop',
                'published_at' => '2026-04-01 08:00:00',
            ],
            [
                'announcement_category_id' => $organisasi->id,
                'title'        => 'Update Jadwal Rapat Pleno Kabinet Semester Genap',
                'slug'         => 'update-jadwal-rapat-pleno-kabinet-semester-genap',
                'excerpt'      => 'Jadwal rapat pleno kabinet untuk evaluasi program kerja semester genap 2025/2026 telah ditetapkan.',
                'body'         => '<p>Diberitahukan kepada seluruh pengurus HMTIF UNPAS Kabinet Kartala bahwa Rapat Pleno evaluasi program kerja semester genap akan dilaksanakan pada:</p><ul><li>Hari: Sabtu, 25 April 2026</li><li>Waktu: 09.00 WIB — Selesai</li><li>Tempat: Sekretariat HMTIF, Kampus I UNPAS</li></ul><p>Seluruh koordinator bidang diwajibkan hadir dan menyiapkan laporan perkembangan program kerja masing-masing.</p>',
                'thumbnail'    => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1200&auto=format&fit=crop',
                'published_at' => '2026-03-28 08:00:00',
            ],
            [
                'announcement_category_id' => $kemahasiswaan->id,
                'title'        => 'Workshop UI/UX Bersama Google Developer Student Club',
                'slug'         => 'workshop-ui-ux-bersama-google-developer-student-club',
                'excerpt'      => 'HMTIF UNPAS berkolaborasi dengan Google DSC untuk mengadakan workshop UI/UX Design Thinking. Kuota terbatas!',
                'body'         => '<p>HMTIF UNPAS berkolaborasi dengan Google Developer Student Club (GDSC) UNPAS untuk menyelenggarakan workshop eksklusif UI/UX Design Thinking.</p><p>Workshop ini akan dipandu langsung oleh Google Certified Trainers dan terbuka untuk mahasiswa semua angkatan Teknik Informatika.</p><h3>Fasilitas Peserta:</h3><ul><li>E-Certificate dari Google</li><li>Akses Figma Education Plan</li><li>Snack & Lunch</li></ul><p>Kuota hanya 50 peserta. Daftar sekarang!</p>',
                'thumbnail'    => 'https://images.unsplash.com/photo-1542744094-24638eff58bb?q=80&w=1200&auto=format&fit=crop',
                'published_at' => '2026-03-20 09:00:00',
            ],
            [
                'announcement_category_id' => $lomba->id,
                'title'        => 'Lomba Coding Nasional COMPFEST UI 2026',
                'slug'         => 'lomba-coding-nasional-compfest-ui-2026',
                'excerpt'      => 'Ikuti COMPFEST UI 2026, kompetisi pemrograman nasional bergengsi. HMTIF UNPAS mendukung dan memfasilitasi pendaftaran.',
                'body'         => '<p>HMTIF UNPAS menginformasikan bahwa COMPFEST UI 2026 kini membuka pendaftaran untuk beberapa kategori kompetisi pemrograman tingkat nasional.</p><p>Bagi mahasiswa yang berminat mendaftar, HMTIF UNPAS siap memfasilitasi proses pendaftaran dan memberikan bimbingan persiapan kompetisi.</p><p>Hubungi bidang KASTRAD untuk informasi lebih lanjut.</p>',
                'thumbnail'    => 'https://images.unsplash.com/photo-1516116216624-53e697fedbea?q=80&w=1200&auto=format&fit=crop',
                'published_at' => '2026-03-15 10:00:00',
            ],
            [
                'announcement_category_id' => $akademik->id,
                'title'        => 'Perubahan Kurikulum Semester Genap Prodi Informatika',
                'slug'         => 'perubahan-kurikulum-semester-genap-prodi-informatika',
                'excerpt'      => 'Program studi Teknik Informatika UNPAS melakukan penyesuaian kurikulum untuk semester genap 2025/2026.',
                'body'         => '<p>Diberitahukan kepada seluruh mahasiswa bahwa Program Studi Teknik Informatika UNPAS melakukan penyesuaian kurikulum untuk semester genap 2025/2026 sesuai standar KKNI terbaru.</p><p>Beberapa perubahan meliputi penambahan mata kuliah pilihan di bidang kecerdasan buatan dan keamanan siber. Konsultasikan dengan dosen PA masing-masing terkait rencana studi.</p>',
                'thumbnail'    => 'https://images.unsplash.com/photo-1569012871812-f38ee64cd54c?q=80&w=1200&auto=format&fit=crop',
                'published_at' => '2026-03-10 08:00:00',
            ],
            [
                'announcement_category_id' => $kemahasiswaan->id,
                'title'        => 'Peluncuran Portal Aspirasi Online HMTIF UNPAS',
                'slug'         => 'peluncuran-portal-aspirasi-online-hmtif-unpas',
                'excerpt'      => 'HMTIF UNPAS resmi meluncurkan portal aspirasi online. Kini mahasiswa bisa menyampaikan aspirasi dengan mudah dan dapat dilacak statusnya.',
                'body'         => '<p>HMTIF UNPAS dengan bangga mengumumkan peluncuran resmi Portal Aspirasi Online Kabinet Kartala. Platform ini hadir untuk memudahkan mahasiswa Teknik Informatika dalam menyampaikan aspirasi, kritik, dan saran secara digital.</p><h3>Fitur Utama:</h3><ul><li>Form aspirasi anonim yang terjamin kerahasiaannya</li><li>Tracking status aspirasi dengan kode unik</li><li>Spotlight aspirasi mingguan yang sedang diperjuangkan</li></ul><p>Akses portal di hmtif.unpas.ac.id/aspirations.</p>',
                'thumbnail'    => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200&auto=format&fit=crop',
                'published_at' => '2026-03-01 08:00:00',
            ],
            [
                'announcement_category_id' => $beasiswa->id,
                'title'        => 'Program Magang Berbayar Perusahaan Teknologi Nasional',
                'slug'         => 'program-magang-berbayar-perusahaan-teknologi-nasional',
                'excerpt'      => 'HMTIF UNPAS membagikan informasi program magang berbayar di beberapa perusahaan teknologi terkemuka di Indonesia.',
                'body'         => '<p>HMTIF UNPAS meneruskan informasi program magang berbayar yang terbuka untuk mahasiswa Teknik Informatika dari beberapa perusahaan teknologi terkemuka di Indonesia, di antaranya Gojek, Tokopedia, dan BCA Digital.</p><p>Program magang ini memberi pengalaman kerja nyata dengan kompensasi kompetitif dan kemungkinan penawaran kerja tetap setelah lulus.</p><p>Pantau pengumuman resmi di website masing-masing perusahaan. HMTIF siap membantu proses seleksi portfolio dan CV.</p>',
                'thumbnail'    => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200&auto=format&fit=crop',
                'published_at' => '2026-02-20 09:00:00',
            ],
        ];

        foreach ($announcements as $data) {
            Announcement::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
