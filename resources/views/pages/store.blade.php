<x-layout 
    title="HMTIF Store | Official Merch" 
    description="Dapatkan atribut resmi dan merchandise eksklusif HMTIF UNPAS. Dukung identitas almamater dengan produk berkualitas dari Niaga Kartala."
    keywords="HMTIF Store, Merchandise Informatika, Jaket HMTIF, Atribut Teknik Informatika"
    :transparent="false"
>
    <x-slot:head>
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "BreadcrumbList",
            "itemListElement": [{
                "@@type": "ListItem",
                "position": 1,
                "name": "Beranda",
                "item": "{{ url('/') }}"
            },{
                "@@type": "ListItem",
                "position": 2,
                "name": "Niaga Kartala",
                "item": "{{ url()->current() }}"
            }]
        }
        </script>
    </x-slot:head>
    {{-- Hero Section --}}
    <x-molecules.sections.page-hero 
        badge="Official Merchandise"
        title="Niaga"
        highlight="Kartala"
        description="koleksi merchandise eksklusif dan atribut resmi hmtif unpas. teknik informatika progresif."
    />
    
    {{-- Category Strip --}}
    <section class="sticky top-[84px] z-30 bg-white/70 backdrop-blur-xl border-y border-gray-100 py-4 shadow-sm">
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

    {{-- Product Grid --}}
    <section class="py-24 bg-section/30">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <h2 class="sr-only">Daftar Produk</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['name' => 'Hoodie Kabinet Kartala 2024', 'price' => 'Rp 185.000', 'tag' => 'Best Seller', 'icon' => 'tag', 'desc' => 'Cotton Fleece Premium'],
                    ['name' => 'T-Shirt Oversize HMTIF', 'price' => 'Rp 95.000', 'tag' => 'Limited', 'icon' => 'sparkles', 'desc' => 'Cotton Combed 24s'],
                    ['name' => 'Lanyard & ID Card Holder', 'price' => 'Rp 35.000', 'tag' => 'New Arrival', 'icon' => 'bolt', 'desc' => 'Polyester High Quality'],
                    ['name' => 'Sticker Pack (5 pcs)', 'price' => 'Rp 15.000', 'tag' => 'Popular', 'icon' => 'fire', 'desc' => 'Vinyl Matte Waterproof'],
                    ['name' => 'Totebag Informatika', 'price' => 'Rp 45.000', 'tag' => null, 'icon' => 'shopping-cart', 'desc' => 'Canvas Drill Grey'],
                    ['name' => 'Buckethat Special Edition', 'price' => 'Rp 65.000', 'tag' => 'SALE', 'icon' => 'gift', 'desc' => 'American Drill'],
                ] as $product)
                <div class="group bg-white rounded-lg border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col hover:-translate-y-2">
                    {{-- Product Image Placeholder --}}
                    <div class="relative aspect-square bg-section/50 flex items-center justify-center group-hover:bg-primary/5 transition-colors overflow-hidden">
                        <div class="absolute inset-x-0 bottom-0 h-1 bg-primary opacity-0 group-hover:opacity-100 transition-opacity z-20"></div>
                        
                        {{-- Intense Green Inner Shadow (Matches MemberCard style) --}}
                        <div class="absolute inset-0 z-20 pointer-events-none shadow-[inset_0_0_60px_rgba(36,130,50,0.15)] ring-1 ring-inset ring-primary/5"></div>
                        
                        <x-dynamic-component :component="'heroicon-o-' . $product['icon']" class="size-20 text-gray-300 group-hover:text-primary transition-all duration-700 group-hover:scale-125 opacity-30 group-hover:opacity-100" />
                        
                        @if($product['tag'])
                        <div class="absolute top-4 left-4 px-3 py-1 bg-primary text-white text-[10px] font-black uppercase tracking-[0.2em] rounded shadow-lg z-30">
                            {{ $product['tag'] }}
                        </div>
                        @endif

                        {{-- Quick Action Overlay --}}
                        <div class="absolute inset-0 bg-primary-dark/80 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm z-30">
                             <a href="/product-detail" class="px-8 py-3 bg-white text-primary rounded-lg text-sm font-bold shadow-xl transform translate-y-4 group-hover:translate-y-0 transition-all duration-500" aria-label="Lihat detail produk {{ $product['name'] }}">
                                Lihat Produk
                             </a>
                        </div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex flex-col gap-1 mb-4">
                            <div class="relative">
                                <div class="absolute inset-x-0 inset-y-1 bg-gray-50 animate-shimmer rounded-md"></div>
                                <h3 class="relative z-10 font-bold text-heading text-lg group-hover:text-primary transition-colors line-clamp-1 leading-tight italic uppercase tracking-tighter">{{ $product['name'] }}</h3>
                            </div>
                            <div class="relative inline-block">
                                <div class="absolute inset-0 bg-gray-50 animate-shimmer rounded-md"></div>
                                <p class="relative z-10 text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $product['desc'] }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-auto flex items-center justify-between gap-4">
                            <div class="flex flex-col">
                                <span class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Harga</span>
                                <div class="relative">
                                    <div class="absolute inset-0 bg-gray-50 animate-shimmer rounded-md"></div>
                                    <span class="relative z-10 text-primary font-black text-xl tracking-tighter">{{ $product['price'] }}</span>
                                </div>
                            </div>
                                <button class="w-12 h-12 rounded-lg bg-gray-50 text-gray-400 hover:bg-primary hover:text-white transition-all shadow-sm flex items-center justify-center border border-gray-100 hover:border-primary group/cart" aria-label="Tambah {{ $product['name'] }} ke keranjang">
                                    <x-heroicon-o-shopping-cart class="size-6 transform group-hover/cart:scale-110 transition-transform" aria-hidden="true" />
                                </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            {{-- Custom Merchandise CTA --}}
            <div class="mt-20">
                <div class="bg-primary-dark rounded-lg p-10 md:p-16 relative overflow-hidden shadow-2xl group border border-white/10">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-primary opacity-20 rounded-full -mr-48 -mt-48 blur-[100px] group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-12">
                        <div class="text-center lg:text-left max-w-2xl">
                             <span class="inline-block px-4 py-1 bg-primary/20 rounded-full text-primary-soft text-xs font-bold tracking-widest uppercase mb-4">Bespoke Production</span>
                             <h2 class="text-3xl md:text-5xl font-black text-white mb-6 italic italic uppercase tracking-tighter">Ide Kamu, <span class="text-primary-soft underline decoration-dashed underline-offset-8">Eksekusi Kami.</span></h2>
                             <p class="text-white/60 text-lg leading-relaxed">
                                 Punya ide desain kaos angkatan atau jaket divisi? Tim HMTIF Store siap membantu mewujudkan produk impian kamu dengan kualitas produksi terbaik.
                             </p>
                        </div>
                        <div class="shrink-0 flex items-center gap-4">
                             <a href="https://wa.me/#" class="px-10 py-5 bg-primary text-white rounded-lg font-black text-lg hover:shadow-2xl hover:-translate-y-1 transition-all flex items-center gap-3 group/wa">
                                <x-heroicon-o-chat-bubble-left-right class="size-6 group-hover/wa:rotate-12 transition-transform" />
                                Pesan Custom Sekarang
                             </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
