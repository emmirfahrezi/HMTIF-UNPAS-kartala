<footer class="bg-gradient-to-br from-[#0a1f12] to-[#163a21] text-gray-300 py-16">
    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            {{-- Brand Section --}}
            <div class="md:col-span-2 space-y-6">
                <a href="/" class="flex items-center gap-3">
                    <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=emerald&shade=400" alt="Logo"
                        class="h-10 w-auto brightness-125" />
                    <h2 class="font-extrabold text-2xl tracking-tight text-white flex items-center gap-2">
                        HMTIF-UNPAS <span class="text-white/40 font-light prose-sm">|</span> <span
                            class="text-emerald-400 font-medium">Kartala</span>
                    </h2>
                </a>
                <p class="text-white/70 max-w-sm leading-relaxed">
                    Wadah aspirasi dan pengembangan diri mahasiswa Teknik Informatika Universitas Pasundan. Harmonis,
                    Transparan, Inspiratif, dan Fokus.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="p-2 bg-white/10 rounded-lg hover:bg-primary transition-colors">
                        <x-heroicon-s-chat-bubble-left-right class="h-5 w-5" />
                    </a>
                    <a href="#" class="p-2 bg-white/10 rounded-lg hover:bg-primary transition-colors">
                        <x-heroicon-s-globe-alt class="h-5 w-5" />
                    </a>
                </div>
            </div>

            {{-- Links --}}
            <div>
                <h4 class="font-bold text-lg mb-6">Navigasi</h4>
                <ul class="space-y-4 text-white/70">
                    <li><a href="/" class="hover:text-primary transition-colors">Beranda</a></li>
                    <li><a href="/staff" class="hover:text-primary transition-colors">Pengurus</a></li>
                    <li><a href="/activities" class="hover:text-primary transition-colors">Kegiatan</a></li>
                    <li><a href="/store" class="hover:text-primary transition-colors">Store</a></li>
                    <li><a href="/announcements" class="hover:text-primary transition-colors">Pengumuman</a></li>
                    <li><a href="/aspirations" class="hover:text-primary transition-colors">Aspirasi</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-bold text-lg mb-6">Kontak</h4>
                <ul class="space-y-4 text-white/70 text-sm">
                    <li class="flex items-start gap-3">
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