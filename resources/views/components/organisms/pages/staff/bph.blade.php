@props(['staffs'])

@php
    $leaders = $staffs
        ->whereIn('position', ['Ketua Himpunan', 'Ketua Umum'])
        ->sortBy('order')
        ->take(1);

    $bphMembers = $staffs
        ->where('is_bph', true)
        ->whereNotIn('position', ['Ketua Himpunan', 'Ketua Umum'])
        ->sortBy('order')
        ->take(7);

    $deptAbbr = [
        'Ketua Umum' => 'KET',
        'Sekretaris Jenderal' => 'SEKJEN',
        'Sekretaris Umum' => 'SEKUM',
        'Wakil Sekretaris Umum' => 'WASEKUM',
        'Bendahara Umum' => 'BEND',
        'Wakil Bendahara Umum' => 'WABEND',
        'Kepala Bidang 1' => 'KAB 1',
        'Kepala Bidang 2' => 'KAB 2',
    ];
@endphp

<div class="mb-20 md:mb-24">
    <div class="flex items-center gap-4 mb-12">
        <div class="h-8 w-2 bg-primary rounded-full"></div>
        <h2 class="text-heading font-black text-3xl md:text-4xl uppercase tracking-tighter italic">Ketua <span
                class="text-primary italic">Umum</span></h2>
        <div class="h-px flex-1 bg-linear-to-r from-primary/20 to-transparent"></div>
        <a href="/detail-division?division=bph"
            class="hidden md:inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-secondary/50 text-heading text-xs font-black uppercase tracking-widest hover:bg-secondary transition-colors">
            Detail Bidang
            <x-heroicon-o-arrow-right class="size-4" />
        </a>
    </div>
    <div class="grid grid-cols-1 gap-6 md:gap-8 max-w-[400px] mx-auto">
        @foreach ($leaders as $index => $staff)
            <x-molecules.pages.cards.member-card :name="$staff->name" :position="$staff->position" size="xl" dept="KARTALA"
                class="reveal-delay-{{ $index + 1 }}" :image="$staff->photo ?: asset('images/placeholders/member.svg')"
                :href="'/detail-member?staff=' . $staff->id" />
        @endforeach
    </div>

    <div class="flex items-center gap-4 mb-10 mt-14 md:mt-16">
        <div class="h-8 w-2 bg-primary rounded-full"></div>
        <h2 class="text-heading font-black text-3xl md:text-4xl uppercase tracking-tighter italic">Badan Pengurus <span
                class="text-primary italic">Harian</span></h2>
        <div class="h-px flex-1 bg-linear-to-r from-primary/20 to-transparent"></div>
        <a href="/detail-division?division=bph"
            class="hidden md:inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-secondary/50 text-heading text-xs font-black uppercase tracking-widest hover:bg-secondary transition-colors">
            Detail Bidang
            <x-heroicon-o-arrow-right class="size-4" />
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 md:gap-4 mx-auto">
        @foreach ($bphMembers as $index => $staff)
            <div class="w-full max-w-[400px] mx-auto reveal-delay-{{ ($index % 3) + 1 }}">
                <x-molecules.pages.cards.member-card :name="$staff->name" :position="$staff->position" size="normal"
                    :dept="$deptAbbr[$staff->position] ?? 'BPH'" :href="'/detail-member?staff=' . $staff->id"
                    :image="$staff->photo ?: asset('images/placeholders/member.svg')" />
            </div>
        @endforeach
    </div>

    @if ($leaders->isEmpty() && $bphMembers->isEmpty())
        <p class="text-sm text-body/60 mt-8">Belum ada data pengurus. Jalankan seeder untuk menampilkan data.</p>
    @endif
</div>