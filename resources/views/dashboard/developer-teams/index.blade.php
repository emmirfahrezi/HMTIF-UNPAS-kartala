@php
    $members = $content['members'] ?? collect();
    $milestones = $content['milestones'] ?? collect();
    $activePeriodLabel = $activePeriod?->label ?? '';
@endphp

<x-layouts.dashboard pageTitle="Tim Pengembang" :breadcrumbs="[['label' => 'Tim Pengembang']]">
    @if (!$permissions['read'])
        <div class="flex flex-col items-center justify-center rounded-3xl border border-slate-100 bg-white px-4 pb-24 pt-16 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="mb-6 flex size-16 animate-pulse items-center justify-center rounded-2xl bg-red-50 text-red-500 shadow-inner dark:bg-red-500/10">
                <x-heroicon-o-lock-closed class="size-8" />
            </div>
            <h2 class="mb-2 text-center text-xl font-extrabold tracking-tight text-slate-800 dark:text-white">Akses Terbatas</h2>
            <p class="max-w-md text-center text-sm leading-relaxed text-slate-400 dark:text-slate-500">Anda tidak memiliki izin untuk melihat data pada halaman ini.</p>
        </div>
    @else
        <div class="space-y-8">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-2xl font-black uppercase italic text-slate-800 dark:text-white">Tim Pengembang</h2>
                    <p class="mt-1 text-sm font-medium text-slate-500 dark:text-slate-400">Kelola konten public page tim pengembang per periode.</p>
                </div>
                <x-atoms.shared.button href="{{ route('developer-team', ['period' => $activePeriodLabel]) }}" target="_blank" variant="soft" icon="heroicon-o-arrow-top-right-on-square">
                    Lihat Public
                </x-atoms.shared.button>
            </div>

            <div class="flex gap-2 overflow-x-auto pb-1">
                @foreach($periods as $periodItem)
                    <a href="{{ route('dashboard.developer-teams', ['period' => $periodItem->label]) }}"
                        class="shrink-0 rounded-2xl border px-4 py-2 text-xs font-black uppercase transition {{ $periodItem->is($activePeriod) ? 'border-primary bg-primary text-white shadow-lg shadow-primary/20' : 'border-slate-200 bg-white text-slate-500 hover:border-primary/30 hover:text-primary dark:border-slate-800 dark:bg-slate-900/50 dark:text-slate-400' }}">
                        {{ $periodItem->display_label }}
                    </a>
                @endforeach
            </div>

            <form id="developer-team-form" method="POST" action="{{ route('dashboard.developer-teams.save') }}" class="space-y-8">
                @csrf
                @method('PUT')

                @include('dashboard.developer-teams._form', [
                    'activePeriod' => $activePeriod,
                    'content' => $content,
                    'periods' => $periods,
                    'staffOptions' => $staffOptions,
                ])

                @if ($permissions['update'])
                    <div class="flex justify-end">
                        <x-atoms.shared.button type="submit" icon="heroicon-o-check-circle">
                            Simpan Perubahan
                        </x-atoms.shared.button>
                    </div>
                @endif
            </form>

            @if ($permissions['delete'] && filled($activePeriodLabel) && ($members->isNotEmpty() || $milestones->isNotEmpty()))
                <form method="POST" action="{{ route('dashboard.developer-teams.delete-period') }}"
                    class="flex justify-end">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="period" value="{{ $activePeriodLabel }}">
                    <button type="submit"
                        onclick="return confirm('Kosongkan konten Tim Pengembang periode {{ $activePeriodLabel }}?')"
                        class="inline-flex items-center gap-2 rounded-2xl border border-red-500/30 bg-transparent px-5 py-2.5 text-xs font-black uppercase tracking-widest text-red-500 transition-all duration-300 hover:bg-red-500 hover:text-white">
                        <x-heroicon-o-trash class="size-4" />
                        Kosongkan Periode
                    </button>
                </form>
            @endif
        </div>
    @endif
</x-layouts.dashboard>
