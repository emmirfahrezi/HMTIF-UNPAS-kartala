<x-layout 
    title="Detail Kegiatan | HMTIF UNPAS" 
    description="Lihat rincian lengkap kegiatan HMTIF UNPAS. Informasi waktu, lokasi, deskripsi acara, dan pendaftaran peserta untuk program kerja Informatika."
    keywords="Detail Acara HMTIF, Info Kegiatan Informatika, Event Mahasiswa UNPAS"
    :transparent="false"
>
    {{-- Hero Section --}}
    <section class="relative pt-20 pb-6 overflow-hidden bg-white">
        <div class="absolute inset-0 z-0 opacity-10">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 0 L100 0 L100 100 L0 100 Z" fill="none" stroke="currentColor" stroke-width="1"
                    class="text-primary" />
                <path d="M0 0 L100 100" stroke="currentColor" stroke-width="0.5" class="text-primary" />
            </svg>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col items-start gap-4 mb-8">
                <a href="/activities" class="flex items-center gap-2 text-primary font-bold text-sm hover:translate-x-1 transition-transform group">
                    <x-heroicon-o-arrow-left class="size-4" />
                    Kembali ke Kegiatan
                </a>
                <span class="px-4 py-1.5 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.2em]">Internal • Bidang PSDM</span>
            </div>
            
            <h1 class="text-2xl md:text-4xl font-black text-heading mb-6 uppercase italic tracking-tighter leading-tight max-w-4xl">
                Musyawarah Besar <span class="text-primary">HMTIF 2026</span>
            </h1>
            
            <div class="flex flex-wrap gap-6 text-sm font-medium text-body/60">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-calendar class="size-5 text-primary" />
                    15 April 2026
                </div>
                <div class="flex items-center gap-2">
                    <x-heroicon-o-map-pin class="size-5 text-primary" />
                    Aula Lantai 2, Kampus IV UNPAS
                </div>
            </div>
        </div>
    </section>

    {{-- Content Section --}}
    <section class="pb-24 bg-section/30">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mt-8">
                {{-- Main Image & Description --}}
                <div class="lg:col-span-2 space-y-10">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-video border-8 border-white">
                        <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846" alt="Poster Utama Kegiatan HMTIF UNPAS" class="w-full h-full object-cover">
                    </div>
                    
                    <div class="prose prose-lg max-w-none text-body leading-relaxed space-y-6">
                        <p class="font-bold text-xl text-heading italic uppercase tracking-tighter">
                            Transformasi Kepemimpinan untuk Informatika yang Progresif.
                        </p>
                        <p>
                            Musyawarah Besar (MUBES) HMTIF UNPAS merupakan agenda tahunan tertinggi dalam organisasi yang bertujuan untuk mengevaluasi kinerja kepengurusan selama satu tahun periode, merumuskan AD/ART, serta memilih Ketua Umum baru untuk periode mendatang.
                        </p>
                        <p>
                            Penyampaian LPJ (Laporan Pertanggung Jawaban) dari setiap bidang akan menjadi fokus utama dalam rangkaian acara ini. Diskusi yang konstruktif diharapkan dapat melahirkan inovasi-inovasi baru bagi perkembangan mahasiswa Informatika UNPAS di kancah nasional maupun internasional.
                        </p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-10 font-bold italic uppercase tracking-tighter text-sm">
                            <div class="p-6 bg-white rounded-2xl border border-border shadow-sm flex items-center gap-4">
                                <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                                    <x-heroicon-o-user-group class="size-6" />
                                </div>
                                Terbuka untuk seluruh anggota
                            </div>
                            <div class="p-6 bg-white rounded-2xl border border-border shadow-sm flex items-center gap-4">
                                <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                                    <x-heroicon-o-academic-cap class="size-6" />
                                </div>
                                Poin Keaktifan Mahasiswa (PKM)
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar Info --}}
                <div class="space-y-8">
                    <div class="bg-primary-dark rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-primary opacity-20 rounded-full -mr-16 -mt-16 blur-3xl group-hover:opacity-40 transition-opacity"></div>
                        
                        <h4 class="font-black text-xl mb-6 italic uppercase tracking-tighter">Detail Acara</h4>
                        <ul class="space-y-6 relative z-10">
                            <li class="flex flex-col gap-1">
                                <span class="text-[10px] text-white/40 uppercase font-black tracking-widest leading-none">Waktu</span>
                                <span class="font-bold">08.00 - Selesai WIB</span>
                            </li>
                            <li class="flex flex-col gap-1">
                                <span class="text-[10px] text-white/40 uppercase font-black tracking-widest leading-none">Lokasi</span>
                                <span class="font-bold leading-tight">Gedung Mandala, Kampus IV Universitas Pasundan</span>
                            </li>
                            <li class="flex flex-col gap-1">
                                <span class="text-[10px] text-white/40 uppercase font-black tracking-widest leading-none">Dresscode</span>
                                <span class="font-bold">Almamater UNPAS</span>
                            </li>
                        </ul>
                        
                        <hr class="my-8 border-white/10">
                        
                        <a href="https://wa.me/#" class="block w-full py-4 bg-primary hover:bg-primary-soft text-white text-center rounded-xl font-black uppercase italic tracking-tighter transition-all shadow-xl shadow-primary/20 hover:-translate-y-1">
                            Pendaftaran Peserta
                        </a>
                    </div>
                    
                    <div class="bg-white rounded-3xl p-8 border border-border shadow-sm">
                        <h4 class="font-black text-xl mb-6 italic uppercase tracking-tighter text-heading">Narahubung</h4>
                        <div class="flex items-center gap-4">
                            <div class="size-12 rounded-full bg-section flex items-center justify-center text-primary">
                                <x-heroicon-o-chat-bubble-left-right class="size-6" />
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Sekretaris Umum</p>
                                <p class="font-black text-heading italic">+62 812-3456-7890</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
