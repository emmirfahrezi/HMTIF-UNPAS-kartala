    {{-- Main Article Content --}}
    <div class="lg:col-span-2 space-y-12 reveal reveal-up">
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
