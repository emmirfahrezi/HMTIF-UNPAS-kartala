    {{-- Program List Grid --}}
    @php
        $activities = \App\Models\Activity::query()
            ->select(['id', 'title', 'slug', 'description', 'thumbnail', 'start_date', 'status'])
            ->latest('start_date')
            ->latest('id')
            ->cursorPaginate(9)
            ->withQueryString();

        $statusLabel = [
            'upcoming' => 'Mendatang',
            'ongoing' => 'Berjalan',
            'past' => 'Selesai',
        ];
    @endphp

    <section class="py-24 bg-section/30">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div id="activity-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php $delay = 1; @endphp
                @foreach ($activities as $item)
                    @php
                        $thumbnail = (string) ($item->thumbnail ?? '');
                        $isLocalThumbnail =
                            $thumbnail !== '' &&
                            \Illuminate\Support\Str::startsWith($thumbnail, ['/', 'storage/', 'images/', url('/')]);
                        $activityImage = $isLocalThumbnail ? $thumbnail : asset('images/placeholders/activity.svg');
                    @endphp
                    <div
                        class="group relative bg-white rounded-lg border border-gray-100 shadow-md hover:shadow-xl transition-all duration-700 flex flex-col overflow-hidden hover:-translate-y-2 reveal reveal-up reveal-delay-{{ $delay++ }}">
                        {{-- Card Background Decoration --}}
                        <div
                            class="absolute inset-x-0 bottom-0 h-1 bg-linear-to-r from-primary to-primary-soft opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>

                        {{-- Thumbnail Wrapper --}}
                        <div class="relative h-56 bg-primary/5 flex items-center justify-center overflow-hidden">
                            <div class="absolute inset-0 bg-cover bg-center group-hover:scale-110 transition-transform duration-700 ease-in-out"
                                style="background-image: url('{{ $activityImage }}');">
                            </div>
                            <div
                                class="absolute inset-0 bg-linear-to-t from-primary-dark/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>

                            <div
                                class="absolute top-4 right-4 px-3 py-1 bg-white/95 rounded-lg text-[10px] font-bold text-primary uppercase tracking-wider border border-primary/10 shadow-sm z-10">
                                {{ $statusLabel[$item->status] ?? 'Kegiatan' }}
                            </div>
                        </div>

                        <div class="p-8 flex flex-col flex-1">
                            <div class="relative inline-flex items-center gap-2 mb-3">
                                <div class="absolute inset-0 bg-gray-50 animate-shimmer rounded-md"></div>
                                <div
                                    class="relative z-10 flex items-center gap-2 text-[10px] text-primary font-bold uppercase tracking-widest leading-none">
                                    <x-heroicon-s-calendar class="size-3" />
                                    {{ optional($item->start_date)->translatedFormat('d M Y') }}
                                </div>
                            </div>
                            <div class="relative mb-4">
                                <div class="absolute inset-x-0 inset-y-1 bg-gray-50 animate-shimmer rounded-md"></div>
                                <h2
                                    class="relative z-10 text-xl font-bold text-heading group-hover:text-primary transition-colors leading-tight">
                                    {{ $item->title }}</h2>
                            </div>
                            <div class="relative mb-6 flex-1">
                                <div class="absolute inset-0 bg-gray-50 animate-shimmer rounded-md"></div>
                                <p class="relative z-10 text-sm text-gray-500 leading-relaxed">
                                    {{ \Illuminate\Support\Str::limit($item->description, 120) }}
                                </p>
                            </div>
                            <a href="/activity-detail"
                                class="inline-flex items-center gap-2 text-sm font-bold text-primary group/link">
                                <span class="relative">
                                    Selengkapnya
                                    <span
                                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary group-hover/link:w-full transition-all duration-300"></span>
                                </span>
                                <x-heroicon-o-arrow-long-right
                                    class="size-4 group-hover/link:translate-x-1 transition-transform" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($activities->isEmpty())
                <p class="text-sm text-body/60 mt-8">Belum ada kegiatan. Jalankan seeder untuk menampilkan data.</p>
            @endif

            {{-- Load More Section --}}
            <div id="activity-load-more-container" class="mt-20 flex flex-col items-center">
                <div class="h-px w-24 bg-gray-200 mb-8"></div>
                @if ($activities->hasMorePages())
                    <a id="activity-load-more" href="{{ $activities->nextPageUrl() }}"
                        class="inline-flex items-center gap-2 px-8 py-3.5 rounded-lg border border-gray-200 bg-white text-heading font-bold text-sm hover:border-primary hover:text-primary transition-all shadow-sm">
                        Muat Lebih Banyak
                        <x-heroicon-o-arrow-down class="size-4" />
                    </a>
                @elseif ($activities->count() > 0)
                    <span class="text-xs font-bold uppercase tracking-widest text-body/50">Semua kegiatan sudah
                        ditampilkan</span>
                @endif
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const grid = document.getElementById('activity-grid');
                    const container = document.getElementById('activity-load-more-container');

                    if (!grid || !container) return;

                    const bindLoadMore = () => {
                        const loadMore = document.getElementById('activity-load-more');
                        if (!loadMore) return;

                        loadMore.addEventListener('click', async (event) => {
                            event.preventDefault();

                            const nextUrl = loadMore.getAttribute('href');
                            if (!nextUrl) return;

                            loadMore.classList.add('pointer-events-none', 'opacity-60');

                            try {
                                const response = await fetch(nextUrl, {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                    },
                                });

                                if (!response.ok) throw new Error('Failed to load more activities');

                                const html = await response.text();
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');

                                const incomingCards = doc.querySelectorAll('#activity-grid > *');
                                incomingCards.forEach((card) => {
                                    grid.appendChild(card);
                                });

                                const incomingContainer = doc.getElementById(
                                    'activity-load-more-container');
                                if (incomingContainer) {
                                    container.innerHTML = incomingContainer.innerHTML;
                                    bindLoadMore();
                                }
                            } catch (error) {
                                loadMore.classList.remove('pointer-events-none', 'opacity-60');
                            }
                        });
                    };

                    bindLoadMore();
                });
            </script>
        </div>
    </section>
