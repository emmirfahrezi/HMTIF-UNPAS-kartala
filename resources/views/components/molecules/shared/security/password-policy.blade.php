@props([
    'compact' => false,
])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-emerald-500/15 bg-emerald-500/5 p-4 dark:border-emerald-400/20 dark:bg-emerald-400/10']) }}>
    <div class="flex gap-3">
        <div class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-600">
            <x-heroicon-o-shield-check class="size-5" />
        </div>
        <div>
            <p class="text-xs font-black uppercase tracking-widest text-emerald-700 dark:text-emerald-300">Syarat Password</p>
            <ul class="mt-2 space-y-1 text-xs font-semibold leading-relaxed text-slate-600 dark:text-slate-300">
                <li>Minimal 12 karakter.</li>
                <li>Mengandung huruf besar dan huruf kecil.</li>
                <li>Mengandung angka.</li>
                <li>Mengandung simbol, misalnya ! @ # $.</li>
            </ul>
            @unless ($compact)
                <p class="mt-3 text-[11px] font-medium leading-relaxed text-slate-500 dark:text-slate-400">
                    Gunakan password unik yang tidak dipakai di layanan lain.
                </p>
            @endunless
        </div>
    </div>
</div>
