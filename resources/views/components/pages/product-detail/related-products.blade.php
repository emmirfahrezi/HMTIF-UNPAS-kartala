    {{-- Related Products Component --}}
    <section class="py-24 bg-section/30">
        <div class="container mx-auto px-6">
            <div class="flex items-center gap-4 mb-12">
                <div class="h-8 w-2 bg-primary rounded-full"></div>
                <h2 class="text-heading font-black text-3xl uppercase tracking-tighter italic">Produk <span class="text-primary">Eksklusif Lainnya</span></h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php $delay = 1; @endphp
                @foreach([
                    ['name' => 'T-Shirt Oversize HMTIF', 'price' => 'Rp 95.000', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=900&auto=format&fit=crop'],
                    ['name' => 'Lanyard & ID Card Holder', 'price' => 'Rp 35.000', 'image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=900&auto=format&fit=crop'],
                    ['name' => 'Sticker Pack (5 pcs)', 'price' => 'Rp 15.000', 'image' => 'https://images.unsplash.com/photo-1572375927902-1c09e4d5d5cc?q=80&w=900&auto=format&fit=crop'],
                    ['name' => 'Totebag Informatika', 'price' => 'Rp 45.000', 'image' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?q=80&w=900&auto=format&fit=crop'],
                ] as $item)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-700 group reveal reveal-up reveal-delay-{{ $delay++ }}">
                    <div class="relative aspect-square rounded-xl bg-section/50 mb-6 flex items-center justify-center overflow-hidden">
                        <img src="{{ $item['image'] }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $item['name'] }}">
                        <div class="absolute inset-0 bg-primary-dark/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <h5 class="font-bold text-heading text-sm mb-2 uppercase italic tracking-tight group-hover:text-primary transition-colors">{{ $item['name'] }}</h5>
                    <p class="text-primary font-black text-lg tracking-tighter">{{ $item['price'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
