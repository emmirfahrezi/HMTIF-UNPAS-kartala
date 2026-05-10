<x-layouts.dashboard pageTitle="Halaman Utama" :breadcrumbs="[['label' => 'Konten'], ['label' => 'Halaman Utama']]">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $sectionNames = [
                'hero' => 'Bagian Hero (Atas)',
                'identity' => 'Identitas & Harapan',
                'era' => 'Era Baru: Kartala',
                'vision_mission' => 'Visi & Misi',
                'stats' => 'Statistik Pergerakan',
            ];
            $sectionIcons = [
                'hero' => 'heroicon-o-sparkles',
                'identity' => 'heroicon-o-finger-print',
                'era' => 'heroicon-o-bolt',
                'vision_mission' => 'heroicon-o-flag',
                'stats' => 'heroicon-o-chart-bar',
            ];
        @endphp

        @foreach($sections as $key => $fields)
            <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300 flex flex-col h-full">
                <div class="absolute top-0 right-0 p-6 opacity-[0.03] text-primary pointer-events-none">
                    <x-dynamic-component :component="$sectionIcons[$key] ?? 'heroicon-o-document-text'" class="size-24" />
                </div>
                
                <h3 class="text-lg font-black text-slate-800 dark:text-white mb-2 flex items-center gap-3">
                    <span class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center shrink-0">
                        <x-dynamic-component :component="$sectionIcons[$key] ?? 'heroicon-o-document-text'" class="size-5" />
                    </span>
                    {{ $sectionNames[$key] ?? Str::headline($key) }}
                </h3>
                
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-6 flex-1 leading-relaxed">
                    Kelola konten teks untuk bagian {{ strtolower($sectionNames[$key] ?? Str::headline($key)) }} di halaman utama website.
                </p>

                <div class="pt-4 border-t border-slate-100 dark:border-slate-800 mt-auto">
                    <x-atoms.shared.button 
                        href="/dashboard/home-sections/{{ $key }}/edit" 
                        variant="soft" 
                        class="w-full justify-center">
                        <x-heroicon-o-pencil-square class="size-4 mr-2" />
                        Edit Konten
                    </x-atoms.shared.button>
                </div>
            </div>
        @endforeach
    </div>

</x-layouts.dashboard>
