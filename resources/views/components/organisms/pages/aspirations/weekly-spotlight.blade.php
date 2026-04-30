    {{-- Weekly Aspiration Spotlight --}}
    @props(['spotlight'])

    <section class="py-16 md:py-20 bg-white">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12 mb-12 md:mb-16">
                <div class="max-w-2xl reveal reveal-left">
                    <span
                        class="inline-block px-4 py-1 bg-primary/10 rounded-full text-primary text-[10px] font-black uppercase tracking-[0.3em] mb-4">Advokasi
                        Kartala</span>
                    <h2 class="text-3xl md:text-5xl font-black text-heading italic uppercase tracking-tighter">Aspirasi
                        <span class="text-primary underline decoration-primary/20">Pekan Ini</span>
                    </h2>
                    <p class="text-gray-500 mt-6 text-lg">Topik-topik krusial yang sedang diperjuangkan oleh Tim Advokasi
                        Himpunan berdasarkan suara terbanyak.</p>
                </div>
                <div
                    class="shrink-0 flex items-center gap-3 px-6 py-3 bg-section rounded-2xl border border-border reveal reveal-right">
                    <div class="w-3 h-3 rounded-full bg-red-500 animate-ping"></div>
                    <span class="text-xs font-black text-heading uppercase tracking-widest italic">Live Advocacy
                        Update</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php $delay = 1; @endphp
                @foreach ($spotlight as $topik)
                    @php
                        $voteCount = $topik->votes_count ?? 0;
                    @endphp
                    <div
                        class="bg-section p-10 rounded-[3rem] border border-border hover:bg-white hover:shadow-2xl transition-all duration-700 group relative overflow-hidden reveal reveal-up reveal-delay-{{ $delay++ }}">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700">
                        </div>

                        <div class="flex items-center justify-between gap-4 mb-10">
                            <div
                                class="w-14 h-14 bg-white rounded-2xl shadow-lg flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all transform group-hover:rotate-12">
                                <x-dynamic-component :component="match ($topik->status) {
                                    'resolved' => 'heroicon-o-check-badge',
                                    'reviewed' => 'heroicon-o-magnifying-glass-circle',
                                    default => 'heroicon-o-clock',
                                }" class="size-7" />
                            </div>
                            <div class="text-right">
                                <span
                                    class="text-3xl font-black text-heading tracking-tighter">{{ $voteCount }}</span>
                                <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest block">Suara
                                    Mendukung</span>
                            </div>
                        </div>

                        <h4
                            class="text-2xl font-black text-heading mb-6 italic uppercase tracking-tighter group-hover:text-primary transition-colors leading-tight">
                            {{ $topik->subject }}</h4>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-primary animate-pulse"></div>
                            <span
                                class="text-[10px] text-primary font-black uppercase tracking-widest">{{ ucfirst($topik->status) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($spotlight->isEmpty())
                <p class="text-sm text-body/60 mt-8">Belum ada aspirasi spotlight. Jalankan seeder untuk menampilkan
                    data.</p>
            @endif
        </div>
    </section>

