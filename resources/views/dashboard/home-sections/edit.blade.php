@php
    $sectionNames = [
        'hero' => 'Bagian Hero (Atas)',
        'identity' => 'Identitas & Harapan',
        'era' => 'Era Baru: Kartala',
        'vision_mission' => 'Visi & Misi',
        'stats' => 'Statistik Pergerakan',
    ];
    $title = 'Edit ' . ($sectionNames[$section] ?? Str::headline($section));
@endphp

<x-layouts.dashboard :pageTitle="$title" :breadcrumbs="[['label' => 'Halaman Utama', 'href' => '/dashboard/home-sections'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/home-sections/{{ $section }}">
        @csrf
        @method('PUT')

        @if($section === 'vision_mission')
            {{-- Grouped layout for Vision & Mission --}}
            @php
                $headerKeys = ['label', 'title', 'description'];
                $visionKeys = ['vision_title', 'vision_text', 'vision_tagline'];
                $missionKeys = ['mission_title', 'mission_text'];
            @endphp

            <div class="space-y-8 max-w-4xl">
                {{-- Header Section --}}
                <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
                    <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-primary pointer-events-none">
                        <x-heroicon-o-flag class="size-32" />
                    </div>

                    <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                        <span class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
                            <x-heroicon-s-information-circle class="size-5" />
                        </span>
                        Header Bagian
                    </h3>

                    <div class="space-y-6">
                        @foreach($headerKeys as $key)
                            @if(isset($fields[$key]))
                                @php $isTextarea = Str::contains(strtolower($key), ['description', 'text', 'tagline']); @endphp
                                <x-molecules.shared.forms.form-input 
                                    :type="$isTextarea ? 'textarea' : 'text'"
                                    :rows="$isTextarea ? 4 : null"
                                    label="{{ Str::headline(str_replace('_', ' ', $key)) }}" 
                                    name="{{ $key }}" 
                                    :value="$fields[$key]->value" 
                                    required />
                            @endif
                        @endforeach
                    </div>
                </div>

                {{-- Visi Section --}}
                <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
                    <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-emerald-500 pointer-events-none">
                        <x-heroicon-o-eye class="size-32" />
                    </div>

                    <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                        <span class="size-8 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-500 flex items-center justify-center">
                            <x-heroicon-s-eye class="size-5" />
                        </span>
                        Visi
                    </h3>

                    <div class="space-y-6">
                        @foreach($visionKeys as $key)
                            @if(isset($fields[$key]))
                                @php $isTextarea = Str::contains(strtolower($key), ['description', 'text', 'tagline']); @endphp
                                <x-molecules.shared.forms.form-input 
                                    :type="$isTextarea ? 'textarea' : 'text'"
                                    :rows="$isTextarea ? 4 : null"
                                    label="{{ Str::headline(str_replace('_', ' ', $key)) }}" 
                                    name="{{ $key }}" 
                                    :value="$fields[$key]->value" 
                                    required />
                            @endif
                        @endforeach
                    </div>
                </div>

                {{-- Misi Section --}}
                <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
                    <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-blue-500 pointer-events-none">
                        <x-heroicon-o-rocket-launch class="size-32" />
                    </div>

                    <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                        <span class="size-8 rounded-xl bg-blue-500/10 dark:bg-blue-500/20 text-blue-500 flex items-center justify-center">
                            <x-heroicon-s-rocket-launch class="size-5" />
                        </span>
                        Misi
                    </h3>

                    <div class="space-y-6">
                        @foreach($missionKeys as $key)
                            @if(isset($fields[$key]))
                                @php $isTextarea = Str::contains(strtolower($key), ['description', 'text', 'tagline']); @endphp
                                <x-molecules.shared.forms.form-input 
                                    :type="$isTextarea ? 'textarea' : 'text'"
                                    :rows="$isTextarea ? 4 : null"
                                    label="{{ Str::headline(str_replace('_', ' ', $key)) }}" 
                                    name="{{ $key }}" 
                                    :value="$fields[$key]->value" 
                                    required />
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

        @else
            {{-- Generic layout for other sections --}}
            @php
                $sectionIcons = [
                    'hero' => ['icon' => 'heroicon-s-sparkles', 'bg' => 'heroicon-o-sparkles', 'color' => 'primary'],
                    'identity' => ['icon' => 'heroicon-s-finger-print', 'bg' => 'heroicon-o-finger-print', 'color' => 'amber-500'],
                    'era' => ['icon' => 'heroicon-s-bolt', 'bg' => 'heroicon-o-bolt', 'color' => 'violet-500'],
                    'stats' => ['icon' => 'heroicon-s-chart-bar', 'bg' => 'heroicon-o-chart-bar', 'color' => 'blue-500'],
                ];
                $iconSet = $sectionIcons[$section] ?? ['icon' => 'heroicon-s-document-text', 'bg' => 'heroicon-o-document-text', 'color' => 'primary'];
            @endphp

            <div class="space-y-8 max-w-4xl">
                <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
                    <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-{{ $iconSet['color'] }} pointer-events-none">
                        <x-dynamic-component :component="$iconSet['bg']" class="size-32" />
                    </div>

                    <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                        <span class="size-8 rounded-xl bg-{{ $iconSet['color'] }}/10 dark:bg-{{ $iconSet['color'] }}/20 text-{{ $iconSet['color'] }} flex items-center justify-center">
                            <x-dynamic-component :component="$iconSet['icon']" class="size-5" />
                        </span>
                        Konten {{ $sectionNames[$section] ?? Str::headline($section) }}
                    </h3>

                    <div class="space-y-6">
                        @foreach($fields as $key => $field)
                            @php
                                $isTextarea = Str::contains(strtolower($key), ['description', 'text', 'tagline']);
                            @endphp

                            <x-molecules.shared.forms.form-input 
                                :type="$isTextarea ? 'textarea' : 'text'"
                                :rows="$isTextarea ? 4 : null"
                                label="{{ Str::headline(str_replace('_', ' ', $key)) }}" 
                                name="{{ $key }}" 
                                :value="$field->value" 
                                required />
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-12 flex items-center justify-end gap-3 max-w-4xl">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/home-sections">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
