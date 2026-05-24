    @props(['categories'])

    @php
        $currentCategory = request('category');
        $search = request('search');
        $sort = request('sort', 'latest');
    @endphp

    <section id="store-filter-bar" class="sticky top-24 z-30 bg-white border-b border-slate-200 py-3 shadow-sm mt-2 transition-all duration-500">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <form action="{{ route('store') }}" method="GET" x-data="storeFilters()" id="store-filter-form"
                class="flex flex-col lg:flex-row justify-between items-center gap-6">
                {{-- Left: Categories --}}
                <div class="flex items-center gap-4 w-full lg:w-auto overflow-x-auto custom-scrollbar pb-1 lg:pb-0">
                    <input type="hidden" name="category" id="category-filter" value="{{ $currentCategory }}">
                    <div class="flex gap-2">
                        <button type="button" 
                            @click="document.getElementById('category-filter').value = ''; apply($event)"
                            class="shrink-0 px-4 py-2 rounded-xl transition-all duration-300 text-sm font-bold {{ !$currentCategory ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-white text-slate-600 border border-slate-200 hover:border-primary/50 hover:text-primary shadow-sm' }}">
                            Semua Produk
                        </button>
                        @foreach ($categories as $cat)
                            <button type="button" 
                                @click="document.getElementById('category-filter').value = '{{ $cat->slug }}'; apply($event)"
                                class="shrink-0 px-4 py-2 rounded-xl transition-all duration-300 text-sm font-bold {{ $currentCategory == $cat->slug ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-white text-slate-600 border border-slate-200 hover:border-primary/50 hover:text-primary shadow-sm' }}">
                                {{ $cat->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Right: Search & Sort --}}
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto">
                    {{-- Sort Dropdown --}}
                    <div class="w-full sm:w-52">
                        <x-molecules.shared.forms.form-input 
                            type="select"
                            name="sort"
                            :value="$sort"
                            :options="[
                                'latest' => 'Terbaru', 
                                'oldest' => 'Terlama', 
                                'price_low' => 'Harga Terendah',
                                'price_high' => 'Harga Tertinggi'
                            ]"
                            :transparent="false"
                            :size="'sm'"
                            @change="setTimeout(() => apply($event), 50)"
                        />
                    </div>

                    {{-- Search Input --}}
                    <div class="relative w-full sm:w-[28rem] group">
                        <input type="search" name="search" value="{{ $search }}" placeholder="Cari produk..."
                            @input="onSearchInput($event)" maxlength="50"
                            class="w-full pl-10 pr-16 py-2 bg-white border border-slate-200 focus:border-primary focus:ring-4 focus:ring-primary/10 rounded-xl text-sm font-medium transition-all placeholder:text-slate-400 shadow-sm hover:border-slate-300 outline-none">
                        <x-heroicon-o-magnifying-glass
                            class="absolute left-3.5 top-1/2 -translate-y-1/2 size-4 text-gray-400 group-focus-within:text-primary transition-colors" />
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 hidden sm:flex items-center gap-1 px-2 py-1 bg-slate-50 border border-slate-200 rounded-lg pointer-events-none group-focus-within:opacity-0 transition-opacity">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Ctrl</span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">K</span>
                        </div>
                    </div>

                    @if ($currentCategory || $search || $sort !== 'latest')
                        <a href="{{ route('store') }}"
                            class="shrink-0 text-xs font-black uppercase tracking-widest text-primary hover:underline transition-all">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </section>

    <script>
        if (typeof storeFilters === 'undefined') {
            function storeFilters() {
                return {
                    loading: false,
                    debounceTimer: null,
                    gridSelector: '#product-grid',
                    filterBarSelector: '#store-filter-bar',
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
                        const form = document.getElementById('store-filter-form');
                        const url = new URL(form.action, window.location.origin);
                        const fd = new FormData(form);
                        
                        url.search = '';
                        for (const [k, v] of fd.entries()) {
                            if (v !== '') url.searchParams.set(k, v);
                        }

                        this.loading = true;
                        window.location.href = url.toString();
                    },
                    onSearchInput(e) {
                        clearTimeout(this.debounceTimer);
                        this.debounceTimer = setTimeout(() => this.apply(e), 500);
                    }
                }
            }
        }
    </script>
