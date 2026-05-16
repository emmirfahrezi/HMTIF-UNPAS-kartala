@props(['division'])

@php
    $isBph = $division->slug === 'bph' || strtolower($division->name) === 'badan pengurus harian';

    // Dictionary of tasks based on role
    $bphRoles = [
        [
            'title' => 'Ketua Umum',
            'desc' => 'Pemimpin tertinggi yang bertanggung jawab penuh atas seluruh arah kebijakan, program kerja, dan keharmonisan internal HMTIF UNPAS. Menjadi representasi utama himpunan di pihak eksternal maupun internal kampus.',
            'icon' => 'star',
        ],
        [
            'title' => 'Sekretaris Jenderal',
            'desc' => 'Tangan kanan Ketua Himpunan dalam fungsi pengawasan dan operasional. Membantu mengkoordinasikan setiap bidang agar berjalan selaras dengan visi dan misi kabinet, serta menjadi jembatan komunikasi antar divisi.',
            'icon' => 'shield-check',
        ],
        [
            'title' => 'Sekretaris Umum',
            'desc' => 'Penanggung jawab utama dalam hal administrasi, kesekretariatan, persuratan, dan inventaris himpunan. Memastikan seluruh arsip dan dokumen legal HMTIF terkelola dengan tertib dan profesional.',
            'icon' => 'document-text',
        ],
        [
            'title' => 'Wakil Sekretaris Umum',
            'desc' => 'Mendampingi Sekretaris Umum dalam menjalankan tugas administrasi harian, pengelolaan jadwal kegiatan, serta notulensi rapat-rapat penting pimpinan.',
            'icon' => 'document-duplicate',
        ],
        [
            'title' => 'Bendahara Umum',
            'desc' => 'Pemegang otoritas tertinggi dalam manajemen sirkulasi keuangan himpunan. Bertanggung jawab atas perumusan anggaran, pencatatan transaksi, penyusunan laporan keuangan transparan, dan strategi pendanaan.',
            'icon' => 'banknotes',
        ],
        [
            'title' => 'Wakil Bendahara Umum',
            'desc' => 'Membantu Bendahara Umum dalam kontrol arus kas harian, mengelola penarikan uang kas anggota, serta mengurus keperluan operasional keuangan berskala kecil.',
            'icon' => 'credit-card',
        ],
        [
            'title' => 'Kepala Bidang 1',
            'desc' => 'Bertanggung jawab atas koordinasi, pengawasan, dan sinkronisasi program kerja dari bidang-bidang yang berada di bawah naungannya (umumnya bidang yang berkaitan dengan keilmuan dan pengembangan sumber daya).',
            'icon' => 'academic-cap',
        ],
        [
            'title' => 'Kepala Bidang 2',
            'desc' => 'Bertanggung jawab atas koordinasi, pengawasan, dan sinkronisasi program kerja dari bidang-bidang yang berada di bawah naungannya (umumnya bidang yang berkaitan dengan relasi eksternal, kesejahteraan, dan minat bakat).',
            'icon' => 'globe-alt',
        ],
    ];

    $divisionRoles = [
        [
            'title' => 'Koordinator Bidang',
            'desc' => 'Penanggung jawab utama di divisinya. Bertugas merancang Grand Design program kerja, memimpin jalannya eksekusi program, serta mengawasi kinerja, kedisiplinan, dan kesejahteraan seluruh fungsionaris (anggota) di bidangnya.',
            'icon' => 'flag',
        ],
        [
            'title' => 'Anggota Bidang (Fungsionaris)',
            'desc' => 'Motor penggerak jalannya program kerja. Masing-masing anggota memegang peran strategis dalam mengeksekusi tugas spesifik sesuai dengan fokus bidang, serta berinovasi untuk mensukseskan kegiatan HMTIF.',
            'icon' => 'users',
        ],
    ];

    $rolesToShow = $isBph ? $bphRoles : $divisionRoles;
@endphp

<div class="-mt-2 space-y-12">
    <div class="mb-10 max-w-3xl">
        <h2 class="text-3xl font-black text-heading uppercase tracking-tighter italic mb-4">
            Rincian <span class="text-primary">Tugas & Wewenang</span>
        </h2>
        <p class="text-body/80 text-lg leading-relaxed">
            Berikut adalah penjelasan mengenai fokus kerja, peran, dan tanggung jawab dari setiap jabatan yang ada di
            dalam struktur {{ $division->name }}.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 relative">
        @foreach ($rolesToShow as $index => $role)
            <div
                class="bg-white rounded-2xl p-8 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgba(36,130,50,0.1)] transition-all duration-500 relative overflow-hidden group reveal reveal-up reveal-delay-{{ ($index % 4) + 1 }}">
                {{-- Decorative Background Icon --}}
                <div
                    class="absolute -right-6 -top-6 text-primary/5 transition-transform duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none">
                    <x-dynamic-component :component="'heroicon-s-' . $role['icon']" class="w-48 h-48" />
                </div>

                <div class="relative z-10">
                    <div
                        class="w-14 h-14 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-500">
                        <x-dynamic-component :component="'heroicon-o-' . $role['icon']" class="w-7 h-7" />
                    </div>

                    <h3 class="text-xl md:text-2xl font-black text-heading uppercase tracking-widest mb-4">
                        {{ $role['title'] }}
                    </h3>

                    <div class="w-12 h-1 bg-primary rounded-full mb-6"></div>

                    <p class="text-body/70 leading-relaxed">
                        {{ $role['desc'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>