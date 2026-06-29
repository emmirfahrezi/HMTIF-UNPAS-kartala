    {{-- Related Products Component --}}
    @props(['products'])

    <section class="py-24 bg-section/30">
        <div class="container mx-auto px-6">
            <div class="flex items-center gap-4 mb-12">
                <div class="h-8 w-2 bg-primary rounded-full"></div>
                <h2 class="text-heading font-black text-3xl uppercase tracking-tighter italic">Produk <span
                        class="text-primary">Eksklusif Lainnya</span></h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php $delay = 1; @endphp
                @foreach ($products as $item)
                    @php
                        $itemImage = $item->primaryImage?->image_url
                            ?? $item->images()->orderBy('order')->first()?->image_url
                            ?? asset('images/placeholders/product.svg');
                    @endphp
                    <a href="{{ route('store.show', $item->slug) }}"
                        class="block bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-700 group reveal reveal-up reveal-delay-{{ $delay++ }}">
                        <div
                            class="relative aspect-square rounded-xl bg-section/50 mb-6 flex items-center justify-center overflow-hidden">
                            <img src="{{ $itemImage }}"
                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                alt="{{ $item->name }}" data-fallback-src="{{ asset('images/placeholders/product.svg') }}">
                            <div
                                class="absolute inset-0 bg-primary-dark/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                        </div>
                        <h5
                            class="font-bold text-heading text-sm mb-2 uppercase italic tracking-tight group-hover:text-primary transition-colors">
                            {{ $item->name }}</h5>
                        <p class="text-primary font-black text-lg tracking-tighter">Rp
                            {{ number_format((float) $item->price, 0, ',', '.') }}</p>
                    </a>
                @endforeach
            </div>

            @if ($products->isEmpty())
                <p class="text-sm text-body/60 mt-8">Belum ada produk terkait.
                </p>
            @endif
        </div>
    </section>

