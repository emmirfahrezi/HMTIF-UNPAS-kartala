<x-layout 
    title="Detail Pengumuman | HMTIF UNPAS" 
    description="Baca pengumuman resmi dan berita terbaru dari HMTIF UNPAS. Informasi terverifikasi mengenai akademik, organisasi, dan agenda penting."
    keywords="Info Penting HMTIF, Warta Terbaru Informatika, Pengumuman Mahasiswa"
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
                <a href="/announcements" class="flex items-center gap-2 text-primary font-bold text-sm hover:translate-x-1 transition-transform group">
                    <x-heroicon-o-arrow-left class="size-4" />
                    Kembali ke Pengumuman
                </a>
                <span class="px-4 py-1.5 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.2em]">Penting • Akademik</span>
            </div>
            
            <h1 class="text-2xl md:text-4xl font-black text-heading mb-6 uppercase italic tracking-tighter leading-tight max-w-5xl">
                Musyawarah Besar <span class="text-primary">HMTIF 2026:</span> Panggilan Untuk Delegasi
            </h1>
            
            <div class="flex flex-wrap gap-6 text-sm font-medium text-body/60">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-calendar class="size-5 text-primary" />
                    Terbit: 05 April 2026
                </div>
                <div class="flex items-center gap-2">
                    <x-heroicon-o-clock class="size-5 text-primary" />
                    3 Menit Baca
                </div>
            </div>
        </div>
    </section>

    {{-- Content Section --}}
    <section class="pb-24 bg-section/30 min-h-screen">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mt-8">
                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-12">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[16/9] border-8 border-white bg-white">
                        <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846" alt="Thumbnail Pengumuman Resmi HMTIF UNPAS" class="w-full h-full object-cover">
                    </div>
                    
                    <div class="prose prose-lg max-w-none text-body leading-relaxed space-y-6">
                        <p class="font-bold text-xl text-heading italic uppercase tracking-tighter">
                            Bersiaplah untuk menentukan masa depan Himpunan kita.
                        </p>
                        <p>
                            Diberitahukan kepada seluruh mahasiswa Teknik Informatika Universitas Pasundan bahwa pendaftaran delegasi untuk Musyawarah Besar (MUBES) HMTIF 2026 telah resmi dibuka. Agenda besar ini akan menentukan arah gerak himpunan untuk periode satu tahun ke depan.
                        </p>
                        <h3>Syarat & Ketentuan Delegasi:</h3>
                        <ul>
                            <li>Mahasiswa Aktif Teknik Informatika UNPAS.</li>
                            <li>Telah menempuh minimal 2 semester.</li>
                            <li>Memiliki kepedulian tinggi terhadap kemajuan organisasi.</li>
                            <li>Mengisi formulir komitmen kehadiran selama rangkaian acara.</li>
                        </ul>
                        <p>
                            Mubes bukan sekadar formalitas tahunan, melainkan ajang di mana setiap suara kalian dihargai. Inilah saatnya memberikan kontribusi nyata bagi almamater kita tercinta.
                        </p>
                    </div>
                    
                    <div class="pt-8 border-t border-gray-100 flex items-center gap-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Share ke teman:</span>
                        <div class="flex gap-2">
                            @foreach(['chat-bubble-bottom-center-text', 'share'] as $icon)
                            <button class="size-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-primary hover:border-primary transition-all">
                                <x-dynamic-component :component="'heroicon-o-' . $icon" class="size-4" />
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-8">
                    <div class="bg-white rounded-3xl p-8 border border-border shadow-sm">
                        <h4 class="font-black text-xl mb-6 italic uppercase tracking-tighter text-heading">Info Terkait</h4>
                        <div class="space-y-6">
                            @foreach([
                                ['title' => 'Open Recruitment Panitia Makrab', 'date' => '02 MEI 2026'],
                                ['title' => 'Update Jadwal Rapat Pleno Kabinet', 'date' => '12 JUN 2026']
                            ] as $side)
                            <a href="#" class="group block">
                                <p class="text-[10px] text-primary font-black uppercase tracking-widest mb-1">{{ $side['date'] }}</p>
                                <h5 class="font-bold text-heading group-hover:text-primary transition-colors leading-tight">{{ $side['title'] }}</h5>
                            </a>
                            @endforeach
                        </div>
                        <a href="/announcements" class="block w-full mt-8 py-3 text-center text-sm font-bold text-gray-400 border border-gray-100 rounded-xl hover:bg-section transition-all">
                            Lihat Semua Info
                        </a>
                    </div>
                    
                    <div class="bg-primary rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <h4 class="font-black text-xl mb-4 italic uppercase tracking-tighter">Butuh Bantuan?</h4>
                        <p class="text-white/80 text-sm mb-6 leading-relaxed italic">Hubungi bidang Hubungan Masyarakat jika ada pertanyaan terkait info ini.</p>
                        <a href="#" class="inline-flex items-center gap-2 font-black text-white uppercase italic tracking-widest text-xs group-hover:gap-4 transition-all">
                            Chat Admin
                            <x-heroicon-o-arrow-right class="size-4" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
