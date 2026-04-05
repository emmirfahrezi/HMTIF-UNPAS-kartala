<x-layout title="Kirim Aspirasi" :transparent="false">
    {{-- Hero Section --}}
    <section class="relative pt-40 pb-24 overflow-hidden bg-white">
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
            <h1 class="text-4xl md:text-7xl font-black text-heading mb-6 uppercase italic tracking-tighter">
                Suara <span class="text-primary">Kartala</span>
            </h1>
            <p class="text-body/40 max-w-2xl mx-auto text-lg lowercase tracking-widest font-light leading-relaxed">
                pintu terbuka untuk ide, kritik, dan keluhan demi kemajuan bersama. teknik informatika progresif.
            </p>
        </div>
    </section>

    {{-- Form Section --}}
    <div class="pb-32 bg-section/30 min-h-screen">
        <div class="mx-auto px-6 lg:px-8 max-w-5xl -mt-10 relative z-20">
            {{-- Form Card --}}
            <div class="bg-white rounded-lg shadow-2xl border border-gray-100 overflow-hidden">
                {{-- Form Header Accent --}}
                <div class="h-1.5 w-full bg-gradient-to-r from-primary to-primary-soft"></div>

                <div class="p-8 sm:p-16">
                    <form action="#" method="POST" class="space-y-10 group/form">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            {{-- Nama --}}
                            <div class="space-y-2">
                                <label for="nama"
                                    class="text-xs font-black text-gray-400 uppercase tracking-widest block pl-1">Nama
                                    Lengkap</label>
                                <x-atoms.input id="nama" name="nama" placeholder="Masukkan nama lengkap kamu"
                                    class="rounded-lg py-4 border-gray-100 focus:ring-primary/20" />
                            </div>

                            {{-- NIM --}}
                            <div class="space-y-2">
                                <label for="nim"
                                    class="text-xs font-black text-gray-400 uppercase tracking-widest block pl-1">NIM
                                    Mahasiswa</label>
                                <x-atoms.input id="nim" name="nim" placeholder="Contoh: 213040001"
                                    class="rounded-lg py-4 border-gray-100 focus:ring-primary/20" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            {{-- Email --}}
                            <div class="space-y-2">
                                <label for="email"
                                    class="text-xs font-black text-gray-400 uppercase tracking-widest block pl-1">Email
                                    Mahasiswa</label>
                                <x-atoms.input type="email" id="email" name="email" placeholder="nama@mail.unpas.ac.id"
                                    class="rounded-lg py-4 border-gray-100 focus:ring-primary/20" />
                            </div>

                            {{-- Tujuan --}}
                            <div class="space-y-2">
                                <label for="tujuan"
                                    class="text-xs font-black text-gray-400 uppercase tracking-widest block pl-1">Tujuan
                                    Aspirasi</label>
                                <div class="relative group/select">
                                    <select id="tujuan"
                                        class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all duration-300 text-heading font-black italic uppercase tracking-tighter appearance-none">
                                        <option value="">Pilih Unit/Bidang...</option>
                                        <option value="himpunan">Ketua Himpunan</option>
                                        <option value="akademik">Bidang Akademik</option>
                                        <option value="minat_bakat">Bidang Minat & Bakat</option>
                                        <option value="sosial">Bidang Sosial & Komunikasi</option>
                                    </select>
                                    <div
                                        class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400 group-hover/select:text-primary transition-colors">
                                        <x-heroicon-o-chevron-down class="size-5" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Pesan --}}
                        <div class="space-y-2">
                            <label for="pesan"
                                class="text-xs font-black text-gray-400 uppercase tracking-widest block pl-1">Isi
                                Aspirasi</label>
                            <textarea id="pesan" rows="8"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all duration-300 placeholder:text-body/40 text-heading font-bold leading-relaxed shadow-inner"
                                placeholder="Ceritakan aspirasimu secara detail di sini..."></textarea>
                        </div>

                        {{-- Submit --}}
                        <div
                            class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-8 border-t border-gray-50 pt-10">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 bg-primary/5 rounded-lg flex items-center justify-center text-primary shrink-0">
                                    <x-heroicon-o-shield-check class="size-6" />
                                </div>
                                <p
                                    class="text-[11px] text-gray-400 font-bold uppercase tracking-wider leading-relaxed max-w-xs">
                                    * Data kamu akan dijaga kerahasiaannya oleh tim advokasi HMTIF UNPAS.
                                </p>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                                <x-atoms.button variant="outline"
                                    class="px-10 py-4 py-4 rounded-lg font-bold border-gray-100 hover:border-red-500 hover:text-red-500 transition-all shadow-sm">
                                    Batal
                                </x-atoms.button>
                                <x-atoms.button variant="primary"
                                    class="px-16 py-4 rounded-lg font-black text-lg shadow-xl shadow-primary/30 transform hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                                    Kirim Sekarang
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