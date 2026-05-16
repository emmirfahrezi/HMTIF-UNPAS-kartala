    {{-- Program List Grid --}}
    @props(['activities'])

    @php
        $statusLabel = [
            'upcoming' => 'Mendatang',
            'ongoing' => 'Berlangsung',
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
                                <div
                                    class="relative z-10 flex items-center gap-2 text-[10px] text-primary font-bold uppercase tracking-widest leading-none">
                                    <x-heroicon-s-calendar class="size-3" />
                                    {{ optional($item->start_date)->translatedFormat('d M Y') }}
                                </div>
                            </div>
                            <div class="relative mb-4">
                                <h2
                                    class="relative z-10 text-xl font-bold text-heading group-hover:text-primary transition-colors leading-tight">
                                    {{ $item->title }}</h2>
                            </div>
                            <div class="relative mb-6 flex-1">
                                <p class="relative z-10 text-sm text-gray-500 leading-relaxed">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 120) }}
                                </p>
                            </div>
                            <a href="{{ route('activities.show', $item->slug) }}"
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
                <p class="text-sm text-body/60 mt-8 text-center">Belum ada kegiatan yang tersedia.</p>
            @endif

            {{-- Load More Section --}}
            <div 
                x-data="{ 
                    loading: false, 
                    nextUrl: '{{ $activities->nextPageUrl() }}',
                    async loadMore() {
                        if (!this.nextUrl || this.loading) return;
                        this.loading = true;
                        
                        try {
                            const response = await fetch(this.nextUrl);
                            const html = await response.text();
                            const doc = new DOMParser().parseFromString(html, 'text/html');
                            
                            const newItems = doc.querySelectorAll('#activity-grid > *');
                            const nextBtn = doc.querySelector('#activity-load-more');
                            const grid = document.getElementById('activity-grid');
                            
                            newItems.forEach(item => {
                                item.classList.remove('active');
                                grid.appendChild(item);
                                
                                if (window.IntersectionObserver) {
                                    const observer = new IntersectionObserver((entries) => {
                                        entries.forEach(entry => {
                                            if (entry.isIntersecting) {
                                                entry.target.classList.add('active');
                                                observer.unobserve(entry.target);
                                            }
                                        });
                                    }, { threshold: 0.1 });
                                    observer.observe(item);
                                }
                            });

                            this.nextUrl = nextBtn ? nextBtn.dataset.url : null;
                        } catch (e) {
                            console.error(e);
                        } finally {
                            this.loading = false;
                        }
                    }
                }"
                class="mt-20 flex flex-col items-center"
            >
                <div class="h-px w-24 bg-slate-200 mb-8"></div>
                
                <template x-if="nextUrl">
                    <button 
                        id="activity-load-more"
                        :data-url="nextUrl"
                        @click="loadMore()"
                        class="inline-flex items-center gap-3 px-10 py-4 rounded-2xl border border-slate-200 bg-white text-slate-900 font-bold text-sm hover:border-primary hover:text-primary transition-all shadow-sm active:scale-95 disabled:opacity-50 group"
                        :disabled="loading"
                    >
                        <span x-text="loading ? 'Memuat...' : 'Muat Lebih Banyak'"></span>
                        <x-heroicon-o-arrow-down x-show="!loading" class="size-4 group-hover:translate-y-0.5 transition-transform" />
                        <svg x-show="loading" class="animate-spin size-4" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </template>

                <div x-show="!nextUrl && '{{ $activities->count() }}' > 0" class="text-xs font-bold uppercase tracking-widest text-slate-400">
                    Semua kegiatan sudah ditampilkan
                </div>
            </div>
        </div>
    </section>
