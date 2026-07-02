<x-molecules.shared.modal id="activity-log-detail-{{ $item->id }}" title="Detail Log Aktivitas" maxWidth="2xl">
    <div class="space-y-6">
        <div>
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Judul Aktivitas</p>
            <h3 class="mt-1 text-lg font-black text-slate-900 dark:text-white break-words">{{ $item->title }}</h3>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border border-slate-200/60 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/40">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Tanggal</p>
                <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">
                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d M Y H:i') }}
                </p>
            </div>
            <div class="rounded-2xl border border-slate-200/60 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/40">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Kategori / Aksi</p>
                <div class="mt-1">
                    <span class="mt-2 inline-flex items-center rounded-full border px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider {{ $item->action_color_class }}">
                        {{ $item->category }}
                    </span>
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200/60 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/40">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Pelaksana</p>
                <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200 break-words">{{ $item->performed_by }}</p>
            </div>
        </div>

        <div>
            <p class="mb-3 text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Deskripsi Tambahan</p>
            <div class="prose prose-sm prose-slate max-w-none break-words rounded-2xl border border-slate-200/60 bg-slate-50 p-5 text-slate-600 dark:prose-invert dark:border-slate-800 dark:bg-slate-950/40 dark:text-slate-300">
                @if ($item->description)
                    {{ $item->description }}
                @else
                    <p>Tidak ada deskripsi tambahan.</p>
                @endif
            </div>
        </div>
    </div>
</x-molecules.shared.modal>
