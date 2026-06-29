@props(['stats' => [], 'homeSections' => []])

@php
    $statsLabel = data_get($homeSections, 'stats.label', 'Pergerakan Kami');
    $statsTitle = data_get($homeSections, 'stats.title', 'Kekuatan Kolektif HMTIF-UNPAS');
    $statsDesc = data_get($homeSections, 'stats.description', 'Melalui semangat "Kartala", kami bergerak bersama untuk menghadirkan perubahan nyata melalui program kerja yang terukur.');

    // Strictly Frontend-driven dynamic counts from existing database models
    $dynamicStats = [
        [
            'label'       => 'Pengurus Aktif',
            'value'       => \App\Models\Staff::where('is_active', true)->count(),
            'icon'        => 'users',
            'description' => 'Terdaftar secara resmi dalam database keanggotaan HMTIF-UNPAS.',
        ],
        [
            'label'       => 'Agenda Proker',
            'value'       => \App\Models\Activity::count(),
            'icon'        => 'calendar',
            'description' => 'Program kerja yang dirancang untuk pengembangan mahasiswa.',
        ],
        [
            'label'       => 'Departemen',
            'value'       => \App\Models\Division::where('slug', '!=', 'bph')->count(),
            'icon'        => 'puzzle',
            'description' => 'Bidang dan divisi khusus yang menjalankan roda organisasi.',
        ],
    ];
@endphp

<div class="py-24 bg-section relative overflow-hidden content-auto">

    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl text-center mb-20">
        <x-atoms.pages.section-title align="center">
            {{ $statsLabel }}
        </x-atoms.section-title>
        <h2 class="text-3xl sm:text-4xl font-bold text-heading mt-4">{{ $statsTitle }}</h2>
        <div class="text-gray-500 max-w-2xl mx-auto mt-6 text-lg">
            {!! $statsDesc !!}
        </div>
    </div>

    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($dynamicStats as $index => $stat)
                <x-molecules.pages.stats.stat-card 
                    :label="data_get($stat, 'label')" 
                    :value="data_get($stat, 'value')" 
                    :icon="data_get($stat, 'icon')"
                    :description="data_get($stat, 'description')"
                    class="reveal-delay-{{ $index + 1 }}" />
            @endforeach
        </div>

        @if (empty($dynamicStats))
            <p class="text-sm text-body/60 mt-8 text-center">Belum ada statistik yang tersedia.
            </p>
        @endif
    </div>
</div>
