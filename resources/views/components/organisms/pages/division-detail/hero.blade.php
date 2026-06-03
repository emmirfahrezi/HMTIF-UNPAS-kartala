@props(['division'])

<x-molecules.pages.sections.page-hero icon="heroicon-o-briefcase">
    <div class="text-left max-w-3xl -mt-16 md:-mt-24 relative z-20">
        <a href="{{ route('staff', ['period' => request('period')]) }}"
            class="inline-flex items-center gap-2 text-primary font-bold text-sm hover:-translate-x-1 transition-transform group mb-8">
            <x-heroicon-o-arrow-left class="size-4" />
            Kembali ke Daftar Bidang
        </a>

        <div class="mt-2">
            <span
                class="inline-flex items-center px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.2em] mb-5">
                Detail Bidang
            </span>
            <h1
                class="text-3xl md:text-5xl font-black italic uppercase tracking-tighter text-heading leading-tight">
                {{ $division->name }}
            </h1>
            <div class="mt-5 text-xs font-black uppercase tracking-widest text-primary">
                Total Anggota: {{ $division->staffs->count() }}
            </div>
        </div>
    </div>
</x-molecules.pages.sections.page-hero>

