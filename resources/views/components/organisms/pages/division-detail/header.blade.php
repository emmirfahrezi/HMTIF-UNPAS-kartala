@props(['division'])

<div class="bg-white rounded-3xl border border-border shadow-sm p-8 md:p-10 mb-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <span
                class="inline-flex items-center px-3 py-1 rounded-full bg-secondary/25 text-heading text-[10px] font-black uppercase tracking-[0.2em] mb-4">Detail
                Bidang</span>
            <h2 class="text-3xl md:text-5xl font-black italic uppercase tracking-tighter text-heading">
                {{ $division->name }}
            </h2>
            <p class="text-body/70 mt-3">Struktur koordinator dan anggota aktif pada bidang ini.</p>
        </div>
        <div class="text-xs font-black uppercase tracking-widest text-primary">
            Total Anggota: {{ $division->staffs->count() }}
        </div>
    </div>
</div>

