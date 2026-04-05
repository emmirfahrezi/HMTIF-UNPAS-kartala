    {{-- Product Gallery Component --}}
    @php
        $images = [
            'https://images.unsplash.com/photo-1556821840-03a63f95609a7?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1551028601-518f49613615?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1544441893-675973e31985?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?q=80&w=1200&auto=format&fit=crop'
        ];
    @endphp

    <div class="flex flex-col gap-6 reveal reveal-left">
        {{-- Main Image Container --}}
        <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-square bg-section/50 border border-gray-100 group transition-all duration-500">
            <div class="absolute inset-0 z-20 pointer-events-none shadow-[inset_0_0_80px_rgba(36,130,50,0.15)] ring-1 ring-inset ring-primary/5"></div>
            
            <img src="{{ $images[0] }}" 
                 alt="Main Product Image" 
                 class="w-full h-full object-cover transition-opacity duration-500 ease-in-out"
                 id="mainProductImage">
            
            <div class="absolute top-6 left-6 px-4 py-2 bg-primary text-white text-[10px] font-black uppercase tracking-[0.2em] rounded shadow-lg z-30">
                Best Seller
            </div>
        </div>
        
        {{-- Interactive Thumbnails --}}
        <div class="grid grid-cols-4 gap-4">
            @foreach($images as $index => $img)
                <div class="gallery-thumbnail aspect-square rounded-2xl bg-section border-2 overflow-hidden cursor-pointer transition-all duration-300 transform hover:scale-105 {{ $index === 0 ? 'border-primary ring-4 ring-primary/10' : 'border-gray-50' }}"
                     data-full="{{ $img }}">
                    <img src="{{ $img }}" class="w-full h-full object-cover opacity-80 hover:opacity-100 transition-opacity">
                </div>
            @endforeach
        </div>
    </div>
