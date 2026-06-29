@props(['activities'])

<div id="activities" class="py-24 bg-section/30 relative overflow-hidden content-auto">
    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10">
        
        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="max-w-2xl reveal reveal-left">
                <x-atoms.pages.section-title>Agenda Terdekat</x-atoms.section-title>
                <h2 class="text-3xl md:text-4xl font-extrabold text-heading mt-4 leading-tight uppercase italic tracking-tighter">
                    Jangan Lewatkan <span class="text-primary text-2xl md:text-4xl">Momentum Seru Kami</span>
                </h2>
            </div>
            <a href="/activities"
                class="group inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-border text-heading font-bold hover:bg-primary hover:text-white hover:border-primary hover:gap-3 transition-all reveal reveal-right shrink-0">
                Lihat Semua Kegiatan
                <x-heroicon-o-arrow-right class="size-5" />
            </a>
        </div>

        @php
            // 1. Cari kegiatan yang berlangsung HARI INI
            $todayActivity = $activities->first(function ($item) {
                return optional($item->start_date)->isToday();
            });

            // 2. Fallback: pin kegiatan terdekat pertama
            $pinnedActivity = $todayActivity ?: $activities->first();

            // 3. Masukkan sisa kegiatan lainnya ke dalam carousel
            $carouselActivities = $activities->reject(function ($item) use ($pinnedActivity) {
                return $pinnedActivity && $item->id === $pinnedActivity->id;
            });
        @endphp

        @if ($activities->isNotEmpty())
            @if ($carouselActivities->isEmpty())
                <div class="max-w-3xl mx-auto reveal reveal-up">
                    <div x-data x-on:click="window.location.href='{{ route('activities.show', $pinnedActivity->slug) }}'"
                         class="relative min-h-[420px] rounded-3xl overflow-hidden shadow-xl border border-slate-100 dark:border-slate-800/80 group flex flex-col justify-end p-8 transition-all duration-700 hover:-translate-y-2 cursor-pointer">
                        <div class="absolute inset-0 overflow-hidden">
                            <img src="{{ $pinnedActivity->thumbnail_url }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                 alt="{{ $pinnedActivity->title }}"
                                 data-fallback-src="{{ asset('images/placeholders/activity.svg') }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
                        </div>
                        
                        <div class="relative z-10 space-y-4">
                            <div class="flex items-center gap-3">
                                @if (optional($pinnedActivity->start_date)->isToday())
                                    <span class="px-3 py-1 bg-red-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg animate-pulse">
                                        Hari Ini
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-primary text-white text-[9px] font-black uppercase tracking-widest rounded-lg">
                                        Terdekat
                                    </span>
                                @endif
                                <span class="text-white/70 text-[10px] font-bold uppercase tracking-widest flex items-center gap-1">
                                    <x-heroicon-o-calendar class="size-3" />
                                    {{ optional($pinnedActivity->start_date)->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            
                            <h3 class="text-2xl md:text-3xl font-black italic uppercase tracking-tighter text-white group-hover:text-primary transition-colors leading-tight">
                                {{ $pinnedActivity->title }}
                            </h3>
                            
                            <p class="text-white/75 text-xs max-w-2xl line-clamp-2 leading-relaxed">
                                {{ strip_tags($pinnedActivity->description) }}
                            </p>
                            
                            <div class="pt-2">
                                <a href="{{ route('activities.show', $pinnedActivity->slug) }}" 
                                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary/95 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition-all hover:gap-3 active:scale-95 shadow-lg shadow-primary/20">
                                    Detail Info
                                    <x-heroicon-o-arrow-right class="size-4" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Case B: Split Layout ala Petronas.com --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                    
                    {{-- Sisi Kiri: Pinned Spotlight Card (40% width) --}}
                    <div class="lg:col-span-5 flex reveal reveal-left">
                        <div x-data x-on:click="window.location.href='{{ route('activities.show', $pinnedActivity->slug) }}'"
                             class="relative w-full min-h-[460px] lg:min-h-full rounded-3xl overflow-hidden shadow-xl border border-slate-100 dark:border-slate-800/80 group flex flex-col justify-end p-8 transition-all duration-700 hover:-translate-y-2 cursor-pointer">
                            <div class="absolute inset-0 overflow-hidden">
                                <img src="{{ $pinnedActivity->thumbnail_url }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                     alt="{{ $pinnedActivity->title }}"
                                     data-fallback-src="{{ asset('images/placeholders/activity.svg') }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/45 to-transparent"></div>
                            </div>
                            
                            <div class="relative z-10 space-y-4">
                                <div class="flex items-center gap-3">
                                    @if (optional($pinnedActivity->start_date)->isToday())
                                        <span class="px-3 py-1 bg-red-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg animate-pulse">
                                            Hari Ini
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-primary text-white text-[9px] font-black uppercase tracking-widest rounded-lg">
                                            Terdekat
                                        </span>
                                    @endif
                                    <span class="text-white/70 text-[10px] font-bold uppercase tracking-widest flex items-center gap-1">
                                        <x-heroicon-o-calendar class="size-3" />
                                        {{ optional($pinnedActivity->start_date)->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                                
                                <h3 class="text-2xl md:text-3xl font-black italic uppercase tracking-tighter text-white group-hover:text-primary transition-colors leading-tight">
                                    {{ $pinnedActivity->title }}
                                </h3>
                                
                                <p class="text-white/75 text-xs line-clamp-2 leading-relaxed">
                                    {{ strip_tags($pinnedActivity->description) }}
                                </p>
                                
                                <div class="pt-2">
                                    <a href="{{ route('activities.show', $pinnedActivity->slug) }}" 
                                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary/95 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition-all hover:gap-3 active:scale-95 shadow-lg shadow-primary/20">
                                        Detail Info
                                        <x-heroicon-o-arrow-right class="size-4" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sisi Kanan: Running Carousel Card Slider (60% width) --}}
                    <div x-data="{
                        scroll(direction) {
                            const container = this.$refs.slider;
                            const cardWidth = container.querySelector('.carousel-card').offsetWidth + 24; // width + gap
                            container.scrollBy({ left: direction * cardWidth, behavior: 'smooth' });
                        }
                    }" class="lg:col-span-7 flex flex-col justify-between gap-4 reveal reveal-right">
                        
                        {{-- Carousel Header / Navigation Buttons --}}
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Agenda Lainnya</span>
                            
                            {{-- Arrow Buttons --}}
                            <div class="flex items-center gap-1.5">
                                <button type="button" @click="scroll(-1)" 
                                    class="size-8 rounded-full border border-slate-200 dark:border-slate-800/80 flex items-center justify-center text-slate-600 dark:text-slate-400 bg-white dark:bg-slate-900/50 hover:bg-primary hover:text-white hover:border-primary transition-all active:scale-90 shadow-sm">
                                    <x-heroicon-o-chevron-left class="size-4" />
                                </button>
                                <button type="button" @click="scroll(1)" 
                                    class="size-8 rounded-full border border-slate-200 dark:border-slate-800/80 flex items-center justify-center text-slate-600 dark:text-slate-400 bg-white dark:bg-slate-900/50 hover:bg-primary hover:text-white hover:border-primary transition-all active:scale-90 shadow-sm">
                                    <x-heroicon-o-chevron-right class="size-4" />
                                </button>
                            </div>
                        </div>

                        {{-- Horizontal Scroll Container --}}
                        <div x-ref="slider" class="flex overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar gap-6 pb-4">
                            @foreach ($carouselActivities as $item)
                                <div x-data x-on:click="window.location.href='{{ route('activities.show', $item->slug) }}'"
                                     class="carousel-card snap-start shrink-0 w-[290px] md:w-[320px] bg-white dark:bg-slate-900/20 rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-800/80 shadow-md transition-all duration-700 hover:-translate-y-2 group flex flex-col justify-between cursor-pointer">
                                    
                                    {{-- Image Header --}}
                                    <div class="relative h-40 overflow-hidden">
                                        <img src="{{ $item->thumbnail_url }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                            alt="{{ $item->title }}"
                                            data-fallback-src="{{ asset('images/placeholders/activity.svg') }}">
                                        <div class="absolute top-3 left-3">
                                            <span class="px-2.5 py-0.5 bg-white/95 dark:bg-slate-950/90 backdrop-blur-md text-primary text-[9px] font-black uppercase tracking-wider rounded-md border border-primary/10 italic">
                                                {{ $item->status_label }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    {{-- Content Body --}}
                                    <div class="p-5 flex-grow flex flex-col justify-between gap-4">
                                        <div class="space-y-2">
                                            <div class="inline-flex items-center gap-1.5 text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-widest">
                                                <x-heroicon-o-calendar class="size-3" />
                                                {{ optional($item->start_date)->translatedFormat('d M Y') }}
                                            </div>
                                            <h4 class="text-base font-extrabold text-heading group-hover:text-primary transition-colors italic uppercase tracking-tighter line-clamp-1 leading-snug">
                                                {{ $item->title }}
                                            </h4>
                                            <p class="text-xs text-body/70 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                                {{ strip_tags($item->description) }}
                                            </p>
                                        </div>
                                        
                                        <div>
                                            <a href="{{ route('activities.show', $item->slug) }}" 
                                               class="inline-flex items-center gap-1 text-xs font-bold text-slate-400 group-hover:text-primary transition-all"
                                               aria-label="Lihat detail kegiatan {{ $item->title }}">
                                                Detail Info
                                                <x-heroicon-o-chevron-right class="size-3.5 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @else
            {{-- Case C: Agenda Kosong --}}
            <p class="text-sm text-body/60 mt-8">Belum ada kegiatan yang tersedia saat ini.</p>
        @endif
    </div>
</div>
