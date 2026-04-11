@php
    $announcement = \App\Models\Announcement::query()->with('category')->latest('published_at')->first();
@endphp

{{-- Hero Section with Breadcrumb --}}
<section class="relative pt-20 pb-6 overflow-hidden bg-white">
    <div class="absolute inset-0 z-0 opacity-10">
        <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 0 L100 0 L100 100 L0 100 Z" fill="none" stroke="currentColor" stroke-width="1"
                class="text-primary" />
            <path d="M0 0 L100 100" stroke="currentColor" stroke-width="0.5" class="text-primary" />
        </svg>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="flex flex-col items-start gap-4 mb-8">
            <a href="/announcements"
                class="flex items-center gap-2 text-primary font-bold text-sm hover:translate-x-1 transition-transform group">
                <x-heroicon-o-arrow-left class="size-4" />
                Kembali ke Pengumuman
            </a>
            <span
                class="px-4 py-1.5 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.2em]">Penting
                • {{ $announcement?->category?->name ?? 'Umum' }}</span>
        </div>

        <h1
            class="text-2xl md:text-4xl font-black text-heading mb-6 uppercase italic tracking-tighter leading-tight max-w-5xl">
            {{ $announcement?->title ?? 'Detail Pengumuman HMTIF' }}
        </h1>

        <div class="flex flex-wrap gap-6 text-sm font-medium text-body/60">
            <div class="flex items-center gap-2">
                <x-heroicon-o-calendar class="size-5 text-primary" />
                Terbit:
                {{ optional($announcement?->published_at)->translatedFormat('d F Y') ?? 'Tanggal belum tersedia' }}
            </div>
            <div class="flex items-center gap-2">
                <x-heroicon-o-clock class="size-5 text-primary" />
                3 Menit Baca
            </div>
        </div>
    </div>
</section>
