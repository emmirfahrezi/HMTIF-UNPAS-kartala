<footer
    class="bg-linear-to-br from-[#04110a] via-[#0a1f12] to-primary-dark text-white/80 py-16 border-t border-secondary/10">
    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            {{-- Brand Section --}}
            <div class="md:col-span-2 space-y-6">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/placeholders/logo.svg') }}" alt="Logo HMTIF UNPAS"
                        class="h-10 w-auto brightness-125" />
                    <h2 class="font-extrabold text-2xl tracking-tight text-white flex items-center gap-2">
                        HMTIF-UNPAS
                    </h2>
                </a>
                <p class="text-white/70 max-w-sm leading-relaxed">
                    Wadah aspirasi dan pengembangan diri mahasiswa Teknik Informatika Universitas Pasundan. Harmonis,
                    Transparan, Inspiratif, dan Fokus.
                </p>
                <div class="flex gap-4">
                    <a href="#"
                        class="p-2 bg-white/10 rounded-lg hover:bg-secondary hover:text-black transition-colors">
                        <x-heroicon-s-chat-bubble-left-right class="h-5 w-5" />
                    </a>
                    <a href="#"
                        class="p-2 bg-white/10 rounded-lg hover:bg-secondary hover:text-black transition-colors">
                        <x-heroicon-s-globe-alt class="h-5 w-5" />
                    </a>
                </div>
            </div>

            {{-- Links --}}
            <div>
                <h4 class="font-bold text-lg mb-6 text-base">Navigasi</h4>
                <ul class="space-y-4 text-white/70">
                    <li><a href="/" class="hover:text-secondary transition-colors">Beranda</a></li>
                    <li><a href="/staff" class="hover:text-secondary transition-colors">Pengurus</a></li>
                    <li><a href="/activities" class="hover:text-secondary transition-colors">Kegiatan</a></li>
                    <li><a href="/store" class="hover:text-secondary transition-colors">Store</a></li>
                    <li><a href="/announcements" class="hover:text-secondary transition-colors">Pengumuman</a></li>
                    <li><a href="/aspirations" class="hover:text-secondary transition-colors">Aspirasi</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-bold text-lg mb-6 text-base">Kontak</h4>
                <ul class="space-y-4 text-white/70 text-sm">
                    <li class="flex items-start gap-3">
                        <x-heroicon-o-map-pin class="h-5 w-5 text-primary-soft mt-0.5" />
                        Gedung B, Kampus IV Universitas Pasundan, Bandung.
                    </li>
                    <li class="flex items-center gap-3">
                        <x-heroicon-o-envelope class="h-5 w-5 text-primary-soft" />
                        hmtif@unpas.ac.id
                    </li>
                </ul>
            </div>
        </div>

        <hr class="border-white/10 mb-8">

        <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-white/50 text-xs">
            <p>&copy; 2026 HMTIF Universitas Pasundan. All rights reserved.</p>
            <p class="flex items-center gap-1.5">
                Dibuat dengan
                <x-heroicon-s-heart class="size-3.5 text-red-500 animate-pulse" />
                oleh Tim IT Kartala
            </p>
        </div>
    </div>
</footer>
