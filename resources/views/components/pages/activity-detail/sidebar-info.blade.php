@php
    $activity = \App\Models\Activity::query()->latest('start_date')->first();
@endphp

{{-- Sidebar Info Component --}}
<div class="space-y-8 reveal reveal-right">
    <div class="bg-primary-dark rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden group">
        <div
            class="absolute top-0 right-0 w-32 h-32 bg-primary opacity-20 rounded-full -mr-16 -mt-16 blur-3xl group-hover:opacity-40 transition-opacity">
        </div>

        <h4 class="font-black text-xl mb-6 italic uppercase tracking-tighter text-primary-soft">Detail Acara</h4>
        <ul class="space-y-6 relative z-10">
            <li class="flex flex-col gap-1">
                <span class="text-[10px] text-white/40 uppercase font-black tracking-widest leading-none">Waktu</span>
                <span class="font-bold">
                    @if ($activity?->start_date)
                        {{ $activity->start_date->translatedFormat('d F Y') }} •
                        {{ $activity->start_date->format('H.i') }} WIB
                    @else
                        Jadwal akan diumumkan
                    @endif
                </span>
            </li>
            <li class="flex flex-col gap-1">
                <span class="text-[10px] text-white/40 uppercase font-black tracking-widest leading-none">Lokasi</span>
                <span class="font-bold leading-tight">{{ $activity?->location ?: 'Lokasi akan diumumkan' }}</span>
            </li>
            <li class="flex flex-col gap-1">
                <span
                    class="text-[10px] text-white/40 uppercase font-black tracking-widest leading-none">Dresscode</span>
                <span class="font-bold">Almamater UNPAS</span>
            </li>
        </ul>

        <hr class="my-8 border-white/10">

        <a href="{{ $activity?->registration_url ?: 'https://wa.me/#' }}"
            class="block w-full py-4 bg-primary hover:bg-primary-soft text-white text-center rounded-xl font-black uppercase italic tracking-tighter transition-all shadow-xl shadow-primary/20 hover:-translate-y-1">
            Pendaftaran Peserta
        </a>
    </div>

    <div class="bg-white rounded-3xl p-8 border border-border shadow-sm">
        <h4 class="font-black text-xl mb-6 italic uppercase tracking-tighter text-heading">Narahubung</h4>
        <div class="flex items-center gap-4">
            <div class="size-12 rounded-full bg-section flex items-center justify-center text-primary">
                <x-heroicon-o-chat-bubble-left-right class="size-6" />
            </div>
            <div>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Sekretaris Umum</p>
                <p class="font-black text-heading italic">+62 812-3456-7890</p>
            </div>
        </div>
    </div>
</div>
