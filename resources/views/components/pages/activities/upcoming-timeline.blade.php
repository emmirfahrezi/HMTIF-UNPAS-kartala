    {{-- Upcoming Highlight Timeline --}}
    @php
        $timelineActivities = \App\Models\Activity::query()
            ->where('status', 'upcoming')
            ->orderBy('start_date')
            ->take(4)
            ->get();

        $statusToColor = [
            'upcoming' => 'primary',
            'ongoing' => 'blue',
            'past' => 'red',
        ];
    @endphp

    <section class="py-16 bg-section/30 overflow-hidden">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="flex items-center gap-4 mb-10 overflow-hidden reveal reveal-left">
                <span class="w-12 h-px bg-primary/20"></span>
                <h2 class="text-xl font-black text-heading italic uppercase tracking-tighter">Timeline <span
                        class="text-primary italic">Mendatang</span></h2>
                <span class="flex-1 h-px bg-gray-100 italic font-black uppercase tracking-widest text-[10px]">Geser untuk
                    melihat agenda >></span>
            </div>

            <div class="flex gap-6 overflow-x-auto pb-8 no-scrollbar -mx-4 px-4 snap-x snap-mandatory">
                @php $delay = 1; @endphp
                @foreach ($timelineActivities as $timeline)
                    @php
                        $month = optional($timeline->start_date)->translatedFormat('M');
                        $day = optional($timeline->start_date)->format('d');
                        $color = $statusToColor[$timeline->status] ?? 'primary';
                    @endphp
                    <div class="shrink-0 w-80 snap-center reveal reveal-up reveal-delay-{{ $delay++ }}">
                        <div
                            class="group bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-500 relative overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-{{ $color == 'primary' ? 'primary' : $color . '-500' }}/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700">
                            </div>

                            <div class="flex items-start justify-between mb-8">
                                <div class="relative flex flex-col items-center">
                                    <div class="absolute inset-x-0 -inset-y-1 bg-gray-50 animate-shimmer rounded-md">
                                    </div>
                                    <span
                                        class="relative z-10 text-xs font-black text-primary uppercase tracking-widest">{{ $month }}</span>
                                    <span
                                        class="relative z-10 text-4xl font-black text-heading tracking-tighter">{{ $day }}</span>
                                </div>
                                <span
                                    class="px-3 py-1 bg-gray-50 border border-gray-100 rounded-lg text-[9px] font-black uppercase tracking-widest text-gray-400 group-hover:bg-primary group-hover:text-white transition-all">
                                    {{ ucfirst($timeline->status) }}
                                </span>
                            </div>

                            <div class="flex flex-col gap-1 mb-4">
                                <div class="relative">
                                    <div class="absolute inset-x-0 inset-y-1 bg-gray-50 animate-shimmer rounded-md">
                                    </div>
                                    <h2
                                        class="relative z-10 font-bold text-heading text-lg group-hover:text-primary transition-colors line-clamp-1 leading-tight italic uppercase tracking-tighter">
                                        {{ $timeline->title }}</h2>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-2 h-2 rounded-full bg-{{ $color == 'primary' ? 'primary' : $color . '-500' }}">
                                </div>
                                <span
                                    class="text-[10px] text-gray-400 font-bold uppercase tracking-widest group-hover:text-gray-600 transition-colors">Terkonfirmasi</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($timelineActivities->isEmpty())
                <p class="text-sm text-body/60 mt-4">Belum ada agenda mendatang. Jalankan seeder untuk menampilkan data.
                </p>
            @endif
        </div>
    </section>
