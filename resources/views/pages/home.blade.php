<x-layout title="Beranda" :transparent="true">
    <x-slot:title>
        Beranda
    </x-slot:title>

    <div
        class="relative isolate px-6 pt-14 mt-0 lg:px-8 min-h-screen flex items-center bg-[url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center bg-no-repeat z-0 transform">
        <div class="absolute inset-0 bg-gradient-to-b from-primary-dark/60 via-primary-dark/20 to-transparent z-0"></div>
        <div class="mx-auto max-w-4xl py-24 sm:py-32 z-20 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 backdrop-blur-md rounded-lg text-primary-soft text-sm font-semibold mb-6 animate-fade-in shadow-xl ring-1 ring-white/20">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-soft opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-soft"></span>
                </span>
                Selamat Datang di Portal Resmi HMTIF
            </div>
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-7xl mb-6 drop-shadow-2xl">
                HMTIF UNPAS <br>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-soft to-white italic text-3xl sm:text-5xl">Kabinet Kartala</span>
            </h1>
            <p class="mt-4 text-base font-medium text-white/90 leading-relaxed max-w-2xl mx-auto sm:text-lg">
                Membangun harmoni, menginspirasi perubahan, dan mewujudkan Teknik Informatika yang lebih progresif melalui dedikasi dan kerja nyata.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <x-atoms.button variant="primary" class="px-8 py-3 text-base shadow-xl shadow-primary/30 w-full sm:w-auto transform hover:-translate-y-1 transition-all group">
                    <span>Jelajahi Program</span>
                    <x-heroicon-o-rocket-launch class="size-5 group-hover:rotate-12 transition-transform" />
                </x-atoms.button>
                <x-atoms.button variant="outline" class="px-8 py-3 text-base border-white/40 text-white backdrop-blur-md hover:bg-white/10 w-full sm:w-auto transform hover:-translate-y-1 transition-all group rounded-lg">
                    <span>Tentang Kami</span>
                    <x-heroicon-o-information-circle class="size-5 group-hover:animate-bounce" />
                </x-atoms.button>
            </div>
        </div>
        
        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/40 animate-bounce">
            <span class="text-[10px] uppercase tracking-[0.3em] font-bold">Scroll Down</span>
            <x-heroicon-o-chevron-double-down class="h-6 w-6" />
        </div>
    </div>

    <!-- about HMTIF -->
    <div class="py-24 bg-white relative overflow-hidden">
        {{-- Decorative background text --}}
        <div class="absolute -right-20 top-20 text-[12rem] font-black text-gray-50/80 -rotate-90 select-none pointer-events-none uppercase tracking-tighter">
            HMTIF
        </div>

        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10 space-y-32">
            <!-- SECTION 1: HMTIF UNPAS (Foto Kiri) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <!-- BAGIAN KIRI (FOTO) -->
                <div class="relative group">
                    <div class="absolute -inset-6 bg-primary/5 rounded-lg transform -rotate-3 group-hover:rotate-0 transition-all duration-700 ease-out"></div>
                    <div id="bigPhoto" class="relative rounded-lg overflow-hidden shadow-lg aspect-[4/3] bg-center bg-cover transition-all duration-700 ease-in-out ring-1 ring-black/5"
                        style="background-image: url('https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=900&q=80');">
                        <div class="absolute bottom-6 left-6 flex gap-3 p-3 bg-white/30 backdrop-blur-xl rounded-lg border border-white/40 shadow-lg">
                            <div class="swap-box w-14 h-14 rounded-lg cursor-pointer shadow-lg hover:scale-110 transition-all outline-none ring-2 ring-transparent hover:ring-primary overflow-hidden"
                                data-img="https://images.unsplash.com/photo-1540575861501-7c00117fc9f3?q=80&w=900&auto=format&fit=crop">
                                <img src="https://images.unsplash.com/photo-1540575861501-7c00117fc9f3?q=80&w=900&auto=format&fit=crop" class="w-full h-full object-cover" />
                            </div>
                            <div class="swap-box w-14 h-14 rounded-xl cursor-pointer shadow-inner hover:scale-110 transition-all outline-none ring-2 ring-transparent hover:ring-primary overflow-hidden"
                                data-img="https://images.unsplash.com/photo-1522071823991-b9671f903f75?q=80&w=900&auto=format&fit=crop">
                                <img src="https://images.unsplash.com/photo-1522071823991-b9671f903f75?q=80&w=900&auto=format&fit=crop" class="w-full h-full object-cover" />
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-6 -right-6 bg-white p-4 rounded-2xl shadow-xl border border-gray-100 flex items-center gap-3 animate-float transform hover:scale-105 transition-transform">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                            <x-heroicon-s-academic-cap class="h-5 w-5" />
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Foundation</p>
                            <p class="font-bold text-heading">Sejak 1990-an</p>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN KANAN (CONTENT) -->
                <div class="space-y-8">
                    <div>
                        <x-atoms.section-title>Identitas & Harapan</x-atoms.section-title>
                        <h3 class="text-4xl font-extrabold text-heading mt-4 leading-tight">Himpunan Mahasiswa Teknik Informatika UNPAS</h3>
                    </div>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        HMTIF Universitas Pasundan bukan sekadar organisasi mahasiswa. Kami adalah laboratorium kehidupan, tempat di mana setiap mahasiswa Teknik Informatika menemukan potensi terbaiknya melalui kolaborasi, riset, dan semangat kekeluargaan yang telah terjaga selama puluhan tahun.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="p-4 rounded-xl bg-gray-50 border-l-4 border-primary">
                            <h4 class="font-bold text-heading">Pusat Riset</h4>
                            <p class="text-xs text-gray-500 mt-1">Mengembangkan solusi teknologi inovatif.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 border-l-4 border-primary">
                            <h4 class="font-bold text-heading">Wadah Solutif</h4>
                            <p class="text-xs text-gray-500 mt-1">Menampung aspirasi setiap anggota.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: KABINET KARTALA (Foto Kanan) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <!-- BAGIAN KIRI (CONTENT) - URUTAN DIBALIK DI LAYOUT LG -->
                <div class="order-2 lg:order-1 space-y-8">
                    <div>
                        <x-atoms.section-title>Era Baru: Kartala</x-atoms.section-title>
                        <h3 class="text-4xl font-extrabold text-heading mt-4 leading-tight uppercase italic tracking-tighter">Harmoni Dalam <span class="text-primary italic">Pergerakan Nyata</span></h3>
                    </div>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Di bawah bendera <strong>Kabinet Kartala</strong>, kami berkomitmen untuk menghadirkan perubahan yang progresif. Kartala bukan hanya soal nama, tapi soal bagaimana kami membangun harmoni di tengah keberagaman, menginspirasi melalui dedikasi, dan mengeksekusi setiap program kerja dengan presisi.
                    </p>
                    <div class="space-y-4">
                        @foreach([
                            ['icon' => 'bolt', 'title' => 'Agile & Adaptif', 'desc' => 'Cepat merespon tantangan di era digital yang semakin dinamis.'],
                            ['icon' => 'sparkles', 'title' => 'Inovasi Tanpa Batas', 'desc' => 'Menghadirkan program kerja kreatif yang berdampak luas bagi civitas.']
                        ] as $item)
                        <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-gray-50 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                                <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="size-5" />
                            </div>
                            <div>
                                <h4 class="font-bold text-heading">{{ $item['title'] }}</h4>
                                <p class="text-sm text-gray-400 mt-0.5">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- BAGIAN KANAN (FOTO) - URUTAN DIBALIK DI LAYOUT LG -->
                <div class="order-1 lg:order-2 relative group">
                    <div class="absolute -inset-6 bg-primary-dark/5 rounded-full transform rotate-3 group-hover:rotate-0 transition-all duration-700 ease-out italic"></div>
                    <div class="relative rounded-lg overflow-hidden shadow-2xl aspect-[4/3] bg-[url('https://images.unsplash.com/photo-1522071823991-b9671f903f75?auto=format&fit=crop&w=900&q=80')] bg-center bg-cover ring-1 ring-black/5 transform group-hover:scale-[1.02] transition-all duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-dark/40 to-transparent"></div>
                        <div class="absolute bottom-6 right-6">
                            <div class="flex items-center gap-3 px-6 py-3 bg-white/10 backdrop-blur-xl border border-white/20 rounded-full text-white shadow-2xl">
                                <span class="w-2 h-2 rounded-full bg-primary-soft animate-pulse"></span>
                                <span class="text-xs font-bold uppercase tracking-[0.2em]">KARTALA SPIRIT 2024</span>
                            </div>
                        </div>
                    </div>
                    {{-- Decorative tag --}}
                    <div class="absolute -bottom-4 -left-4 bg-primary text-white p-6 rounded-2xl shadow-2xl transform -rotate-6 group-hover:rotate-0 transition-all">
                        <p class="text-2xl font-black italic tracking-tighter">PROGRESSIVE!</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    {{-- VISI MISI --}}
    <div class="py-24 bg-primary-dark text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1 bg-white/10 rounded-full text-primary-soft text-sm font-bold tracking-widest uppercase mb-4">Core Values</span>
                <h2 class="text-3xl sm:text-5xl font-extrabold mb-4">Visi & Misi Kabinet</h2>
                <div class="w-24 h-1.5 bg-primary-soft mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                {{-- Visi --}}
                <div class="bg-white/5 backdrop-blur-md p-10 rounded-[2.5rem] border border-white/10 shadow-2xl">
                    <div class="w-16 h-16 bg-primary-soft rounded-lg flex items-center justify-center mb-8 shadow-lg shadow-primary-soft/20 transform -rotate-3">
                        <x-heroicon-o-eye class="h-8 w-8 text-primary-dark" />
                    </div>
                    <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                        Visi Utama
                        <span class="h-px flex-1 bg-gradient-to-r from-white/20 to-transparent"></span>
                    </h3>
                    <p class="text-xl text-primary-soft italic font-medium leading-relaxed">
                        "Mewujudkan HMTIF UNPAS sebagai organisasi yang adaptif, edukatif, dan inspiratif dalam membangun harmoni serta kemajuan Teknik Informatika."
                    </p>
                </div>

                {{-- Misi --}}
                <div class="bg-white/5 backdrop-blur-md p-10 rounded-[2.5rem] border border-white/10 shadow-2xl">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-8 shadow-lg transform rotate-3">
                        <x-heroicon-o-rocket-launch class="h-8 w-8 text-primary-dark" />
                    </div>
                    <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                        Misi Strategis
                        <span class="h-px flex-1 bg-gradient-to-r from-white/20 to-transparent"></span>
                    </h3>
                    <ul class="space-y-4">
                        @foreach([
                            'Mengoptimalkan wadah aspirasi dan pengembangan minat bakat mahasiswa.',
                            'Membangun budaya organisasi yang berlandaskan kekeluargaan dan profesionalisme.',
                            'Meningkatkan kolaborasi internal dan eksternal demi kemajuan almamater.'
                        ] as $misi)
                        <li class="flex items-start gap-4 text-gray-300">
                            <div class="mt-1.5 w-2 h-2 bg-primary-soft rounded-full shrink-0 shadow-sm shadow-primary-soft"></div>
                            <span class="leading-relaxed">{{ $misi }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- AGENDA TERDEKAT (KEGIATAN PREVIEW) --}}
    <div class="py-24 bg-section/30 relative overflow-hidden">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div class="max-w-2xl">
                    <x-atoms.section-title>Agenda Terdekat</x-atoms.section-title>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-heading mt-4 leading-tight uppercase italic tracking-tighter">
                        Jangan Lewatkan <span class="text-primary text-2xl md:text-4xl">Momentum Seru Kami</span>
                    </h3>
                </div>
                <a href="/activities" class="group flex items-center gap-2 text-primary font-bold hover:gap-4 transition-all">
                    Lihat Semua Kegiatan
                    <x-heroicon-o-arrow-right class="size-5" />
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ([
                    ['title' => 'Informatics Championship', 'date' => '24 Mei 2024', 'type' => 'Internal', 'image' => 'https://images.unsplash.com/photo-1511512578047-dfb367046420?q=80&w=2070&auto=format&fit=crop'],
                    ['title' => 'Webinar Tech Update', 'date' => '12 Juni 2024', 'type' => 'Akademik', 'image' => 'https://images.unsplash.com/photo-1540575861501-7c00117fc9f3?q=80&w=2070&auto=format&fit=crop'],
                    ['title' => 'Abdi Masyarakat', 'date' => '15 Juli 2024', 'type' => 'Eksternal', 'image' => 'https://images.unsplash.com/photo-1509099836639-18ba1795216d?q=80&w=2062&auto=format&fit=crop']
                ] as $item)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:-translate-y-2 transition-all duration-500">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $item['image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $item['title'] }}">
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/90 backdrop-blur-md text-primary text-[10px] font-black uppercase tracking-widest rounded-lg shadow-sm border border-primary/10 italic">
                                    {{ $item['type'] }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-2">
                                <x-heroicon-o-calendar class="size-3" />
                                {{ $item['date'] }}
                            </div>
                            <h4 class="text-xl font-bold text-heading group-hover:text-primary transition-colors italic uppercase tracking-tighter mb-4">{{ $item['title'] }}</h4>
                            <a href="/activities" class="text-sm font-bold text-gray-400 group-hover:text-primary flex items-center gap-1 transition-all">
                                Detail Info
                                <x-heroicon-o-chevron-right class="size-4 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- INFORMASI TERKINI (PENGUMUMAN PREVIEW) --}}
    <div class="py-24 bg-white relative overflow-hidden">
        {{-- Decorative SVG --}}
        <div class="absolute top-0 right-0 h-full w-1/3 opacity-5 pointer-events-none">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M100 0 L100 100 L0 100 Z" fill="currentColor" class="text-primary" />
            </svg>
        </div>

        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10">
            <div class="text-center mb-16">
                <x-atoms.section-title align="center">Informasi Terkini</x-atoms.section-title>
                <h2 class="text-3xl md:text-5xl font-extrabold text-heading mt-4 italic uppercase tracking-tighter">
                    Pengumuman <span class="text-primary">Penting & Terbaru</span>
                </h2>
                <div class="w-24 h-1 bg-primary/20 mx-auto mt-6 rounded-full overflow-hidden">
                    <div class="w-12 h-full bg-primary animate-pulse"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @foreach ([
                    ['title' => 'Pendaftaran Lomba Internal Kartala 2024 Telah Dibuka!', 'date' => '05 Apr 2024', 'cat' => 'Akademik', 'color' => 'blue'],
                    ['title' => 'Update Jadwal Rapat Pleno Kabinet Semester Genap', 'date' => '02 Apr 2024', 'cat' => 'Organisasi', 'color' => 'primary'],
                ] as $news)
                    <div class="group flex flex-col sm:flex-row items-center gap-6 p-6 rounded-[2rem] bg-gray-50/50 border border-gray-100 hover:bg-white hover:shadow-2xl hover:border-primary/20 transition-all duration-500">
                        <div class="shrink-0 w-20 h-20 bg-white rounded-2xl shadow-lg flex flex-col items-center justify-center border border-gray-50 group-hover:bg-primary group-hover:text-white transition-all transform group-hover:-rotate-6">
                            <span class="text-2xl font-black italic">{{ explode(' ', $news['date'])[0] }}</span>
                            <span class="text-[10px] uppercase font-bold tracking-widest">{{ explode(' ', $news['date'])[1] }}</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="px-3 py-0.5 rounded-full bg-{{ $news['color'] === 'primary' ? 'primary' : 'blue-500' }}/10 text-{{ $news['color'] === 'primary' ? 'primary' : 'blue-600' }} text-[10px] font-bold uppercase tracking-widest border border-{{ $news['color'] === 'primary' ? 'primary' : 'blue-500' }}/10">
                                    {{ $news['cat'] }}
                                </span>
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Terkonfirmasi</span>
                            </div>
                            <h4 class="text-xl font-bold text-heading group-hover:text-primary transition-colors leading-tight mb-2 italic uppercase tracking-tighter">{{ $news['title'] }}</h4>
                            <p class="text-sm text-gray-400 line-clamp-1">Klik untuk membaca rincian pengumuman secara lengkap...</p>
                        </div>
                        <div class="shrink-0">
                            <a href="/announcements" class="w-12 h-12 rounded-full border border-gray-100 flex items-center justify-center text-gray-300 group-hover:bg-primary group-hover:text-white group-hover:border-primary transition-all">
                                <x-heroicon-o-arrow-right class="size-5" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <x-atoms.button variant="outline" class="group h-14 px-10 rounded-full border-gray-200 text-heading hover:border-primary hover:text-primary transition-all" onclick="window.location.href='/announcements'">
                    <span>Lihat Seluruh Arsip</span>
                    <x-heroicon-o-document-duplicate class="size-5 opacity-50 group-hover:opacity-100 transition-opacity" />
                </x-atoms.button>
            </div>
        </div>
    </div>

    <!-- ABOUT KABINET (Statistik) -->
    <div class="py-24 bg-section relative overflow-hidden">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl text-center mb-20">
            <x-atoms.section-title align="center">
                Pergerakan Kami
            </x-atoms.section-title>
            <h2 class="text-3xl sm:text-4xl font-bold text-heading mt-4">Kekuatan Kolektif Kabinet Kartala</h2>
            <p class="text-gray-500 max-w-2xl mx-auto mt-6 text-lg">
                Melalui semangat "Kartala", kami bergerak bersama untuk menghadirkan perubahan nyata melalui program kerja yang terukur.
            </p>
        </div>

        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <x-molecules.stats.stat-card label="Pengurus Aktif" value="31+" icon="users" />
                <x-molecules.stats.stat-card label="Agenda Proker" value="12+" icon="calendar" />
                <x-molecules.stats.stat-card label="Departemen" value="5" icon="puzzle" />
                <x-molecules.stats.stat-card label="Anggota Himpunan" value="300+" icon="academic" />
            </div>
        </div>
    </div>
</x-layout>
