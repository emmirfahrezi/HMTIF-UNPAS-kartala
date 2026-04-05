    <section class="sticky top-[84px] z-30 bg-white/70 backdrop-blur-xl border-y border-gray-100 py-4 shadow-sm reveal reveal-left">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="flex items-center justify-between gap-8">
                <div class="flex gap-2 overflow-x-auto pb-1 no-scrollbar">
                    @foreach(['Semua Produk', 'Pakaian', 'Aksesoris', 'Bundling'] as $cat)
                    <button class="shrink-0 px-6 py-2 rounded-lg {{ $cat == 'Semua Produk' ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'bg-gray-50 text-gray-500 hover:bg-primary/10 hover:text-primary border border-transparent hover:border-primary/20' }} text-sm font-bold transition-all">
                        {{ $cat }}
                    </button>
                    @endforeach
                </div>
                <div class="hidden md:flex items-center gap-2 text-sm text-gray-400 font-medium">
                    <x-heroicon-o-funnel class="size-4" />
                    <span>Urutkan: Terbaru</span>
                </div>
            </div>
        </div>
    </section>
