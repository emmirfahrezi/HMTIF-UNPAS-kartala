@php
    $periodSlug = str_replace('/', '-', $activePeriod);
    $members = collect(data_get($content, 'members', []));
    $milestones = collect(data_get($content, 'milestones', []));
@endphp

<x-layouts.dashboard pageTitle="Tim Pengembang" :breadcrumbs="[['label' => 'Tim Pengembang']]">
    <div class="space-y-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-black uppercase italic text-slate-800 dark:text-white">Tim Pengembang</h2>
                <p class="mt-1 text-sm font-medium text-slate-500 dark:text-slate-400">Kelola konten public page tim pengembang per periode.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <x-atoms.shared.button href="{{ route('developer-team', ['period' => $activePeriod]) }}" target="_blank" variant="soft" icon="heroicon-o-arrow-top-right-on-square">
                    Lihat Public
                </x-atoms.shared.button>
                @if($permissions['create'] ?? false)
                    <x-atoms.shared.button href="/dashboard/developer-teams/create" icon="heroicon-o-plus">
                        Tambah Periode
                    </x-atoms.shared.button>
                @endif
            </div>
        </div>

        <div class="flex gap-2 overflow-x-auto pb-1">
            @foreach($periods as $period)
                @php
                    $isActive = $period === $activePeriod;
                    $href = url('/dashboard/developer-teams') . '?' . http_build_query(['period' => $period]);
                @endphp
                <a href="{{ $href }}"
                    class="shrink-0 rounded-2xl border px-4 py-2 text-xs font-black uppercase transition {{ $isActive ? 'border-primary bg-primary text-white shadow-lg shadow-primary/20' : 'border-slate-200 bg-white text-slate-500 hover:border-primary/30 hover:text-primary dark:border-slate-800 dark:bg-slate-900/50 dark:text-slate-400' }}">
                    {{ $period }}
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-8">
                <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900/50">
                    <div class="mb-6 flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-black uppercase text-primary">Periode {{ $activePeriod }}</p>
                            <h3 class="mt-2 text-xl font-black text-slate-800 dark:text-white">{{ data_get($content, 'title', 'Tim Pengembang') }}</h3>
                            <p class="mt-2 text-sm font-medium leading-7 text-slate-500 dark:text-slate-400">{{ data_get($content, 'description') }}</p>
                        </div>
                        @if($permissions['update'] ?? false)
                            <x-atoms.shared.button href="/dashboard/developer-teams/{{ $periodSlug }}/edit" variant="soft-warning" size="sm" icon="heroicon-o-pencil-square">
                                Edit
                            </x-atoms.shared.button>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @forelse($members as $member)
                            <div class="flex items-center gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950">
                                <img src="{{ data_get($member, 'photo') }}" alt="{{ data_get($member, 'name') }}" class="size-12 rounded-xl object-cover">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-black text-slate-800 dark:text-white">{{ data_get($member, 'name') }}</p>
                                    <p class="truncate text-xs font-bold text-primary">{{ data_get($member, 'role') }}</p>
                                    <p class="mt-1 truncate text-[11px] font-medium text-slate-400">{{ data_get($member, 'division') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full rounded-2xl border border-dashed border-slate-200 p-8 text-center dark:border-slate-800">
                                <p class="text-sm font-bold text-slate-400">Belum ada anggota.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900/50">
                    <h3 class="mb-6 text-lg font-black text-slate-800 dark:text-white">Alur Pengembangan</h3>
                    <div class="space-y-4">
                        @forelse($milestones as $milestone)
                            <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5 dark:border-slate-800 dark:bg-slate-950">
                                <div class="mb-2 flex flex-wrap items-center gap-2">
                                    <span class="rounded-full bg-white px-2.5 py-1 text-[10px] font-black uppercase text-slate-500 dark:bg-slate-900">Periode {{ data_get($milestone, 'period') }}</span>
                                    <span class="rounded-full bg-primary/10 px-2.5 py-1 text-[10px] font-black uppercase text-primary">{{ data_get($milestone, 'status') }}</span>
                                </div>
                                <p class="text-sm font-black text-slate-800 dark:text-white">{{ data_get($milestone, 'title') }}</p>
                                <p class="mt-1 text-xs font-medium leading-6 text-slate-500 dark:text-slate-400">{{ data_get($milestone, 'description') }}</p>
                            </div>
                        @empty
                            <div class="rounded-2xl border border-dashed border-slate-200 p-8 text-center dark:border-slate-800">
                                <p class="text-sm font-bold text-slate-400">Belum ada milestone.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <aside class="space-y-8">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900/50">
                    <h3 class="mb-6 text-xs font-black uppercase text-slate-800 dark:text-white">Ringkasan</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400">Anggota</p>
                            <p class="mt-1 text-2xl font-black text-slate-800 dark:text-white">{{ $members->count() }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400">Milestone</p>
                            <p class="mt-1 text-2xl font-black text-slate-800 dark:text-white">{{ $milestones->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-primary/10 bg-primary/5 p-6 dark:border-primary/20 dark:bg-primary/10">
                    <div class="flex gap-4">
                        <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <x-heroicon-s-light-bulb class="size-5" />
                        </div>
                        <div>
                            <h4 class="mb-1 text-xs font-black uppercase text-primary">Catatan</h4>
                            <p class="text-[11px] font-medium leading-relaxed text-slate-600 dark:text-slate-400">
                                Data tersimpan per periode global. Hero tetap global, sementara anggota dan alur mengikuti periode aktif.
                            </p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.dashboard>
