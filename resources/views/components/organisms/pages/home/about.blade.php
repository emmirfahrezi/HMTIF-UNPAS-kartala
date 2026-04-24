<!-- about HMTIF -->
<div class="py-24 bg-white relative overflow-hidden content-auto">
    {{-- Decorative background text --}}
    <div
        class="absolute -right-20 top-45 text-[12rem] font-black text-primary/5 -rotate-90 select-none pointer-events-none uppercase tracking-tighter">
        HMTIF
    </div>

    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10 space-y-32">
        <!-- SECTION 1: HMTIF UNPAS (Foto Kiri) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center content-auto">
            <!-- BAGIAN KIRI (FOTO) -->
            <div class="relative group reveal reveal-left">
                <div
                    class="relative mx-auto aspect-square w-full max-w-96 lg:max-w-120 overflow-hidden rounded-full transition-all duration-700 ease-in-out group-hover:-translate-y-1">
                    <img src="https://zbdknbyvmvbgsvmepdvk.supabase.co/storage/v1/object/public/images/rm-logo-hmtif-unpas.png"
                        alt="Logo HMTIF UNPAS"
                        class="relative z-10 h-full w-full object-contain transition-transform duration-700 group-hover:scale-[1.01]"
                        width="960" height="960" loading="lazy" decoding="async" />
                </div>
            </div>

            <!-- BAGIAN KANAN (CONTENT) -->
            <div class="space-y-8 reveal reveal-right">
                <div>
                    <x-atoms.pages.section-title>Identitas & Harapan</x-atoms.section-title>
                    <h2 class="text-4xl font-extrabold text-heading mt-4 leading-tight">Himpunan Mahasiswa Teknik
                        Informatika UNPAS</h2>
                </div>
                <p class="text-gray-600 text-lg leading-relaxed">
                    HMTIF Universitas Pasundan bukan sekadar organisasi mahasiswa. Kami adalah laboratorium kehidupan,
                    tempat di mana setiap mahasiswa Teknik Informatika menemukan potensi terbaiknya melalui kolaborasi,
                    riset, dan semangat kekeluargaan yang telah terjaga selama puluhan tahun.
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

        <!-- SECTION 2: HMTIF UNPAS (Foto Kanan) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <!-- BAGIAN KIRI (CONTENT) -->
            <div class="order-2 lg:order-1 space-y-8 reveal reveal-left">
                <div>
                    <x-atoms.pages.section-title>Era Baru: Kartala</x-atoms.section-title>
                    <h2
                        class="text-4xl font-extrabold text-heading mt-4 leading-tight uppercase italic tracking-tighter">
                        Harmoni Dalam <span class="text-primary italic">Pergerakan Nyata</span></h2>
                </div>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Di bawah semangat <strong>HMTIF UNPAS</strong>, kami berkomitmen untuk menghadirkan perubahan
                    yang progresif. Kartala bukan hanya soal nama, tapi soal bagaimana kami membangun harmoni di tengah
                    keberagaman, menginspirasi melalui dedikasi, dan mengeksekusi setiap program kerja dengan presisi.
                </p>
                <div class="space-y-4">
                    @foreach ([['icon' => 'bolt', 'title' => 'Agile & Adaptif', 'desc' => 'Cepat merespon tantangan di era digital yang semakin dinamis.'], ['icon' => 'sparkles', 'title' => 'Inovasi Tanpa Batas', 'desc' => 'Menghadirkan program kerja kreatif yang berdampak luas bagi civitas.']] as $item)
                        <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-gray-50 transition-colors group">
                            <div
                                class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
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
                <div
                    class="relative mx-auto aspect-square w-full max-w-96 lg:max-w-120 overflow-hidden rounded-full transform transition-all duration-700 ease-out group-hover:scale-[1.01] group-hover:-translate-y-1">
                    <img src="https://zbdknbyvmvbgsvmepdvk.supabase.co/storage/v1/object/public/images/rm-logo-hmtif-unpas.png"
                        alt="Logo HMTIF UNPAS"
                        class="relative z-10 h-full w-full object-contain transition-transform duration-700 group-hover:scale-[1.01]"
                        loading="lazy" decoding="async" width="960" height="960">
                </div>
            </div>
        </div>
    </div>
</div>
