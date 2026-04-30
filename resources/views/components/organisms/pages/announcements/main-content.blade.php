    {{-- Main Content (Search & Grid) --}}
    <div class="lg:col-span-3">
        @props(['announcements'])

        @php
            $search = trim((string) request('search', ''));
            $sort = request('sort', 'latest');
            $news = $announcements;
        @endphp

        {{-- Search & Filter Bar --}}
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 mb-16">
            <div class="flex items-center gap-4">
                <div class="h-8 w-2 bg-primary rounded-full"></div>
                <h2 class="text-heading font-black text-3xl uppercase tracking-tighter italic">Pengumuman <span
                        class="text-primary">Terbaru</span></h2>
            </div>

            <div class="w-full lg:w-auto">
                <form action="{{ route('announcements') }}" method="GET" x-data="announcementFilters()"
                    @submit.prevent="apply($event)" class="flex flex-col sm:flex-row items-center gap-4">
                    @if (request('category_id'))
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                    @endif

                    {{-- Sort Dropdown --}}
                    <div class="w-full sm:w-48">
                        <x-molecules.shared.forms.form-input 
                            type="select"
                            name="sort"
                            :value="$sort"
                            :options="['latest' => 'Terbaru', 'oldest' => 'Terlama', 'az' => 'A - Z', 'za' => 'Z - A']"
                            :transparent="false"
                            :size="'sm'"
                            @change="setTimeout(() => apply($event), 50)"
                        />
                    </div>

                    {{-- Search Input --}}
                    <div class="relative w-full sm:w-[28rem] group">
                        <input type="search" name="search" value="{{ $search }}"
                            placeholder="Cari pengumuman..." @input="onSearchInput($event)" maxlength="50"
                            class="w-full pl-10 pr-16 py-2 rounded-xl bg-white border border-slate-200 focus:ring-4 focus:ring-primary/5 focus:border-primary/20 text-sm font-medium transition-all shadow-sm group-hover:shadow-md outline-none">
                        <x-heroicon-o-magnifying-glass
                            class="absolute left-3.5 top-1/2 -translate-y-1/2 size-4 text-gray-400 group-focus-within:text-primary transition-colors" />
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 hidden sm:flex items-center gap-1 px-2 py-1 bg-slate-50 border border-slate-200 rounded-lg pointer-events-none group-focus-within:opacity-0 transition-opacity">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Ctrl</span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">K</span>
                        </div>
                    </div>

                    @if ($search !== '' || request('category_id') || $sort !== 'latest')
                        <a href="{{ route('announcements') }}"
                            class="shrink-0 font-bold text-primary text-xs uppercase tracking-widest hover:underline transition-all">Reset</a>
                    @endif
                </form>
            </div>
        </div>

        <div id="announcement-grid" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php $delay = 1; @endphp
            @forelse ($news as $item)
                @php
                    $thumbnail = (string) ($item->thumbnail ?? '');
                    $isLocalThumbnail =
                        $thumbnail !== '' &&
                        \Illuminate\Support\Str::startsWith($thumbnail, ['/', 'storage/', 'images/', url('/')]);
                    $announcementImage = $isLocalThumbnail ? $thumbnail : asset('images/placeholders/announcement.svg');
                @endphp
                <x-molecules.pages.cards.news-card :title="$item->title" :date="optional($item->published_at)->translatedFormat('d M Y')" :image="$announcementImage"
                    :href="route('announcements.show', $item->slug)" class="reveal-delay-{{ $delay++ }}" :excerpt="$item->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($item->body), 120)" />
            @empty
                <div class="md:col-span-2 rounded-2xl border border-dashed border-gray-200 bg-white p-8 text-center">
                    <p class="text-sm text-body/60">
                        @if ($search !== '' || request('category_id'))
                            Tidak ada pengumuman yang cocok dengan filter yang sedang aktif.
                        @else
                            Belum ada pengumuman yang tersedia. Jalankan seeder untuk menampilkan data.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>

        <div x-data="{
            loading: false,
            nextUrl: '{{ $news->nextPageUrl() }}',
            async loadMore() {
                if (!this.nextUrl || this.loading) return;
                this.loading = true;
        
                try {
                    const response = await fetch(this.nextUrl);
                    const html = await response.text();
                    const doc = new DOMParser().parseFromString(html, 'text/html');
        
                    const newItems = doc.querySelectorAll('#announcement-grid > *');
                    const nextBtn = doc.querySelector('#announcement-load-more');
                    const grid = document.getElementById('announcement-grid');
        
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
        }" class="mt-12 flex flex-col items-center gap-4">
            <template x-if="nextUrl">
                <button id="announcement-load-more" :data-url="nextUrl" @click="loadMore()"
                    class="inline-flex items-center gap-2 px-8 py-3.5 rounded-lg border border-gray-200 bg-white text-heading font-bold text-sm hover:border-primary hover:text-primary transition-all shadow-sm disabled:opacity-50 group"
                    :disabled="loading">
                    <span x-text="loading ? 'Memuat...' : 'Muat Lebih Banyak'"></span>
                    <x-heroicon-o-arrow-down x-show="!loading"
                        class="size-4 group-hover:translate-y-0.5 transition-transform" />
                    <svg x-show="loading" class="animate-spin size-4" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4" fill="none"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </button>
            </template>

            <span x-show="!nextUrl && '{{ $news->count() }}' > 0"
                class="text-xs font-bold uppercase tracking-widest text-body/50">
                Semua pengumuman sudah ditampilkan
            </span>
        </div>
    </div>

    <script>
        if (typeof announcementFilters === 'undefined') {
            function announcementFilters() {
                return {
                    loading: false,
                    debounceTimer: null,
                    gridSelector: '#announcement-grid',
                    init() {
                        window.addEventListener('keydown', (e) => {
                            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                                e.preventDefault();
                                const searchInput = document.querySelector('input[name="search"]');
                                if (searchInput) searchInput.focus();
                            }
                        });
                    },
                    async apply(e) {
                        const form = e.target instanceof HTMLFormElement ? e.target : e.target.closest('form');
                        const url = new URL(form.action, window.location.origin);
                        const fd = new FormData(form);
                        
                        url.search = '';
                        for (const [k, v] of fd.entries()) {
                            if (v !== '') url.searchParams.set(k, v);
                        }

                        this.loading = true;
                        try {
                            const res = await fetch(url.toString(), {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });
                            const html = await res.text();
                            const doc = new DOMParser().parseFromString(html, 'text/html');
                            
                            const newGrid = doc.querySelector(this.gridSelector);
                            const oldGrid = document.querySelector(this.gridSelector);
                            if (newGrid && oldGrid) oldGrid.replaceWith(newGrid);

                            // For announcements, we don't necessarily need to replace the filter bar
                            // as there are no sticky category buttons here that need active state syncing
                            // (they are in the sidebar)

                            history.replaceState(null, '', url);
                        } catch (err) {
                            console.error('Filter fetch error', err);
                        } finally {
                            this.loading = false;
                        }
                    },
                    onSearchInput(e) {
                        clearTimeout(this.debounceTimer);
                        this.debounceTimer = setTimeout(() => this.apply(e), 500);
                    }
                }
            }
        }
    </script>
