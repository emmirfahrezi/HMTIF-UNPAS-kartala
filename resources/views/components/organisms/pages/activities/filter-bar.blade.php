    {{-- Filter & Search Bar (Sticky & Refined) --}}
    <section class="sticky top-(--nav-height) z-30 bg-white/70 backdrop-blur-xl border-y border-gray-100 py-4 shadow-sm">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex gap-2 overflow-x-auto pb-1 no-scrollbar w-full md:w-auto">
                    @foreach (['Semua', 'Internal', 'Eksternal', 'Akademik'] as $filter)
                        <button
                            class="shrink-0 px-6 py-2 rounded-lg {{ $filter == 'Semua' ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'bg-gray-50 text-gray-500 hover:bg-primary/10 hover:text-primary border border-transparent hover:border-primary/20' }} text-sm font-bold transition-all">
                            {{ $filter }}
                        </button>
                    @endforeach
                </div>
                <div class="relative w-full md:w-80">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <x-heroicon-o-magnifying-glass class="size-5 text-gray-400" />
                    </div>
                    <input type="text"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-100 rounded-lg bg-gray-50/50 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all font-medium"
                        placeholder="Cari info kegiatan...">
                </div>
            </div>
        </div>
    </section>
