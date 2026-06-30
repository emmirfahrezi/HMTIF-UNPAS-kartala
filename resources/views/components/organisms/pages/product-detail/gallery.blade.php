    {{-- Product Gallery Component --}}
    @props(['product'])

    @php
        $fallbackImage = asset('images/placeholders/product.svg');
        $images = ($product?->images ?? collect())->sortBy('order')
            ->map(fn ($image) => $image->image_url)
            ->filter()
            ->values()
            ->all();

        if (empty($images)) {
            $images = [
                $fallbackImage,
                $fallbackImage,
                $fallbackImage,
                $fallbackImage,
            ];
        }
    @endphp

    <div
        x-data="{
            activeImage: @js($images[0]),
            fallbackImage: @js($fallbackImage),
            selectImage(image) {
                this.activeImage = image || this.fallbackImage;
            },
            useFallbackImage() {
                if (this.activeImage !== this.fallbackImage) {
                    this.activeImage = this.fallbackImage;
                }
            },
        }"
        class="flex flex-col gap-6 reveal reveal-left">
        {{-- Main Image Container --}}
        <div
            class="relative rounded-3xl overflow-hidden shadow-2xl aspect-square bg-section/50 border border-gray-100 group transition-all duration-500">
            <div
                class="absolute inset-0 z-20 pointer-events-none shadow-[inset_0_0_80px_rgba(36,130,50,0.15)] ring-1 ring-inset ring-primary/5">
            </div>

            <img src="{{ $images[0] }}" x-bind:src="activeImage" alt="Main Product Image"
                class="w-full h-full object-cover transition-opacity duration-500 ease-in-out" id="mainProductImage"
                data-fallback-src="{{ $fallbackImage }}"
                x-on:error="useFallbackImage()">

            <div
                class="absolute top-6 left-6 px-4 py-2 bg-primary text-white text-[10px] font-black uppercase tracking-[0.2em] rounded shadow-lg z-30">
                Best Seller
            </div>
        </div>

        {{-- Interactive Thumbnails --}}
        <div class="grid grid-cols-4 gap-4">
            @foreach ($images as $index => $img)
                <button type="button"
                    class="gallery-thumbnail aspect-square rounded-2xl bg-section border-2 overflow-hidden cursor-pointer transition-all duration-300 transform hover:scale-105"
                    x-on:click="selectImage(@js($img))"
                    :class="activeImage === @js($img) ? 'border-primary ring-4 ring-primary/10' : 'border-gray-50'"
                    :aria-pressed="activeImage === @js($img) ? 'true' : 'false'"
                    aria-label="Tampilkan gambar produk {{ $index + 1 }}">
                    <img src="{{ $img }}"
                        class="w-full h-full object-cover opacity-80 hover:opacity-100 transition-opacity"
                        loading="lazy" decoding="async"
                        data-fallback-src="{{ $fallbackImage }}">
                </button>
            @endforeach
        </div>
    </div>

