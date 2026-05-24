@props(['staff', 'fallbackImage'])

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
    {{-- Left: Photo --}}
    <div class="lg:col-span-5">
        <div class="sticky top-24 bg-white rounded-[2.5rem] border border-border shadow-xl shadow-black/5 overflow-hidden group">
            <div class="aspect-[4/5] bg-section relative">
                <img src="{{ $staff->photo ?: $fallbackImage }}" alt="{{ $staff->name }}"
                    class="h-full w-full object-cover object-top transition-transform duration-700 group-hover:scale-105" data-fallback-src="{{ $fallbackImage }}">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>
        </div>
    </div>

    {{-- Right: Content --}}
    <div class="lg:col-span-7 flex flex-col justify-center">
        <div class="bg-white rounded-[2.5rem] border border-border shadow-sm p-8 md:p-12 h-full relative overflow-hidden">
            {{-- Decorative Element --}}
            <div class="absolute top-0 right-0 p-12 opacity-[0.02] text-primary pointer-events-none">
                <x-heroicon-s-user class="w-64 h-64" />
            </div>

            <div class="relative z-10">
                {{-- Header --}}
                <div class="mb-10 border-b border-border pb-8">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.2em] mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                        Profil Pengurus
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black italic uppercase tracking-tighter text-heading mb-4 leading-none">
                        {{ $staff->name }}
                    </h2>
                    <p class="text-primary font-black uppercase tracking-[0.2em] text-sm">{{ $staff->position }}</p>
                </div>

                {{-- Bidang Info --}}
                <div class="mb-10">
                    <p class="text-[10px] text-body/50 font-black uppercase tracking-widest mb-3">Bidang / Divisi</p>
                    <div class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-section border border-border">
                        <x-heroicon-o-briefcase class="size-5 text-primary" />
                        <span class="font-bold text-heading">{{ $staff->division?->name ?? 'Belum ditetapkan' }}</span>
                    </div>
                </div>

                {{-- Ringkasan / Bio --}}
                @if($staff->bio)
                <div class="mb-10">
                    <p class="text-[10px] text-body/50 font-black uppercase tracking-widest mb-3">Tentang</p>
                    <div class="prose prose-sm md:prose-base prose-slate text-body leading-relaxed max-w-none">
                        <p>{{ $staff->bio }}</p>
                    </div>
                </div>
                @endif

                {{-- Social Media --}}
                @if($staff->instagram || $staff->linkedin)
                <div>
                    <p class="text-[10px] text-body/50 font-black uppercase tracking-widest mb-4">Terhubung</p>
                    <div class="flex flex-wrap items-center gap-4">
                        @if($staff->instagram)
                        <a href="{{ Str::startsWith($staff->instagram, ['http://', 'https://']) ? $staff->instagram : 'https://instagram.com/' . ltrim($staff->instagram, '@') }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-3 px-6 py-3 rounded-2xl bg-gradient-to-tr from-pink-500 to-purple-500 text-white font-bold text-sm hover:-translate-y-1 hover:shadow-lg hover:shadow-pink-500/25 transition-all duration-300">
                            <svg class="size-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                            Instagram
                        </a>
                        @endif

                        @if($staff->linkedin)
                        <a href="{{ Str::startsWith($staff->linkedin, ['http://', 'https://']) ? $staff->linkedin : 'https://' . ltrim($staff->linkedin, '@') }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-3 px-6 py-3 rounded-2xl bg-linkedin text-white font-bold text-sm hover:-translate-y-1 hover:shadow-lg hover:shadow-linkedin/25 transition-all duration-300">
                            <svg class="size-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                            </svg>
                            LinkedIn
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
