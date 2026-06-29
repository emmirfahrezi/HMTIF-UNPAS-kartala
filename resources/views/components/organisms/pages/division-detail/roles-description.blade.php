@props(['division'])


<div class="-mt-2 space-y-12">
    <div class="mb-10 max-w-3xl">
        <h2 class="text-3xl font-black text-heading uppercase tracking-tighter italic mb-4">
            Rincian <span class="text-primary">Tugas & Wewenang</span>
        </h2>
        <p class="text-body/80 text-lg leading-relaxed">
            Berikut adalah penjelasan mengenai fokus kerja, peran, dan tanggung jawab dari setiap jabatan yang ada di
            dalam struktur {{ $division->name }}.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 relative">
        @foreach ($division->rolesToShow as $index => $role)
            <div
                class="bg-white rounded-2xl p-8 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgba(36,130,50,0.1)] transition-all duration-500 relative overflow-hidden group reveal reveal-up reveal-delay-{{ ($index % 4) + 1 }}">
                {{-- Decorative Background Icon --}}
                <div
                    class="absolute -right-6 -top-6 text-primary/5 transition-transform duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none">
                    <x-dynamic-component :component="'heroicon-s-' . $role['icon']" class="w-48 h-48" />
                </div>

                <div class="relative z-10">
                    <div
                        class="w-14 h-14 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-500">
                        <x-dynamic-component :component="'heroicon-o-' . $role['icon']" class="w-7 h-7" />
                    </div>

                    <h3 class="text-xl md:text-2xl font-black text-heading uppercase tracking-widest mb-4">
                        {{ $role['title'] }}
                    </h3>

                    <div class="w-12 h-1 bg-primary rounded-full mb-6"></div>

                    <p class="text-body/70 leading-relaxed">
                        {{ $role['desc'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>