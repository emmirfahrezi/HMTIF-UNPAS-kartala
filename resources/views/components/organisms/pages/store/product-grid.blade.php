    {{-- Product Grid --}}
    @props(['products'])

    <section class="py-16 md:py-20 bg-section/30">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <h2 class="sr-only">Daftar Produk</h2>
            <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @php $delay = 1; @endphp
                @foreach ($products as $product)
                    @php
                        $primaryImage = (string) (optional($product->primaryImage)->image_path ?? '');
                        $isLocalImage =
                            $primaryImage !== '' &&
                            \Illuminate\Support\Str::startsWith($primaryImage, ['/', 'storage/', 'images/', url('/')]);
                        $productImage = $isLocalImage ? $primaryImage : asset('images/placeholders/product.svg');
                    @endphp
                    <div
                        class="group bg-white rounded-lg border border-gray-100 shadow-md hover:shadow-xl transition-all duration-700 overflow-hidden flex flex-col hover:-translate-y-2 reveal reveal-up reveal-delay-{{ $delay++ }}">
                        {{-- Product Image Thumbnail --}}
                        <div
                            class="relative aspect-square bg-section/50 flex items-center justify-center group-hover:bg-primary/5 transition-colors overflow-hidden">
                            <div class="absolute inset-0 bg-cover bg-center group-hover:scale-110 transition-transform duration-700 ease-in-out"
                                style="background-image: url('{{ $productImage }}');">
                            </div>
                            <div
                                class="absolute inset-x-0 bottom-0 h-1 bg-primary opacity-0 group-hover:opacity-100 transition-opacity z-20">
                            </div>

                            {{-- Intense Green Inner Shadow --}}
                            <div
                                class="absolute inset-0 z-20 pointer-events-none shadow-[inset_0_0_36px_rgba(36,130,50,0.12)] ring-1 ring-inset ring-primary/5">
                            </div>

                            <div
                                class="absolute inset-0 bg-primary-dark/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10">
                            </div>

                            @if (!$product->is_available)
                                <div
                                    class="absolute top-4 left-4 px-3 py-1 bg-red-500 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded shadow-lg z-30">
                                    Sold Out
                                </div>
                            @elseif($product->created_at && $product->created_at->gt(now()->subWeeks(2)))
                                <div
                                    class="absolute top-4 left-4 px-3 py-1 bg-primary text-white text-[10px] font-black uppercase tracking-[0.2em] rounded shadow-lg z-30">
                                    New
                                </div>
                            @endif

                            {{-- Quick Action Overlay --}}
                            <div
                                class="absolute inset-0 bg-primary-dark/75 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-30">
                                <a href="/product-detail"
                                    class="px-8 py-3 bg-white text-primary rounded-lg text-sm font-bold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-500"
                                    aria-label="Lihat detail produk {{ $product->name }}">
                                    Lihat Produk
                                </a>
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex flex-col gap-1 mb-4">
                                <div class="relative">
                                    <div class="absolute inset-x-0 inset-y-1 bg-gray-50 animate-shimmer rounded-md">
                                    </div>
                                    <h3
                                        class="relative z-10 font-bold text-heading text-lg group-hover:text-primary transition-colors line-clamp-1 leading-tight italic uppercase tracking-tighter">
                                        {{ $product->name }}</h3>
                                </div>
                                <div class="relative inline-block">
                                    <div class="absolute inset-0 bg-gray-50 animate-shimmer rounded-md"></div>
                                    <p
                                        class="relative z-10 text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                                        {{ optional($product->category)->name ?: 'Merchandise' }}</p>
                                </div>
                            </div>

                            <div class="mt-auto flex items-center justify-between gap-4">
                                <div class="flex flex-col">
                                    <span
                                        class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Harga</span>
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gray-50 animate-shimmer rounded-md"></div>
                                        <span class="relative z-10 text-primary font-black text-xl tracking-tighter">Rp
                                            {{ number_format((float) $product->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <button
                                    class="w-12 h-12 rounded-lg bg-gray-50 text-gray-400 hover:bg-primary hover:text-white transition-all shadow-sm flex items-center justify-center border border-gray-100 hover:border-primary group/cart"
                                    aria-label="Tambah {{ $product->name }} ke keranjang">
                                    <x-heroicon-o-shopping-cart
                                        class="size-6 transform group-hover/cart:scale-110 transition-transform"
                                        aria-hidden="true" />
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($products->isEmpty())
                <p class="text-sm text-body/60 mt-8">Belum ada produk. Jalankan seeder untuk menampilkan data.</p>
            @endif
        </div>
    </section>
