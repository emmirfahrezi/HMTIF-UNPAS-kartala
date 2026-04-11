<div class="py-24 bg-primary-dark text-white relative overflow-hidden content-auto">
    <div class="absolute inset-0 opacity-10 bg-repeat"
        style="background-image: url('{{ asset('images/placeholders/pattern-grid.svg') }}');"></div>
    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl relative z-10">
        <div class="text-center mb-16">
            <span
                class="inline-block px-4 py-1 bg-white/10 rounded-full text-primary-soft text-sm font-bold tracking-widest uppercase mb-4">Core
                Values</span>
            <h2 class="text-3xl sm:text-5xl font-extrabold mb-4">Visi & Misi Kabinet</h2>
            <div class="w-24 h-1.5 bg-primary-soft mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Visi --}}
            <div
                class="bg-white/5 backdrop-blur-md p-10 rounded-[2.5rem] border border-white/10 shadow-2xl reveal reveal-scale">
                <div
                    class="w-16 h-16 bg-primary-soft rounded-lg flex items-center justify-center mb-8 shadow-lg shadow-primary-soft/20 transform -rotate-3">
                    <x-heroicon-o-eye class="h-8 w-8 text-primary-dark" />
                </div>
                <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                    Visi Utama
                    <span class="h-px flex-1 bg-linear-to-r from-white/20 to-transparent"></span>
                </h3>
                <p class="text-xl text-primary-soft italic font-medium leading-relaxed">
                    "Mewujudkan HMTIF UNPAS sebagai organisasi yang adaptif, edukatif, dan inspiratif dalam membangun
                    harmoni serta kemajuan Teknik Informatika."
                </p>
            </div>

            {{-- Misi --}}
            <div
                class="bg-white/5 backdrop-blur-md p-10 rounded-[2.5rem] border border-white/10 shadow-2xl reveal reveal-scale reveal-delay-2">
                <div
                    class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-8 shadow-lg transform rotate-3">
                    <x-heroicon-o-rocket-launch class="h-8 w-8 text-primary-dark" />
                </div>
                <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                    Misi Strategis
                    <span class="h-px flex-1 bg-linear-to-r from-white/20 to-transparent"></span>
                </h3>
                <ul class="space-y-4">
                    @foreach (['Mengoptimalkan wadah aspirasi dan pengembangan minat bakat mahasiswa.', 'Membangun budaya organisasi yang berlandaskan kekeluargaan dan profesionalisme.', 'Meningkatkan kolaborasi internal dan eksternal demi kemajuan almamater.'] as $misi)
                        <li class="flex items-start gap-4 text-gray-300">
                            <div
                                class="mt-1.5 w-2 h-2 bg-primary-soft rounded-full shrink-0 shadow-sm shadow-primary-soft">
                            </div>
                            <span class="leading-relaxed">{{ $misi }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
