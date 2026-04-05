<x-layout 
    title="Kirim Aspirasi | HMTIF UNPAS" 
    description="Sampaikan aspirasi, kritik, dan saran Anda untuk kemajuan HMTIF UNPAS. Suara mahasiswa Teknik Informatika sangat berarti bagi perbaikan kualitas organisasi."
    keywords="Aspirasi Mahasiswa, Kritik Saran HMTIF, Suara Kartala, Teknik Informatika UNPAS"
    :transparent="false"
>
    {{-- Hero Section --}}
    <x-molecules.sections.page-hero 
        badge="Suara Mahasiswa"
        title="Suara"
        highlight="Kartala"
        description="pintu terbuka untuk ide, kritik, dan keluhan demi kemajuan bersama. teknik informatika progresif."
    />
    
    {{-- Track Aspiration (Mockup) --}}
    <section class="py-12 bg-white relative">
        <div class="mx-auto px-6 lg:px-8 max-w-4xl">
            <div class="bg-primary-dark rounded-[2.5rem] p-8 md:p-12 shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary rounded-full opacity-10 -mr-32 -mt-32 blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="text-center md:text-left">
                        <h2 class="text-2xl font-black text-white italic uppercase tracking-tighter">Sudah Kirim <span class="text-primary-soft">Aspirasi?</span></h2>
                        <p class="text-white/50 text-sm mt-2">Masukkan NIM kamu untuk memantau status tindak lanjut.</p>
                    </div>
                    <div class="w-full md:w-auto flex flex-col sm:flex-row gap-3">
                         <input type="text" placeholder="Masukkan NIM kamu..." 
                            class="px-6 py-4 bg-white/10 border border-white/20 rounded-2xl text-white placeholder:text-white/30 focus:outline-none focus:ring-4 focus:ring-primary/20 transition-all font-bold tracking-widest text-sm">
                         <button class="px-8 py-4 bg-primary text-white rounded-2xl font-black text-sm hover:shadow-2xl hover:-translate-y-1 transition-all">
                            Cek Status
                         </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Form Section --}}
    <div class="pb-32 bg-section/30 min-h-screen">
        <div class="mx-auto px-6 lg:px-8 max-w-5xl mt-8 relative z-20">
            {{-- Form Card --}}
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden relative">
                {{-- Decorative Background Elements --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 -mr-32 -mt-32 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/5 -ml-32 -mb-32 rounded-full blur-3xl pointer-events-none"></div>

                {{-- Form Header Accent --}}
                <div class="h-2 w-full bg-primary"></div>

                <div class="p-8 sm:p-16 relative z-10">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 border-b border-gray-50 pb-8">
                        <div>
                            <h2 class="text-3xl font-black text-heading uppercase italic tracking-tighter mb-2">Form <span class="text-primary">Aspirasi</span></h2>
                            <p class="text-body/60 text-sm italic font-medium uppercase tracking-widest text-[10px]">Lengkapi data di bawah untuk menyampaikan suaramu</p>
                        </div>
                        <div class="flex items-center gap-3 px-4 py-2 bg-section rounded-xl border border-border">
                            <div class="w-2 h-2 rounded-full bg-primary animate-pulse"></div>
                            <span class="text-[10px] font-black text-heading uppercase tracking-widest leading-none">Status: Open</span>
                        </div>
                    </div>

                    <form action="#" method="POST" class="space-y-12">
                        @csrf
                        {{-- Section 1: Identitas --}}
                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="flex items-center justify-center w-6 h-6 rounded bg-primary text-white text-[10px] font-black italic">01</span>
                                <h3 class="text-xs font-black text-heading uppercase tracking-[0.2em]">Data Identitas</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                {{-- Nama --}}
                                <div class="space-y-3">
                                    <label for="nama" class="text-[10px] font-black text-gray-400 uppercase tracking-widest block pl-1">Nama Lengkap</label>
                                    <x-atoms.input id="nama" name="nama" placeholder="Masukkan nama lengkap kamu"
                                        class="rounded-2xl py-4 border-gray-100 bg-section/50 focus:bg-white focus:ring-primary/20 transition-all" />
                                </div>

                                {{-- NIM --}}
                                <div class="space-y-3">
                                    <label for="nim" class="text-[10px] font-black text-gray-400 uppercase tracking-widest block pl-1">NIM Mahasiswa</label>
                                    <x-atoms.input id="nim" name="nim" placeholder="Contoh: 213040001"
                                        class="rounded-2xl py-4 border-gray-100 bg-section/50 focus:bg-white focus:ring-primary/20 transition-all" />
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="space-y-3">
                                <label for="email" class="text-[10px] font-black text-gray-400 uppercase tracking-widest block pl-1">Email Mahasiswa</label>
                                <x-atoms.input type="email" id="email" name="email" placeholder="nama@mail.unpas.ac.id"
                                    class="rounded-2xl py-4 border-gray-100 bg-section/50 focus:bg-white focus:ring-primary/20 transition-all" />
                            </div>
                        </div>

                        {{-- Section 2: Aspirasi --}}
                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="flex items-center justify-center w-6 h-6 rounded bg-primary text-white text-[10px] font-black italic">02</span>
                                <h3 class="text-xs font-black text-heading uppercase tracking-[0.2em]">Detail Aspirasi</h3>
                            </div>

                            {{-- Tujuan --}}
                            <div class="space-y-3">
                                <label for="tujuan" class="text-[10px] font-black text-gray-400 uppercase tracking-widest block pl-1">Tujuan Aspirasi</label>
                                <div class="relative group/select">
                                    <select id="tujuan"
                                        class="w-full px-6 py-4 bg-section/50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all duration-500 text-heading font-black italic uppercase tracking-tighter appearance-none cursor-pointer">
                                        <option value="">Pilih Unit/Bidang...</option>
                                        <option value="himpunan">Ketua Himpunan</option>
                                        <option value="akademik">Bidang Akademik</option>
                                        <option value="minat_bakat">Bidang Minat & Bakat</option>
                                        <option value="sosial">Bidang Sosial & Komunikasi</option>
                                    </select>
                                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400 group-hover/select:text-primary transition-colors">
                                        <x-heroicon-o-chevron-down class="size-5" />
                                    </div>
                                </div>
                            </div>

                            {{-- Pesan --}}
                            <div class="space-y-3">
                                <label for="pesan" class="text-[10px] font-black text-gray-400 uppercase tracking-widest block pl-1">Isi Aspirasi</label>
                                <textarea id="pesan" rows="6"
                                    class="w-full px-6 py-6 bg-section/50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all duration-500 placeholder:text-body/30 text-heading font-bold leading-relaxed shadow-inner"
                                    placeholder="Ceritakan aspirasimu secara detail di sini..."></textarea>
                            </div>
                        </div>

                        {{-- Submit Section --}}
                        <div class="pt-10 flex flex-col sm:flex-row items-center justify-between gap-8 border-t border-gray-50 mt-16">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary shrink-0">
                                    <x-heroicon-o-shield-check class="size-6" />
                                </div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-relaxed max-w-xs">
                                    <span class="text-primary">Privasi Terjamin.</span><br>
                                    Data kamu akan dijaga kerahasiaannya oleh tim advokasi HMTIF UNPAS.
                                </p>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                                <x-atoms.button variant="primary"
                                    class="px-20 py-5 rounded-2xl font-black text-lg shadow-2xl shadow-primary/20 transform hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                                    Kirim Aspirasi
                                    <x-heroicon-o-paper-airplane class="size-5" />
                                </x-atoms.button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Weekly Aspiration Spotlight --}}
    <section class="py-24 bg-white">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12 mb-16">
                <div class="max-w-2xl">
                    <span class="inline-block px-4 py-1 bg-primary/10 rounded-full text-primary text-[10px] font-black uppercase tracking-[0.3em] mb-4">Advokasi Kartala</span>
                    <h2 class="text-3xl md:text-5xl font-black text-heading italic uppercase tracking-tighter">Aspirasi <span class="text-primary underline decoration-primary/20">Pekan Ini</span></h2>
                    <p class="text-gray-500 mt-6 text-lg">Topik-topik krusial yang sedang diperjuangkan oleh Tim Advokasi Himpunan berdasarkan suara terbanyak.</p>
                </div>
                <div class="shrink-0 flex items-center gap-3 px-6 py-3 bg-section rounded-2xl border border-border">
                    <div class="w-3 h-3 rounded-full bg-red-500 animate-ping"></div>
                    <span class="text-xs font-black text-heading uppercase tracking-widest italic">Live Advocacy Update</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach([
                    ['title' => 'Perbaikan Fasilitas Lab', 'votes' => '124', 'status' => 'Sedang Diproses', 'icon' => 'server'],
                    ['title' => 'Pengadaan Lisensi Software', 'votes' => '89', 'status' => 'Negosiasi Prodi', 'icon' => 'code-bracket'],
                    ['title' => 'Beasiswa Internal Himpunan', 'votes' => '210', 'status' => 'Tahap Pengajuan', 'icon' => 'academic-cap'],
                ] as $topik)
                <div class="bg-section p-10 rounded-[3rem] border border-border hover:bg-white hover:shadow-2xl transition-all duration-500 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700"></div>
                    
                    <div class="flex items-center justify-between gap-4 mb-10">
                        <div class="w-14 h-14 bg-white rounded-2xl shadow-lg flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all transform group-hover:rotate-12">
                            <x-dynamic-component :component="'heroicon-o-' . $topik['icon']" class="size-7" />
                        </div>
                        <div class="text-right">
                            <span class="text-3xl font-black text-heading tracking-tighter">{{ $topik['votes'] }}</span>
                            <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest block">Suara Mendukung</span>
                        </div>
                    </div>

                    <h4 class="text-2xl font-black text-heading mb-6 italic uppercase tracking-tighter group-hover:text-primary transition-colors leading-tight">{{ $topik['title'] }}</h4>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-primary animate-pulse"></div>
                        <span class="text-[10px] text-primary font-black uppercase tracking-widest">{{ $topik['status'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>