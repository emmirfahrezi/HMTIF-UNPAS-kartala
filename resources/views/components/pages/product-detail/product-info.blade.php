@php
    $product = \App\Models\Product::query()->with('category')->latest()->first();
@endphp

{{-- Product Details Layout --}}
<div class="mt-12 lg:mt-0 lg:pl-8 reveal reveal-right">
    <div class="flex flex-col gap-2 mb-8">
        <span class="text-primary font-black uppercase tracking-[0.3em] text-[10px]">Official Merchandise</span>
        <h1 class="text-2xl md:text-4xl font-black text-heading italic uppercase tracking-tighter leading-none">
            {{ $product?->name ?? 'Merchandise HMTIF' }}</h1>
    </div>

    <div class="flex items-center gap-4 mb-10">
        <span class="text-3xl font-black text-primary tracking-tighter">Rp
            {{ number_format((float) ($product?->price ?? 0), 0, ',', '.') }}</span>
    </div>

    <div class="prose prose-sm text-body/70 leading-relaxed mb-10">
        <p>
            {{ $product?->description ?: 'Merchandise resmi HMTIF UNPAS dengan kualitas terbaik untuk aktivitas kampus dan organisasi.' }}
        </p>
    </div>

    {{-- Spec Table --}}
    <div class="space-y-4 mb-10">
        <div class="grid grid-cols-3 py-3 border-b border-gray-100 text-sm">
            <span class="font-bold text-heading uppercase tracking-widest text-[10px]">Bahan</span>
            <span class="col-span-2 text-body">Material premium pilihan untuk penggunaan harian</span>
        </div>
        <div class="grid grid-cols-3 py-3 border-b border-gray-100 text-sm">
            <span class="font-bold text-heading uppercase tracking-widest text-[10px]">Sablon</span>
            <span class="col-span-2 text-body">Digital print berkualitas tinggi</span>
        </div>
        <div class="grid grid-cols-3 py-3 border-b border-gray-100 text-sm">
            <span class="font-bold text-heading uppercase tracking-widest text-[10px]">Warna</span>
            <span class="col-span-2 text-body">Variatif sesuai batch produksi</span>
        </div>
    </div>

    {{-- Size Selector Mockup --}}
    <div class="mb-10">
        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-4">Pilih Ukuran</p>
        <div class="flex flex-wrap gap-3">
            @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                <button
                    class="w-12 h-12 rounded-lg border {{ $size == 'L' ? 'bg-primary text-white border-primary shadow-lg shadow-primary/20' : 'bg-white text-heading border-gray-100 hover:border-primary/40 transition-all' }} text-xs font-bold">{{ $size }}</button>
            @endforeach
        </div>
    </div>

    {{-- CTA --}}
    <div class="flex flex-col sm:flex-row gap-4">
        <a href="https://wa.me/#?text=Halo+HMTIF+Store,+saya+ingin+memesan+Hoodie+Kartala+Ukuran+L"
            class="flex-1 px-10 py-5 bg-primary text-white rounded-2xl font-black text-lg hover:shadow-2xl hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
            <x-heroicon-o-chat-bubble-left-right class="size-6" />
            Pesan via WhatsApp
        </a>
        <button
            class="px-8 py-5 rounded-2xl border border-gray-200 text-gray-400 hover:text-primary hover:border-primary hover:bg-primary/5 transition-all">
            <x-heroicon-o-heart class="size-6" />
        </button>
    </div>
</div>
