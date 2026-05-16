<x-layouts.dashboard
    pageTitle="Detail Log Aktivitas"
    :breadcrumbs="[
        ['label' => 'Log Aktivitas', 'href' => '/dashboard/activity-logs'],
        ['label' => 'Detail'],
    ]"
>
    @php
        $log = $activityLog ?? null;
        $logDate = $log?->date ? \Carbon\Carbon::parse($log->date) : null;
    @endphp

    <div class="mx-auto max-w-5xl space-y-8">
        <div class="flex justify-end">
            <x-atoms.shared.button
                variant="ghost"
                href="/dashboard/activity-logs"
                icon="heroicon-o-arrow-left">
                Kembali
            </x-atoms.shared.button>
        </div>

        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition-colors duration-300 dark:border-slate-800 dark:bg-slate-900/50">
            <div class="pointer-events-none absolute right-0 top-0 p-8 text-primary opacity-[0.03]">
                <x-heroicon-o-document-text class="size-36" />
            </div>

            <div class="relative flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                <div class="max-w-2xl">
                    <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/10 px-3 py-1 text-[10px] font-black uppercase tracking-widest text-primary">
                        <x-heroicon-s-bolt class="size-3.5" />
                        Log Otomatis
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">Judul Aktivitas</p>
                    <h2 class="mt-2 text-2xl font-black leading-tight text-slate-900 dark:text-white">
                        {{ $log?->title ?? 'Log aktivitas tidak ditemukan' }}
                    </h2>
                </div>

                <div class="rounded-2xl border border-slate-200/70 bg-slate-50 p-5 text-right dark:border-slate-800 dark:bg-slate-950/40">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Waktu Aktivitas</p>
                    <p class="mt-1 text-sm font-black text-slate-800 dark:text-slate-100">
                        {{ $logDate?->translatedFormat('d M Y') ?? '-' }}
                    </p>
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400">
                        {{ $logDate?->translatedFormat('H:i') ?? '-' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="space-y-8 lg:col-span-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition-colors duration-300 dark:border-slate-800 dark:bg-slate-900/50">
                    <h3 class="mb-5 flex items-center gap-3 text-lg font-black text-slate-800 dark:text-white">
                        <span class="flex size-8 items-center justify-center rounded-xl bg-primary/10 text-primary dark:bg-primary/20">
                            <x-heroicon-s-document-text class="size-5" />
                        </span>
                        Deskripsi Aktivitas
                    </h3>

                    <div class="prose prose-slate max-w-none rounded-2xl border border-slate-200/70 bg-slate-50 p-6 text-slate-600 dark:prose-invert dark:border-slate-800 dark:bg-slate-950/40 dark:text-slate-300">
                        @if ($log?->description)
                            {!! $log->description !!}
                        @else
                            <p>Tidak ada deskripsi tambahan untuk aktivitas ini.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-colors duration-300 dark:border-slate-800 dark:bg-slate-900/50">
                    <h3 class="mb-5 text-xs font-black uppercase tracking-widest text-slate-800 dark:text-white">Ringkasan</h3>

                    <div class="space-y-4">
                        <div class="rounded-2xl border border-slate-200/70 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/40">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Kategori</p>
                            <p class="mt-1 text-sm font-bold text-primary">{{ $log?->category ?? '-' }}</p>
                        </div>

                        <div class="rounded-2xl border border-slate-200/70 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/40">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Pelaksana</p>
                            <div class="mt-2 flex items-center gap-3">
                                <div class="flex size-9 shrink-0 items-center justify-center rounded-full bg-slate-200 text-xs font-black uppercase text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                    {{ substr((string) ($log?->performed_by ?? '-'), 0, 1) }}
                                </div>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $log?->performed_by ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-slate-200/70 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/40">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Sumber Data</p>
                            <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">Sistem otomatis</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-6 dark:bg-emerald-500/10">
                    <div class="flex gap-4">
                        <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-500">
                            <x-heroicon-s-shield-check class="size-5" />
                        </div>
                        <div>
                            <h4 class="mb-1 text-xs font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-500">Hanya Baca</h4>
                            <p class="text-[11px] font-medium leading-relaxed text-slate-600 dark:text-slate-400">
                                Log aktivitas dicatat otomatis oleh sistem dan tidak perlu diubah manual dari dashboard.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
