<?php

namespace Database\Seeders;

use App\Models\Aspiration;
use Illuminate\Database\Seeder;

class AspirationSeeder extends Seeder
{
    public function run(): void
    {
        $aspirations = [
            [
                'name'           => 'Rafi Pratama',
                'nim'            => '23552011001',
                'email'          => 'rafi.pratama@student.unpas.ac.id',
                'subject'        => 'Peningkatan Fasilitas Lab Komputer',
                'message'        => 'Saya ingin menyampaikan aspirasi mengenai kondisi lab komputer yang perlu diperbarui. Beberapa unit komputer sudah cukup tua dan sering mengalami masalah teknis yang mengganggu kegiatan praktikum. Mohon kiranya dapat diprioritaskan pengadaan unit komputer baru, terutama yang mendukung kebutuhan mata kuliah basis data dan jaringan komputer.',
                'tracking_code'  => 'ASP2026001',
                'status'         => 'resolved',
                'is_spotlight'   => true,
                'spotlighted_week' => '2026-04-07',
            ],
            [
                'name'           => 'Siti Nurhaliza',
                'nim'            => '23552011042',
                'email'          => 'siti.nurhaliza@student.unpas.ac.id',
                'subject'        => 'Jadwal Kuliah yang Tumpang Tindih',
                'message'        => 'Terdapat beberapa jadwal kuliah semester ini yang tumpang tindih antar matakuliah, khususnya untuk angkatan 2023. Hal ini menyulitkan mahasiswa dalam memilih kelas. Mohon koordinasi lebih baik dengan pihak fakultas agar tidak terjadi bentrok jadwal di semester berikutnya.',
                'tracking_code'  => 'ASP2026002',
                'status'         => 'reviewed',
                'is_spotlight'   => false,
                'spotlighted_week' => null,
            ],
            [
                'name'           => 'Ahmad Fauzi',
                'nim'            => '22552011015',
                'email'          => 'ahmad.fauzi@student.unpas.ac.id',
                'subject'        => 'Penambahan Komunitas Minat Bakat',
                'message'        => 'HMTIF sebaiknya membuka lebih banyak komunitas minat dan bakat, seperti komunitas UI/UX Design, Cybersecurity, dan Game Development. Saat ini komunitas yang tersedia masih sangat terbatas. Hal ini dapat meningkatkan engagement mahasiswa terhadap himpunan dan menambah portofolio mahasiswa.',
                'tracking_code'  => 'ASP2026003',
                'status'         => 'resolved',
                'is_spotlight'   => true,
                'spotlighted_week' => '2026-04-14',
            ],
            [
                'name'           => 'Dewi Anggraeni',
                'nim'            => '24552011008',
                'email'          => null,
                'subject'        => 'Wifi Kampus yang Sering Tidak Stabil',
                'message'        => 'Koneksi WiFi di area gedung Teknik Informatika sering kali terputus atau sangat lambat, terutama pada jam-jam sibuk perkuliahan. Hal ini sangat menghambat kegiatan belajar yang memerlukan akses internet. Harap dapat ditindaklanjuti ke pihak kampus.',
                'tracking_code'  => 'ASP2026004',
                'status'         => 'reviewed',
                'is_spotlight'   => false,
                'spotlighted_week' => null,
            ],
            [
                'name'           => null,
                'nim'            => null,
                'email'          => null,
                'subject'        => 'Kurangnya Ruang Diskusi untuk Mahasiswa',
                'message'        => 'Sebagai mahasiswa yang aktif dalam berbagai project kelompok, kami sangat membutuhkan ruang diskusi yang nyaman dan memadai. Saat ini mahasiswa seringkali kesulitan menemukan tempat yang kondusif untuk berdiskusi dan mengerjakan tugas bersama di lingkungan kampus.',
                'tracking_code'  => 'ASP2026005',
                'status'         => 'pending',
                'is_spotlight'   => false,
                'spotlighted_week' => null,
            ],
            [
                'name'           => 'Budi Santoso',
                'nim'            => '23552011077',
                'email'          => 'budi.santoso@student.unpas.ac.id',
                'subject'        => 'Program Mentoring Alumni',
                'message'        => 'Saya mengusulkan agar HMTIF mengadakan program mentoring yang menghubungkan mahasiswa aktif dengan alumni yang sudah berkarir di industri teknologi. Program ini bisa sangat bermanfaat untuk mempersiapkan mahasiswa menghadapi dunia kerja dan membangun relasi profesional sejak dini.',
                'tracking_code'  => 'ASP2026006',
                'status'         => 'resolved',
                'is_spotlight'   => true,
                'spotlighted_week' => '2026-04-21',
            ],
            [
                'name'           => 'Rina Melati',
                'nim'            => '24552011022',
                'email'          => 'rina.melati@student.unpas.ac.id',
                'subject'        => 'Transparansi Dana Kegiatan Himpunan',
                'message'        => 'Sebagai anggota himpunan, kami ingin mengetahui lebih jelas mengenai penggunaan dana kegiatan himpunan. Mohon agar laporan keuangan kegiatan dapat dipublikasikan secara transparan, misalnya melalui website atau media sosial himpunan.',
                'tracking_code'  => 'ASP2026007',
                'status'         => 'reviewed',
                'is_spotlight'   => false,
                'spotlighted_week' => null,
            ],
            [
                'name'           => 'Hendra Wijaya',
                'nim'            => '22552011033',
                'email'          => 'hendra.wijaya@student.unpas.ac.id',
                'subject'        => 'Penambahan Komputer di Perpustakaan',
                'message'        => 'Unit komputer yang tersedia di perpustakaan jumlahnya sangat terbatas dan sering kali penuh saat jam belajar. Tolong diusulkan penambahan unit komputer di perpustakaan, atau setidaknya pengadaan charging station yang memadai.',
                'tracking_code'  => 'ASP2026008',
                'status'         => 'pending',
                'is_spotlight'   => false,
                'spotlighted_week' => null,
            ],
            [
                'name'           => null,
                'nim'            => '24552011099',
                'email'          => null,
                'subject'        => 'Ketersediaan Modul Praktikum yang Update',
                'message'        => 'Beberapa modul praktikum yang digunakan saat ini sudah tidak sesuai dengan kondisi industri terkini. Misalnya, materi praktikum Web Programming masih menggunakan teknologi lama. Mohon pihak terkait dapat merevisi dan memperbarui modul agar relevan dengan kebutuhan industri.',
                'tracking_code'  => 'ASP2026009',
                'status'         => 'pending',
                'is_spotlight'   => false,
                'spotlighted_week' => null,
            ],
            [
                'name'           => 'Laila Fitriani',
                'nim'            => '23552011055',
                'email'          => 'laila.fitriani@student.unpas.ac.id',
                'subject'        => 'Inisiatif Baju Wisuda HMTIF',
                'message'        => 'Saya mengusulkan agar HMTIF menyediakan program sewa atau cicilan baju wisuda dengan harga yang terjangkau bagi mahasiswa. Harga sewa baju wisuda saat ini cukup memberatkan, terutama bagi mahasiswa yang tidak mampu.',
                'tracking_code'  => 'ASP2026010',
                'status'         => 'reviewed',
                'is_spotlight'   => false,
                'spotlighted_week' => null,
            ],
            [
                'name'           => 'Doni Prasetyo',
                'nim'            => '21552011002',
                'email'          => 'doni.prasetyo@student.unpas.ac.id',
                'subject'        => 'Workshop Sertifikasi Internasional',
                'message'        => 'Saya mengusulkan agar HMTIF mengadakan workshop atau pelatihan untuk persiapan sertifikasi internasional seperti AWS, Google Cloud, atau CompTIA. Sertifikasi ini sangat dibutuhkan untuk meningkatkan daya saing mahasiswa di pasar kerja global.',
                'tracking_code'  => 'ASP2026011',
                'status'         => 'pending',
                'is_spotlight'   => false,
                'spotlighted_week' => null,
            ],
        ];

        foreach ($aspirations as $data) {
            Aspiration::updateOrCreate(
                ['tracking_code' => $data['tracking_code']],
                $data
            );
        }
    }
}
