<x-layouts.dashboard pageTitle="Log Aktivitas" :breadcrumbs="[['label' => 'Log Aktivitas']]">
    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/activity-logs" 
        searchPlaceholder="Cari judul atau pelaksana...">
        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Kategori</label>
            <div class="w-44">
                <x-molecules.shared.forms.form-input 
                    type="select"
                    name="category"
                    :value="request('category', '')"
                    placeholder="Semua Kategori"
                    :options="['' => 'Semua Kategori'] + collect($categories)->mapWithKeys(fn($cat) => [$cat => $cat])->toArray()"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)"
                />
            </div>
        </div>
    </x-molecules.dashboard.cards.filter-card>

    <x-molecules.dashboard.cards.data-table
        :selectable="false"
        :showActions="true"
        :headers="[
            ['label' => 'Tanggal'],
            ['label' => 'Judul'],
            ['label' => 'Kategori'],
            ['label' => 'Pelaksana'],
        ]">

        @forelse ($logs ?? [] as $item)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $item->id }}">
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d M Y H:i') }}
                </td>
                <td class="px-5 py-4">
                    <div class="text-sm font-bold text-slate-800 dark:text-white">{{ $item->title }}</div>
                    @if($item->description)
                        <div class="text-xs text-slate-500 dark:text-slate-400 line-clamp-1 mt-0.5">{{ Str::limit(strip_tags($item->description), 50) }}</div>
                    @endif
                </td>
                <td class="px-5 py-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider bg-primary/10 text-primary border border-primary/20">
                        {{ $item->category }}
                    </span>
                </td>
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200">
                    <div class="flex items-center gap-2">
                        <div class="size-7 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-xs font-black text-slate-600 dark:text-slate-300 shrink-0 uppercase">
                            {{ substr($item->performed_by, 0, 1) }}
                        </div>
                        {{ $item->performed_by }}
                    </div>
                </td>
                <td class="px-5 py-4 text-right">
                    <button type="button"
                        x-data
                        @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: { name: 'activity-log-detail-{{ $item->id }}' } }))"
                        class="inline-flex items-center gap-2 rounded-xl border border-slate-200/60 bg-white px-3 py-2 text-xs font-bold text-slate-500 transition hover:border-primary/30 hover:bg-primary/5 hover:text-primary dark:border-slate-800 dark:bg-slate-950/40 dark:text-slate-400 dark:hover:bg-primary/10">
                        <x-heroicon-o-eye class="size-4" />
                        Detail
                    </button>
                </td>
            </tr>
        @empty
            <x-slot:empty>
                <x-molecules.shared.empty-state 
                    title="Belum ada log aktivitas" 
                    description="Aktivitas sistem akan muncul otomatis setelah ada perubahan data."
                    icon="heroicon-o-document-text" />
            </x-slot:empty>
        @endforelse

        <x-slot:pagination>
            <x-molecules.dashboard.cards.pagination :paginator="$logs" />
        </x-slot:pagination>
    </x-molecules.dashboard.cards.data-table>

    @foreach ($logs ?? [] as $item)
        <x-molecules.shared.modal id="activity-log-detail-{{ $item->id }}" title="Detail Log Aktivitas" maxWidth="lg">
            <div class="space-y-6">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Judul Aktivitas</p>
                    <h3 class="mt-1 text-lg font-black text-slate-900 dark:text-white">{{ $item->title }}</h3>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div class="rounded-2xl border border-slate-200/60 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/40">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Tanggal</p>
                        <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">
                            {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d M Y H:i') }}
                        </p>
                    </div>
                    <div class="rounded-2xl border border-slate-200/60 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/40">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Kategori</p>
                        <p class="mt-1 text-sm font-bold text-primary">{{ $item->category }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200/60 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/40">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Pelaksana</p>
                        <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $item->performed_by }}</p>
                    </div>
                </div>

                <div>
                    <p class="mb-3 text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Deskripsi</p>
                    <div class="prose prose-sm prose-slate max-w-none rounded-2xl border border-slate-200/60 bg-slate-50 p-5 text-slate-600 dark:prose-invert dark:border-slate-800 dark:bg-slate-950/40 dark:text-slate-300">
                        @if ($item->description)
                            {!! $item->description !!}
                        @else
                            <p>Tidak ada deskripsi tambahan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </x-molecules.shared.modal>
    @endforeach

</x-layouts.dashboard>
