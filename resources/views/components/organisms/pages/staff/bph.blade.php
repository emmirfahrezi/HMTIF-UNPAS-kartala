@props(['staffs'])

@php
    $leaders = $staffs->filter(fn($s) => $s->isLeader())->sortBy('order')->take(1);
    $bphMembers = $staffs->where('is_bph', true)->reject(fn($s) => $s->isLeader())->sortBy('order')->take(7);
@endphp

<div class="mb-20 md:mb-24">
    <div class="flex items-center gap-4 mb-12">
        <div class="h-8 w-2 bg-primary rounded-full"></div>
        <h2 class="text-heading font-black text-3xl md:text-4xl uppercase tracking-tighter italic">Badan Pengurus <span
                class="text-primary italic">Harian</span></h2>
        <div class="h-px flex-1 bg-linear-to-r from-primary/20 to-transparent"></div>
        <a href="{{ route('divisions.show', 'bph') }}"
            class="inline-flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2 rounded-lg border border-secondary/50 text-heading text-[10px] md:text-xs font-black uppercase tracking-widest hover:bg-secondary transition-colors shrink-0">
            Detail Bidang
            <x-heroicon-o-arrow-right class="size-3.5 md:size-4" />
        </a>
    </div>

    <div class="grid grid-cols-1 gap-6 md:gap-8 max-w-[400px] mx-auto">
        @foreach ($leaders as $index => $staff)
            <x-molecules.pages.cards.member-card :name="$staff->name" position="Ketua Umum" size="xl" dept="KARTALA"
                class="reveal-delay-{{ $index + 1 }}" :image="$staff->photo_url"
                :href="route('staff.show', $staff->id)" />
        @endforeach
    </div>

    <div class="flex md:grid md:grid-cols-2 lg:grid-cols-4 gap-3 overflow-x-auto overflow-y-hidden md:overflow-visible snap-x snap-mandatory md:snap-none touch-pan-x overscroll-x-contain pb-2 md:pb-0 -mx-1 px-1 no-scrollbar mt-14 md:mt-16">
        @foreach ($bphMembers as $index => $staff)
            <div class="min-w-[82%] sm:min-w-[58%] md:min-w-0 snap-start reveal reveal-up reveal-delay-{{ ($index % 4) + 1 }}">
                <x-molecules.pages.cards.member-card :name="$staff->name" :position="$staff->position" size="normal"
                    :dept="$staff->abbreviation" :href="route('staff.show', $staff->id)"
                    :image="$staff->photo_url" />
            </div>
        @endforeach
    </div>

    @if ($leaders->isEmpty() && $bphMembers->isEmpty())
        <p class="text-sm text-body/60 mt-8">Belum ada data pengurus yang tersedia.</p>
    @endif
</div>
