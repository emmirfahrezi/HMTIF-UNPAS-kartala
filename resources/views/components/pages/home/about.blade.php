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
            <div class="relative group reveal reveal-left">
                <div class="absolute -inset-6 bg-primary/5 rounded-lg transform -rotate-3 group-hover:rotate-0 transition-all duration-700 ease-out"></div>
                <div id="bigPhoto" class="relative rounded-lg overflow-hidden shadow-lg aspect-[4/3] bg-center bg-cover transition-all duration-700 ease-in-out ring-1 ring-black/5 bg-gray-100"
                    style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200&auto=format&fit=crop');">
                    <div class="absolute bottom-6 left-6 flex gap-3 p-3 bg-white/30 backdrop-blur-xl rounded-lg border border-white/40 shadow-lg">
                        <div class="swap-box w-14 h-14 rounded-lg cursor-pointer shadow-lg hover:scale-110 transition-all outline-none ring-2 ring-transparent hover:ring-primary overflow-hidden"
                            data-img="https://images.unsplash.com/photo-1522071823991-b9671f903f75?q=80&w=900&auto=format&fit=crop">
                            <img src="https://images.unsplash.com/photo-1522071823991-b9671f903f75?q=80&w=900&auto=format&fit=crop" class="w-full h-full object-cover" alt="Suasana Kegiatan HMTIF" width="56" height="56" />
                        </div>
                        <div class="swap-box w-14 h-14 rounded-xl cursor-pointer shadow-inner hover:scale-110 transition-all outline-none ring-2 ring-transparent hover:ring-primary overflow-hidden"
                            data-img="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=900&auto=format&fit=crop">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=900&auto=format&fit=crop" class="w-full h-full object-cover" alt="Kolaborasi Mahasiswa Informatika" width="56" height="56" />
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
            <div class="space-y-8 reveal reveal-right">
                <div>
                    <x-atoms.section-title>Identitas & Harapan</x-atoms.section-title>
                    <h2 class="text-4xl font-extrabold text-heading mt-4 leading-tight">Himpunan Mahasiswa Teknik Informatika UNPAS</h2>
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
            <!-- BAGIAN KIRI (CONTENT) -->
            <div class="order-2 lg:order-1 space-y-8 reveal reveal-left">
                <div>
                    <x-atoms.section-title>Era Baru: Kartala</x-atoms.section-title>
                    <h2 class="text-4xl font-extrabold text-heading mt-4 leading-tight uppercase italic tracking-tighter">Harmoni Dalam <span class="text-primary italic">Pergerakan Nyata</span></h2>
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

            <!-- BAGIAN KANAN (FOTO) -->
            <div class="order-1 lg:order-2 relative group reveal reveal-right">
                <div class="absolute -inset-6 bg-primary-dark/5 rounded-full transform rotate-3 group-hover:rotate-0 transition-all duration-700 ease-out italic"></div>
                <div class="relative rounded-lg overflow-hidden shadow-2xl aspect-[4/3] transform group-hover:scale-[1.02] transition-all duration-500 animate-shimmer">
                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=1200&auto=format&fit=crop" 
                         alt="Kabinet Kartala Team" 
                         class="relative w-full h-full object-cover" 
                         loading="lazy"
                         width="800"
                         height="600">
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
