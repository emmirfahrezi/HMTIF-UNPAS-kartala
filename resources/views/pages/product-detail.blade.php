<x-layout 
    title="Detail Produk | HMTIF Store" 
    description="Rincian produk resmi HMTIF UNPAS. Cek spesifikasi bahan, ukuran, dan harga merchandise eksklusif Kabinet Kartala. Pesan sekarang melalui WhatsApp."
    keywords="Merchandise Informatika, Hoodie Kartala, Atribut HMTIF UNPAS, Jual Jaket Informatika"
    :transparent="false"
>
    {{-- Breadcrumb/Back Section --}}
    <section class="pt-20 pb-4 bg-white border-b border-gray-50">
        <div class="container mx-auto px-6">
            <a href="/store" class="flex items-center gap-2 text-primary font-bold text-sm hover:translate-x-1 transition-transform group max-w-fit">
                <x-heroicon-o-arrow-left class="size-4" />
                Kembali ke Store
            </a>
        </div>
    </section>

    {{-- Product Gallery & Info Section --}}
    <section class="py-16 bg-white overflow-hidden">
        <div class="container mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 items-start">
                {{-- Product Gallery Layout --}}
                <div class="flex flex-col gap-4">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-square bg-section/50 border border-gray-100 group">
                        {{-- Intense Green Inner Shadow --}}
                        <div class="absolute inset-0 z-20 pointer-events-none shadow-[inset_0_0_80px_rgba(36,130,50,0.15)] ring-1 ring-inset ring-primary/5"></div>
                        
                        <div class="w-full h-full flex items-center justify-center p-20">
                            <x-heroicon-o-shopping-bag class="size-64 text-gray-200 group-hover:text-primary/20 transition-all duration-700 group-hover:scale-110" />
                        </div>
                        
                        <div class="absolute top-6 left-6 px-4 py-2 bg-primary text-white text-[10px] font-black uppercase tracking-[0.2em] rounded shadow-lg z-30">
                            Best Seller
                        </div>
                    </div>
                    
                    {{-- Small Thumbnails Mockup --}}
                    <div class="grid grid-cols-4 gap-4">
                        @foreach([1,2,3,4] as $i)
                        <div class="aspect-square rounded-xl bg-section border border-gray-100 flex items-center justify-center cursor-pointer hover:border-primary/40 transition-colors">
                            <x-heroicon-o-photo class="size-6 text-gray-300" />
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Product Details Layout --}}
                <div class="mt-12 lg:mt-0 lg:pl-8">
                    <div class="flex flex-col gap-2 mb-8">
                        <span class="text-primary font-black uppercase tracking-[0.3em] text-[10px]">Official Merchandise</span>
                        <h1 class="text-2xl md:text-4xl font-black text-heading italic uppercase tracking-tighter leading-none">Hoodie Kabinet <span class="text-primary">Kartala 2024</span></h1>
                    </div>

                    <div class="flex items-center gap-4 mb-10">
                        <span class="text-3xl font-black text-primary tracking-tighter">Rp 185.000</span>
                        <span class="px-3 py-1 rounded bg-red-50 text-red-500 text-[10px] font-bold uppercase tracking-widest line-through">Rp 225.000</span>
                    </div>

                    <div class="prose prose-sm text-body/70 leading-relaxed mb-10">
                        <p>
                            Hoodie eksklusif edisi terbatas Kabinet Kartala 2024. Dirancang dengan material Cotton Fleece kualitas tertinggi yang menjamin kenyamanan maksimal untuk aktivitas kampus sehari-hari. Desain minimalis namun tetap menonjolkan identitas Teknik Informatika UNPAS yang progresif.
                        </p>
                    </div>

                    {{-- Spec Table --}}
                    <div class="space-y-4 mb-10">
                        <div class="grid grid-cols-3 py-3 border-b border-gray-100 text-sm">
                            <span class="font-bold text-heading uppercase tracking-widest text-[10px]">Bahan</span>
                            <span class="col-span-2 text-body">Cotton Fleece 330gsm (Premium)</span>
                        </div>
                        <div class="grid grid-cols-3 py-3 border-b border-gray-100 text-sm">
                            <span class="font-bold text-heading uppercase tracking-widest text-[10px]">Sablon</span>
                            <span class="col-span-2 text-body">Plastisol Digital High Definition</span>
                        </div>
                        <div class="grid grid-cols-3 py-3 border-b border-gray-100 text-sm">
                            <span class="font-bold text-heading uppercase tracking-widest text-[10px]">Warna</span>
                            <span class="col-span-2 text-body">Deep Forest Green (Kartala Edition)</span>
                        </div>
                    </div>

                    {{-- Size Selector Mockup --}}
                    <div class="mb-10">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-4">Pilih Ukuran</p>
                        <div class="flex flex-wrap gap-3">
                            @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                            <button class="w-12 h-12 rounded-lg border {{ $size == 'L' ? 'bg-primary text-white border-primary shadow-lg shadow-primary/20' : 'bg-white text-heading border-gray-100 hover:border-primary/40 transition-all' }} text-xs font-bold">{{ $size }}</button>
                            @endforeach
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="https://wa.me/#?text=Halo+HMTIF+Store,+saya+ingin+memesan+Hoodie+Kartala+Ukuran+L" class="flex-1 px-10 py-5 bg-primary text-white rounded-2xl font-black text-lg hover:shadow-2xl hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                            <x-heroicon-o-chat-bubble-left-right class="size-6" />
                            Pesan via WhatsApp
                        </a>
                        <button class="px-8 py-5 rounded-2xl border border-gray-200 text-gray-400 hover:text-primary hover:border-primary hover:bg-primary/5 transition-all">
                            <x-heroicon-o-heart class="size-6" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Products --}}
    <section class="py-24 bg-section/30">
        <div class="container mx-auto px-6">
            <div class="flex items-center gap-4 mb-12">
                <div class="h-8 w-2 bg-primary rounded-full"></div>
                <h2 class="text-heading font-black text-3xl uppercase tracking-tighter italic">Produk <span class="text-primary">Eksklusif Lainnya</span></h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Mockup simple cards here --}}
                @foreach([1,2,3,4] as $j)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg transition-all group">
                    <div class="aspect-square rounded-xl bg-section/50 mb-6 flex items-center justify-center">
                        <x-heroicon-o-shopping-bag class="size-12 text-gray-200 group-hover:text-primary/30" />
                    </div>
                    <h5 class="font-bold text-heading text-sm mb-2 uppercase italic tracking-tight">Merchandise Kartala #{{ $j }}</h5>
                    <p class="text-primary font-black text-lg tracking-tighter">Rp 95.000</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>
