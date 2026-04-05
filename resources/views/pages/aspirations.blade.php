<x-layout title="Kirim Aspirasi" :transparent="false">
    {{-- Hero Section --}}
    <section class="relative pt-28 pb-10 overflow-hidden bg-white">
        <div class="absolute inset-0 z-0 opacity-10">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 0 L100 0 L100 100 L0 100 Z" fill="none" stroke="currentColor" stroke-width="1"
                    class="text-primary" />
                <path d="M0 0 L100 100" stroke="currentColor" stroke-width="0.5" class="text-primary" />
            </svg>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span
                class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-[0.3em] uppercase mb-6 uppercase">Pusat
                Aspirasi</span>
            <h1 class="text-3xl md:text-5xl font-black text-heading mb-6 uppercase italic tracking-tighter">
                Suara <span class="text-primary">Kartala</span>
            </h1>
            <p class="text-body/40 max-w-2xl mx-auto text-lg lowercase tracking-widest font-light leading-relaxed">
                pintu terbuka untuk ide, kritik, dan keluhan demi kemajuan bersama. teknik informatika progresif.
            </p>
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
</x-layout>