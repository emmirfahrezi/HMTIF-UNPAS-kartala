@props(['stats'])

@php
    use App\Models\HomeSection;
    $statsLabel = HomeSection::get('stats', 'label', 'Pergerakan Kami');
    $statsTitle = HomeSection::get('stats', 'title', 'Kekuatan Kolektif HMTIF-UNPAS');
    $statsDesc = HomeSection::get('stats', 'description', 'Melalui semangat "Kartala", kami bergerak bersama untuk menghadirkan perubahan nyata melalui program kerja yang terukur.');
@endphp

<div class="py-24 bg-section relative overflow-hidden content-auto">

    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl text-center mb-20">
        <x-atoms.pages.section-title align="center">
            {{ $statsLabel }}
        </x-atoms.section-title>
        <h2 class="text-3xl sm:text-4xl font-bold text-heading mt-4">{{ $statsTitle }}</h2>
        <p class="text-gray-500 max-w-2xl mx-auto mt-6 text-lg">
            {{ $statsDesc }}
        </p>
    </div>

    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($stats as $index => $stat)
                <x-molecules.pages.stats.stat-card :label="$stat->label" :value="$stat->value" :icon="$stat->icon"
                    class="reveal-delay-{{ $index + 1 }}" />
            @endforeach
        </div>

        @if ($stats->isEmpty())
            <p class="text-sm text-body/60 mt-8 text-center">Belum ada statistik. Jalankan seeder untuk menampilkan data.
            </p>
        @endif
    </div>
</div>

