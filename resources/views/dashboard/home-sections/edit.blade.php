@php
    $sectionNames = [
        'hero' => 'Bagian Hero (Atas)',
        'identity' => 'Identitas & Harapan',
        'era' => 'Era Baru: Kartala',
        'vision_mission' => 'Visi & Misi',
        'stats' => 'Statistik Pergerakan',
    ];
    $title = 'Edit ' . ($sectionNames[$section] ?? Str::headline($section));
    $richTextKeys = ['description', 'vision_text', 'mission_text'];
@endphp

<x-layouts.dashboard :pageTitle="$title" :breadcrumbs="[['label' => 'Halaman Utama', 'href' => '/dashboard/home-sections'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/home-sections/{{ $section }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                @if($section === 'vision_mission')
                    {{-- Grouped layout for Vision & Mission --}}
                    @php
                        $headerKeys = ['label', 'title', 'description'];
                        $visionTypeValue = isset($fields['vision_type']) ? $fields['vision_type']->value : 'text';
                        $missionTypeValue = isset($fields['mission_type']) ? $fields['mission_type']->value : 'points';
                    @endphp

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
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($headerKeys as $key)
                                    @if(isset($fields[$key]))
                                        @php
                                            $isRichText = in_array($key, $richTextKeys, true);
                                        @endphp
                                        <div class="{{ $isRichText ? 'md:col-span-2' : '' }}">
                                            <x-molecules.shared.forms.form-input 
                                                :type="$isRichText ? 'richtext' : 'text'"
                                                label="{{ Str::headline(str_replace('_', ' ', $key)) }}" 
                                                name="{{ $key }}" 
                                                :value="$fields[$key]->value" 
                                                required />
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Visi Section --}}
                    <div x-data="{ visionType: @js($visionTypeValue) }" class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
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
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- vision_title --}}
                                @if(isset($fields['vision_title']))
                                    <div>
                                        <x-molecules.shared.forms.form-input 
                                            type="text"
                                            label="Judul Visi" 
                                            name="vision_title" 
                                            :value="$fields['vision_title']->value" 
                                            required />
                                    </div>
                                @endif

                                {{-- vision_tagline --}}
                                @if(isset($fields['vision_tagline']))
                                    <div>
                                        <x-molecules.shared.forms.form-input 
                                            type="text"
                                            label="Tagline Visi" 
                                            name="vision_tagline" 
                                            :value="$fields['vision_tagline']->value" 
                                            required />
                                    </div>
                                @endif

                                {{-- vision_type (Placed right above vision_text) --}}
                                <div class="md:col-span-2" @change="visionType = $event.target.value">
                                    <x-molecules.shared.forms.form-input 
                                        type="select"
                                        label="Format Tampilan Visi" 
                                        name="vision_type" 
                                        :value="$visionTypeValue" 
                                        :options="[
                                            'text' => 'Paragraf / Kutipan (Rich Text)',
                                            'points' => 'Poin-Poin Berurutan (Grid/Gallery)'
                                        ]"
                                        required />
                                </div>

                                {{-- vision_text --}}
                                @if(isset($fields['vision_text']))
                                    <div class="md:col-span-2 space-y-2">
                                        <div class="flex items-center justify-between">
                                            <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Teks Visi <span class="text-red-500">*</span></label>
                                            
                                            {{-- Live Mode Badge --}}
                                            <template x-if="visionType === 'points'">
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-500 animate-pulse">
                                                    <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                                    Mode Poin-Poin Aktif
                                                </span>
                                            </template>
                                            <template x-if="visionType !== 'points'">
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-500/10 text-slate-400">
                                                    <span class="size-1.5 rounded-full bg-slate-400"></span>
                                                    Mode Paragraf / Kutipan
                                                </span>
                                            </template>
                                        </div>

                                        {{-- Live Helper Notification Box --}}
                                        <div class="transition-all duration-500 overflow-hidden">
                                            <div x-show="visionType === 'points'" class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-600 dark:text-amber-500 leading-relaxed font-semibold flex gap-2">
                                                <x-heroicon-s-exclamation-triangle class="size-4 shrink-0" />
                                                <span><strong>PENTING:</strong> Karena Visi dalam mode Poin-Poin, silakan tulis poin-poin visi di editor di bawah. **Gunakan tombol ENTER (baris baru)** untuk memisahkan setiap poin.</span>
                                            </div>
                                            <div x-show="visionType !== 'points'" class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-600 dark:text-emerald-500 leading-relaxed font-semibold flex gap-2">
                                                <x-heroicon-s-information-circle class="size-4 shrink-0" />
                                                <span>Visi dalam mode Paragraf. Editor di bawah berfungsi seperti editor rich-text normal. Teks akan tampil sebagai kutipan besar bergaya elegan di landing page.</span>
                                            </div>
                                        </div>

                                        <x-molecules.shared.forms.form-input 
                                            type="richtext"
                                            name="vision_text" 
                                            :value="$fields['vision_text']->value" 
                                            required />
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Misi Section --}}
                    <div x-data="{ missionType: @js($missionTypeValue) }" class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
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
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- mission_title --}}
                                @if(isset($fields['mission_title']))
                                    <div class="md:col-span-2">
                                        <x-molecules.shared.forms.form-input 
                                            type="text"
                                            label="Judul Misi" 
                                            name="mission_title" 
                                            :value="$fields['mission_title']->value" 
                                            required />
                                    </div>
                                @endif

                                {{-- mission_type (Placed right above mission_text) --}}
                                <div class="md:col-span-2" @change="missionType = $event.target.value">
                                    <x-molecules.shared.forms.form-input 
                                        type="select"
                                        label="Format Tampilan Misi" 
                                        name="mission_type" 
                                        :value="$missionTypeValue" 
                                        :options="[
                                            'points' => 'Poin-Poin Berurutan (Grid/Gallery)',
                                            'text' => 'Paragraf / Kutipan (Rich Text)'
                                        ]"
                                        required />
                                </div>

                                {{-- mission_text --}}
                                @if(isset($fields['mission_text']))
                                    <div class="md:col-span-2 space-y-2">
                                        <div class="flex items-center justify-between">
                                            <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Teks Misi <span class="text-red-500">*</span></label>
                                            
                                            {{-- Live Mode Badge --}}
                                            <template x-if="missionType === 'points'">
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-500 animate-pulse">
                                                    <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                                    Mode Poin-Poin Aktif
                                                </span>
                                            </template>
                                            <template x-if="missionType !== 'points'">
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-500/10 text-slate-400">
                                                    <span class="size-1.5 rounded-full bg-slate-400"></span>
                                                    Mode Paragraf / Kutipan
                                                </span>
                                            </template>
                                        </div>

                                        {{-- Live Helper Notification Box --}}
                                        <div class="transition-all duration-500 overflow-hidden">
                                            <div x-show="missionType === 'points'" class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-600 dark:text-amber-500 leading-relaxed font-semibold flex gap-2">
                                                <x-heroicon-s-exclamation-triangle class="size-4 shrink-0" />
                                                <span><strong>PENTING:</strong> Karena Misi dalam mode Poin-Poin, silakan tulis poin-poin misi di editor di bawah. **Gunakan tombol ENTER (baris baru)** untuk memisahkan setiap poin.</span>
                                            </div>
                                            <div x-show="missionType !== 'points'" class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-600 dark:text-emerald-500 leading-relaxed font-semibold flex gap-2">
                                                <x-heroicon-s-information-circle class="size-4 shrink-0" />
                                                <span>Misi dalam mode Paragraf. Editor di bawah berfungsi seperti editor rich-text normal. Teks akan tampil sebagai kutipan besar bergaya elegan di landing page.</span>
                                            </div>
                                        </div>

                                        <x-molecules.shared.forms.form-input 
                                            type="richtext"
                                            name="mission_text" 
                                            :value="$fields['mission_text']->value" 
                                            required />
                                    </div>
                                @endif
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
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($fields as $key => $field)
                                    @php
                                        $isRichText = in_array($key, $richTextKeys, true);
                                    @endphp

                                    <div class="{{ $isRichText ? 'md:col-span-2' : '' }}">
                                        <x-molecules.shared.forms.form-input 
                                            :type="$isRichText ? 'richtext' : 'text'"
                                            label="{{ Str::headline(str_replace('_', ' ', $key)) }}" 
                                            name="{{ $key }}" 
                                            :value="$field->value" 
                                            required />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <aside class="space-y-8">
                <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
                    <div class="absolute top-0 right-0 p-6 opacity-[0.03] text-primary pointer-events-none">
                        <x-heroicon-o-adjustments-horizontal class="size-24" />
                    </div>
                    
                    <h3 class="text-xs font-black text-slate-800 dark:text-white mb-6 uppercase tracking-widest">Ringkasan Konten</h3>

                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Bagian</p>
                            <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $sectionNames[$section] ?? Str::headline($section) }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Jumlah Field</p>
                            <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $fields->count() }} konten</p>
                        </div>
                    </div>
                </div>

                <div class="bg-emerald-50 dark:bg-emerald-500/10 rounded-2xl p-6 border border-emerald-100 dark:border-emerald-500/20">
                    <div class="flex gap-4">
                        <div class="size-10 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-500 flex items-center justify-center shrink-0">
                            <x-heroicon-s-document-text class="size-5" />
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-emerald-600 dark:text-emerald-500 uppercase tracking-widest mb-1">Rich Text</h4>
                            <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                                Field deskripsi dan teks panjang memakai editor rich text. Field pendek seperti tagline, label, dan judul tetap input biasa.
                            </p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3">
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
