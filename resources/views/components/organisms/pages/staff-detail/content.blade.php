@props(['staff', 'fallbackImage'])

<div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
    <div class="lg:col-span-2 bg-white rounded-3xl border border-border shadow-sm overflow-hidden">
        <div class="aspect-4/5 bg-section">
            <img src="{{ $staff->photo ?: $fallbackImage }}" alt="{{ $staff->name }}"
                class="h-full w-full object-cover object-top" data-fallback-src="{{ $fallbackImage }}">
        </div>
    </div>

    <div class="lg:col-span-3 bg-white rounded-3xl border border-border shadow-sm p-8 md:p-10">
        <span
            class="inline-flex items-center px-3 py-1 rounded-full bg-secondary/25 text-heading text-[10px] font-black uppercase tracking-[0.2em] mb-5">Detail
            Pengurus</span>
        <h2 class="text-3xl md:text-5xl font-black italic uppercase tracking-tighter text-heading mb-4">
            {{ $staff->name }}
        </h2>
        <p class="text-primary font-black uppercase tracking-[0.2em] text-xs mb-8">{{ $staff->position }}</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="rounded-2xl border border-border p-5">
                <p class="text-[10px] text-body/50 font-black uppercase tracking-widest mb-2">Bidang</p>
                <p class="font-bold text-heading">{{ $staff->division?->name ?? 'Belum ditetapkan' }}</p>
            </div>
            <div class="rounded-2xl border border-border p-5">
                <p class="text-[10px] text-body/50 font-black uppercase tracking-widest mb-2">Status</p>
                <p class="font-bold text-heading">
                    {{ $staff->is_bph ? 'Badan Pengurus Harian' : 'Fungsionaris Bidang' }}</p>
            </div>
        </div>

        <div class="mt-8 rounded-2xl bg-section border border-border p-5">
            <p class="text-[10px] text-body/50 font-black uppercase tracking-widest mb-2">Ringkasan</p>
            <p class="text-body leading-relaxed">
                Profil pengurus ini ditampilkan dari data staff aktif. Kamu bisa lanjut cek detail bidang
                untuk melihat struktur tim dan anggota lainnya.
            </p>
        </div>
    </div>
</div>

