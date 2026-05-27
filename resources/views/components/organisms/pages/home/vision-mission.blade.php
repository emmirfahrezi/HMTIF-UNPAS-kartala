@props(['homeSections' => []])

@php
    // Read types from database with fallbacks:
    // vision_type: 'text' (default) or 'points'
    // mission_type: 'points' (default) or 'text'
    $visionType = data_get($homeSections, 'vision_mission.vision_type', 'text');
    $missionType = data_get($homeSections, 'vision_mission.mission_type', 'points');

    $visionText = data_get($homeSections, 'vision_mission.vision_text', '');
    $missionText = data_get($homeSections, 'vision_mission.mission_text', '');

    // Dynamically parse points if configured as points
    $visionPoints = \App\Models\HomeSection::parseMissions($visionText);
    $missionPoints = data_get($homeSections, 'vision_mission.missions', []);
@endphp

<section
    class="relative overflow-hidden py-24 lg:py-28 bg-linear-to-br from-primary-dark via-vision-via to-primary text-white content-auto">
    <div class="absolute inset-0 opacity-10 bg-repeat"
        style="background-image: url('{{ asset('images/placeholders/pattern-grid.svg') }}');"></div>
    <div class="absolute -top-28 -left-24 h-80 w-80 rounded-full bg-secondary/20 blur-3xl"></div>
    <div class="absolute -bottom-24 -right-20 h-72 w-72 rounded-full bg-primary-soft/25 blur-3xl"></div>

    <div class="relative z-10 mx-auto max-w-screen-2xl px-6 lg:px-8">
        <div class="mx-auto mb-14 max-w-3xl text-center reveal reveal-up">
            <span
                class="inline-flex items-center rounded-full border border-white/20 bg-white/10 px-4 py-1 text-xs font-black tracking-[0.25em] uppercase text-secondary">
                {{ data_get($homeSections, 'vision_mission.label') }}
            </span>
            <h2 class="mt-5 text-3xl font-black leading-tight sm:text-5xl">
                {{ data_get($homeSections, 'vision_mission.title') }}</h2>
            <div class="mt-5 text-sm leading-relaxed text-white/80 sm:text-base lg:text-lg">
                {!! data_get($homeSections, 'vision_mission.description') !!}
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
            {{-- Vision Panel --}}
            <article
                class="relative overflow-hidden rounded-3xl border border-white/15 bg-white/5 p-7 shadow-2xl ring-1 ring-white/10 reveal reveal-left lg:col-span-6 lg:p-10">
                <div
                    class="mb-8 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-secondary text-primary-dark shadow-lg shadow-black/20">
                    <x-heroicon-o-eye class="h-7 w-7" />
                </div>
                <h3 class="text-2xl font-extrabold">{{ data_get($homeSections, 'vision_mission.vision_title') }}</h3>
                <div class="mt-3 h-1 w-20 rounded-full bg-secondary"></div>

                @if ($visionType === 'points')
                    {{-- Vision as Bullet Points (Gallery grid layout) --}}
                    <ol class="mt-8 space-y-4">
                        @foreach ($visionPoints as $index => $point)
                            <li class="group flex items-start gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 transition-all duration-300 hover:border-secondary/60 hover:bg-white/10">
                                <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-secondary font-black text-primary-dark">
                                    {{ $index + 1 }}
                                </span>
                                <p class="leading-relaxed text-white/85 text-sm">{{ $point }}</p>
                            </li>
                        @endforeach
                    </ol>
                @else
                    {{-- Vision as standard Quote (Text mode) --}}
                    <blockquote class="mt-8 border-l-4 border-secondary pl-5 text-xl leading-relaxed text-white/90 italic">
                        "{{ strip_tags($visionText) }}"
                    </blockquote>
                @endif

                {{-- Vision Tagline always shows at the bottom --}}
                @if (data_get($homeSections, 'vision_mission.vision_tagline'))
                    <p class="mt-6 text-sm font-semibold uppercase tracking-[0.2em] text-primary-soft">
                        {{ data_get($homeSections, 'vision_mission.vision_tagline') }}
                    </p>
                @endif
            </article>

            {{-- Mission Panel --}}
            <article
                class="relative overflow-hidden rounded-3xl border border-white/15 bg-primary-dark/35 p-7 shadow-2xl ring-1 ring-white/10 reveal reveal-right reveal-delay-2 lg:col-span-6 lg:p-10">
                <div
                    class="mb-8 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-primary-dark shadow-lg shadow-black/20">
                    <x-heroicon-o-rocket-launch class="h-7 w-7" />
                </div>
                <h3 class="text-2xl font-extrabold">{{ data_get($homeSections, 'vision_mission.mission_title') }}</h3>
                <div class="mt-3 h-1 w-24 rounded-full bg-primary-soft"></div>

                @if ($missionType === 'text')
                    {{-- Mission as standard Quote/RichText (Text mode) --}}
                    <div class="mt-8 text-white/90 leading-relaxed text-lg space-y-4">
                        {!! $missionText !!}
                    </div>
                @else
                    {{-- Mission as Bullet Points (Gallery list layout) --}}
                    <ol class="mt-8 space-y-5">
                        @foreach ($missionPoints as $index => $misi)
                            <li class="group flex items-start gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 transition-all duration-300 hover:border-secondary/60 hover:bg-white/10">
                                <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-secondary font-black text-primary-dark">
                                    {{ $index + 1 }}
                                </span>
                                <p class="leading-relaxed text-white/85 text-sm">{{ $misi }}</p>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </article>
        </div>
    </div>
</section>
