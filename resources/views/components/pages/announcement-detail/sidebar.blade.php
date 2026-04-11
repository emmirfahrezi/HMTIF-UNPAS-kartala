@php
    $relatedAnnouncements = \App\Models\Announcement::query()->latest('published_at')->take(3)->get();
@endphp

{{-- Detail Sidebar --}}
<div class="space-y-8 reveal reveal-right">
    <div class="bg-white rounded-3xl p-8 border border-border shadow-sm">
        <h4 class="font-black text-xl mb-6 italic uppercase tracking-tighter text-heading">Info Terkait</h4>
        <div class="space-y-6">
            @foreach ($relatedAnnouncements as $side)
                <a href="#" class="group block">
                    <p class="text-[10px] text-primary font-black uppercase tracking-widest mb-1">
                        {{ optional($side->published_at)->translatedFormat('d M Y') }}</p>
                    <h5 class="font-bold text-heading group-hover:text-primary transition-colors leading-tight">
                        {{ $side->title }}</h5>
                </a>
            @endforeach
        </div>
        <a href="/announcements"
            class="block w-full mt-8 py-3 text-center text-sm font-bold text-gray-400 border border-gray-100 rounded-xl hover:bg-section transition-all">
            Lihat Semua Info
        </a>
    </div>

    <div class="bg-primary rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden group">
        <div
            class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
        </div>
        <h4 class="font-black text-xl mb-4 italic uppercase tracking-tighter">Butuh Bantuan?</h4>
        <p class="text-white/80 text-sm mb-6 leading-relaxed italic">Hubungi bidang Hubungan Masyarakat jika ada
            pertanyaan terkait info ini.</p>
        <a href="#"
            class="inline-flex items-center gap-2 font-black text-white uppercase italic tracking-widest text-xs group-hover:gap-4 transition-all">
            Chat Admin
            <x-heroicon-o-arrow-right class="size-4" />
        </a>
    </div>
</div>
