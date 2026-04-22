@php
    $activity = \App\Models\Activity::query()->latest('start_date')->first();
@endphp

{{-- Sidebar Info Component --}}
<div class="space-y-8 reveal reveal-right">
    <div class="bg-white rounded-3xl p-8 border border-border shadow-sm">
        <h4 class="font-black text-xl mb-6 italic uppercase tracking-tighter text-heading">Detail Acara</h4>
        <ul class="space-y-6">
            <li class="flex flex-col gap-1">
                <span class="text-[10px] text-primary font-black uppercase tracking-widest leading-none">Waktu</span>
                <span class="font-bold text-heading">
                    @if ($activity?->start_date)
                        {{ $activity->start_date->translatedFormat('d F Y') }} •
                        {{ $activity->start_date->format('H.i') }} WIB
                    @else
                        Jadwal akan diumumkan
                    @endif
                </span>
            </li>
            <li class="flex flex-col gap-1">
                <span class="text-[10px] text-primary font-black uppercase tracking-widest leading-none">Lokasi</span>
                <span
                    class="font-bold text-heading leading-tight">{{ $activity?->location ?: 'Lokasi akan diumumkan' }}</span>
            </li>
            <li class="flex flex-col gap-1">
                <span
                    class="text-[10px] text-primary uppercase font-black tracking-widest leading-none">Dresscode</span>
                <span class="font-bold text-heading">Almamater UNPAS</span>
            </li>
        </ul>

        <hr class="my-8 border-border">

        <a href="{{ $activity?->registration_url ?: 'https://wa.me/#' }}"
            class="block w-full py-3 text-center text-sm font-bold text-heading border border-border rounded-xl hover:bg-primary hover:text-white hover:border-primary hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30 transition-all">
            Pendaftaran Peserta
        </a>
    </div>

    <div class="bg-primary rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden group">
        <div
            class="absolute inset-0 bg-linear-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
        </div>
        <h4 class="font-black text-xl mb-6 italic uppercase tracking-tighter">Narahubung</h4>
        <div class="flex items-center gap-4">
            <div class="size-12 rounded-full bg-white/10 flex items-center justify-center text-white">
                <x-heroicon-o-chat-bubble-left-right class="size-6" />
            </div>
            <div>
                <p class="text-xs text-white/60 font-bold uppercase tracking-widest">Sekretaris Umum</p>
                <p class="font-black text-white italic">+62 812-3456-7890</p>
            </div>
        </div>
    </div>
</div>
