{{-- Form Section --}}
<div class="pb-20 md:pb-24 bg-section/30">
    <div class="mx-auto px-6 lg:px-8 max-w-5xl mt-6 md:mt-8 relative z-20">
        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden relative reveal reveal-up">
            {{-- Decorative Background Elements --}}
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-primary/5 -mr-32 -mt-32 rounded-full blur-3xl pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 left-0 w-64 h-64 bg-primary/5 -ml-32 -mb-32 rounded-full blur-3xl pointer-events-none">
            </div>

            {{-- Form Header Accent --}}
            <div class="h-2 w-full bg-primary"></div>

            <div class="p-6 sm:p-10 lg:p-14 relative z-10">
                <div
                    class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 border-b border-gray-50 pb-8">
                    <div>
                        <h2 class="text-3xl font-black text-heading uppercase italic tracking-tighter mb-2">Form <span
                                class="text-primary">Aspirasi</span></h2>
                        <p class="text-body/60 text-sm italic font-medium uppercase tracking-widest text-[10px]">
                            Lengkapi data di bawah untuk menyampaikan suaramu</p>
                    </div>
                    <div class="flex items-center gap-3 px-4 py-2 bg-section rounded-xl border border-border">
                        <div class="w-2 h-2 rounded-full bg-primary animate-pulse"></div>
                        <span class="text-[10px] font-black text-heading uppercase tracking-widest leading-none">Status:
                            Open</span>
                    </div>
                </div>

                <form action="#" method="POST" class="space-y-10 md:space-y-12">
                    @csrf
                    {{-- Section 1: Identitas --}}
                    <div class="space-y-8">
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="flex items-center justify-center w-6 h-6 rounded bg-primary text-white text-[10px] font-black italic">01</span>
                            <h3 class="text-xs font-black text-heading uppercase tracking-[0.2em]">Data Identitas</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Nama --}}
                            <div class="space-y-3">
                                <label for="nama"
                                    class="text-[10px] font-black text-gray-400 uppercase tracking-widest block pl-1">Nama
                                    Lengkap</label>
                                <x-atoms.input id="nama" name="nama" placeholder="Masukkan nama lengkap kamu"
                                    class="rounded-2xl py-4 border-gray-100 bg-section/50 focus:bg-white focus:ring-primary/20 transition-all" />
                            </div>

                            {{-- NIM --}}
                            <div class="space-y-3">
                                <label for="nim"
                                    class="text-[10px] font-black text-gray-400 uppercase tracking-widest block pl-1">NIM
                                    Mahasiswa</label>
                                <x-atoms.input id="nim" name="nim" placeholder="Contoh: 213040001"
                                    class="rounded-2xl py-4 border-gray-100 bg-section/50 focus:bg-white focus:ring-primary/20 transition-all" />
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="space-y-3">
                            <label for="email"
                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest block pl-1">Email
                                Mahasiswa</label>
                            <x-atoms.input type="email" id="email" name="email"
                                placeholder="nama@mail.unpas.ac.id"
                                class="rounded-2xl py-4 border-gray-100 bg-section/50 focus:bg-white focus:ring-primary/20 transition-all" />
                        </div>
                    </div>

                    {{-- Section 2: Aspirasi --}}
                    <div class="space-y-8">
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="flex items-center justify-center w-6 h-6 rounded bg-primary text-white text-[10px] font-black italic">02</span>
                            <h3 class="text-xs font-black text-heading uppercase tracking-[0.2em]">Suara Mahasiswa</h3>
                        </div>

                        {{-- Perihal --}}
                        <div class="space-y-3">
                            <label for="perihal"
                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest block pl-1">Perihal</label>
                            <x-atoms.input id="perihal" name="perihal"
                                placeholder="Contoh: Fasilitas Lab, Agenda Organisasi, Layanan Akademik"
                                class="rounded-2xl py-4 border-gray-100 bg-section/50 focus:bg-white focus:ring-primary/20 transition-all" />
                        </div>

                        {{-- Pesan --}}
                        <div class="space-y-3">
                            <label for="pesan"
                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest block pl-1">Isi
                                Aspirasi</label>
                            <textarea id="pesan" rows="6"
                                class="w-full px-6 py-6 bg-section/50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all duration-500 placeholder:text-body/30 text-heading font-bold leading-relaxed shadow-inner"
                                placeholder="Ceritakan aspirasimu secara detail di sini..."></textarea>
                        </div>
                    </div>

                    {{-- Submit Section --}}
                    <div
                        class="pt-8 md:pt-10 flex flex-col sm:flex-row items-center justify-between gap-6 md:gap-8 border-t border-gray-50 mt-12 md:mt-16">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary shrink-0">
                                <x-heroicon-o-shield-check class="size-6" />
                            </div>
                            <p
                                class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-relaxed max-w-xs">
                                <span class="text-primary">Privasi Terjamin.</span><br>
                                Data kamu akan dijaga kerahasiaannya oleh tim advokasi HMTIF UNPAS.
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                            <x-atoms.button variant="primary"
                                class="px-12 py-4 rounded-xl font-black text-base shadow-xl shadow-primary/20 transform hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                                Kirim Aspirasi
                                <x-heroicon-o-paper-airplane class="size-4" />
                            </x-atoms.button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
