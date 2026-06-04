@php
    $members = $content['members'] ?? collect();
    $milestones = $content['milestones'] ?? collect();
@endphp

<x-layouts.app
    title="Tim Pengembang | HMTIF-UNPAS"
    description="Kenali tim pengembang dan alur pengembangan sistem informasi HMTIF-UNPAS berdasarkan periode."
    keywords="Tim Pengembang HMTIF, Developer HMTIF, Kominfo HMTIF"
    :transparent="false"
>
    <main class="bg-slate-50 text-slate-900">
        <section class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex max-w-screen-2xl flex-col gap-8 px-6 py-12 lg:flex-row lg:items-start lg:justify-between lg:px-8 lg:py-16">
                <div class="max-w-3xl">
                    <p class="text-xs font-black uppercase text-primary">Ekosistem Digital</p>
                    <h1 class="mt-3 text-4xl font-black text-slate-950 md:text-5xl">
                        {{ $content['title'] ?: 'Tim Pengembang' }}
                    </h1>
                    <p class="mt-5 max-w-2xl text-base font-medium leading-8 text-slate-600">
                        {{ $content['description'] }}
                    </p>
                </div>

                <form action="{{ route('developer-team') }}" method="GET" class="w-full lg:w-auto">
                    <div class="w-full lg:w-56">
                        <x-molecules.shared.forms.form-input
                            label="Periode"
                            name="period"
                            type="select"
                            :value="$activePeriod?->label"
                            :options="$periodOptions"
                            :size="'sm'"
                            @change="setTimeout(() => $el.closest('form').submit(), 50)" />
                    </div>
                </form>
            </div>
        </section>

        <section class="bg-white py-12 lg:py-16">
            <div class="mx-auto max-w-screen-2xl px-6 lg:px-8">
                <div class="mb-8 flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-slate-950 md:text-3xl">Anggota Tim ({{ $activePeriod?->label ?? '-' }})</h2>
                        <p class="mt-2 text-sm font-medium text-slate-500">Dedikasi di balik ekosistem digital untuk periode terpilih.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    @forelse($members as $member)
                        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-primary/30 hover:shadow-lg hover:shadow-slate-200/70">
                            <img src="{{ $member->photo_url }}" alt="{{ $member->display_name }}"
                                class="size-14 rounded-2xl border border-slate-200 object-cover">
                            <h3 class="mt-4 text-base font-black text-slate-950">{{ $member->display_name }}</h3>
                            <p class="mt-1 text-sm font-bold text-primary">{{ $member->role }}</p>
                            <p class="mt-3 flex items-center gap-1.5 text-xs font-bold text-slate-500">
                                <x-heroicon-o-building-office-2 class="size-4 text-slate-400" />
                                {{ $member->division_name }}
                            </p>
                        </article>
                    @empty
                        <div class="col-span-full rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-10 text-center">
                            <x-heroicon-o-user-group class="mx-auto size-10 text-slate-300" />
                            <p class="mt-3 text-sm font-bold text-slate-500">Belum ada anggota tim untuk periode ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="border-t border-slate-200 bg-slate-100/70 py-14 lg:py-20">
            <div class="mx-auto max-w-screen-2xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-2xl font-black text-slate-950 md:text-3xl">Alur Pengembangan</h2>
                    <p class="mt-2 text-sm font-medium text-slate-500">Peta jalan pengembangan sistem informasi yang saling terhubung.</p>
                </div>

                <div class="relative mx-auto mt-10 max-w-4xl space-y-7 before:absolute before:left-4 before:top-2 before:h-full before:w-px before:bg-slate-300 md:before:left-1/2">
                    @forelse($milestones as $milestone)
                        <article class="relative grid grid-cols-1 gap-5 md:grid-cols-2">
                            <span class="absolute left-4 top-6 z-10 size-3 -translate-x-1/2 rounded-full border-2 border-white {{ $milestone->dot_class }} md:left-1/2"></span>
                            <div class="{{ $loop->even ? 'md:col-start-2 md:pl-10' : 'md:pr-10' }} pl-10 md:pl-0">
                                <div class="rounded-2xl border p-5 shadow-sm {{ $milestone->status_class }}">
                                    <div class="mb-3 flex flex-wrap items-center gap-2">
                                        <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-black uppercase text-slate-500">
                                            Periode {{ $milestone->period_label }}
                                        </span>
                                        <span class="rounded-full bg-white px-2.5 py-1 text-[10px] font-black uppercase text-primary shadow-sm">
                                            {{ $milestone->status_label }}
                                        </span>
                                    </div>
                                    <h3 class="text-base font-black text-slate-950">{{ $milestone->title }}</h3>
                                    <p class="mt-2 text-sm font-medium leading-6 text-slate-600">{{ $milestone->description }}</p>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">
                            <x-heroicon-o-map class="mx-auto size-10 text-slate-300" />
                            <p class="mt-3 text-sm font-bold text-slate-500">Belum ada alur pengembangan untuk periode ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
</x-layouts.app>
