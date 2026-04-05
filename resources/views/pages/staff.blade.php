<x-layout title="Daftar Pengurus" :transparent="false">
    {{-- Hero Section --}}
    <section class="relative pt-40 pb-24 overflow-hidden bg-white">
        <div class="absolute inset-0 z-0 opacity-10">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 0 L100 0 L100 100 L0 100 Z" fill="none" stroke="currentColor" stroke-width="1"
                    class="text-primary" />
                <path d="M0 0 L100 100" stroke="currentColor" stroke-width="0.5" class="text-primary" />
            </svg>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span
                class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-[0.3em] uppercase mb-6 uppercase">Informasi
                Struktur</span>
            <h1 class="text-4xl md:text-7xl font-black text-heading mb-6 uppercase italic tracking-tighter">
                Kabinet <span class="text-primary">Kartala</span>
            </h1>
            <p class="text-body/40 max-w-2xl mx-auto text-lg lowercase tracking-widest font-light leading-relaxed">
                membangun harmoni. menginspirasi perubahan. teknik informatika progresif.
            </p>
        </div>
    </section>

    <div class="bg-white pt-10 pb-32">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">

            {{-- 1. Pimpinan Utama (Ketum & Sekjend) --}}
            <div class="mb-32">
                <div class="flex items-center gap-4 mb-16">
                    <div class="h-8 w-2 bg-primary rounded-full"></div>
                    <h2 class="text-heading font-black text-4xl uppercase tracking-tighter italic">Badan Pengurus <span
                            class="text-primary italic">Harian</span></h2>
                    <div class="h-px flex-1 bg-gradient-to-r from-primary/20 to-transparent"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto">
                    <x-molecules.cards.member-card name="Fahreza Fauzan" position="Ketua Himpunan" size="xl"
                        dept="KARTALA"
                        image="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=600&auto=format&fit=crop" />
                    <x-molecules.cards.member-card name="Ahmad Jaelani" position="Sekretaris Jenderal" size="xl"
                        dept="KARTALA"
                        image="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=600&auto=format&fit=crop" />
                </div>

                {{-- 2. BPH --}}

                <div class="mt-16">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        <x-molecules.cards.member-card name="Siti Nurhaliza" position="Sekretaris Umum" size="normal"
                            dept="SEC" />
                        <x-molecules.cards.member-card name="Lestari Putri" position="Bendahara Umum" size="normal"
                            dept="TRE" />
                        <x-molecules.cards.member-card name="Cindy Clarissa" position="Kepala Bidang 1" size="normal"
                            dept="KAB" />

                        <x-molecules.cards.member-card name="Randi Kurnia" position="Wkl Sekretaris Umum" size="normal"
                            dept="SEC" />
                        <x-molecules.cards.member-card name="Dedi Wijaya" position="Wkl Bendahara Umum" size="normal"
                            dept="TRE" />
                        <x-molecules.cards.member-card name="Budi Santoso" position="Kepala Bidang 2" size="normal"
                            dept="KAB" />
                    </div>
                </div>
            </div>

            {{-- 3. Departemen / Divisi --}}
            @php
                $divisions = [
                    ['id' => 'KASTRAD', 'title' => 'Kajian Strategis & Advokasi'],
                    ['id' => 'KOMINFO', 'title' => 'Komunikasi & Informasi'],
                    ['id' => 'KESKRAF', 'title' => 'Kreatif & Ekonomi'],
                    ['id' => 'PSDM', 'title' => 'Pengembangan SDM'],
                    ['id' => 'PMB', 'title' => 'Peminat & Bakat'],
                ];
            @endphp

            @foreach($divisions as $div)
                <div class="mb-32">
                    <div class="flex items-center justify-between mb-12 border-b border-primary/10 pb-6">
                        <div class="flex items-center gap-4">
                            <div class="h-6 w-1.5 bg-primary/40 rounded-full"></div>
                            <div>
                                <h3 class="text-heading font-black text-2xl uppercase tracking-widest">{{ $div['title'] }}
                                </h3>
                                <p class="text-primary font-bold text-[10px] mt-1 tracking-[0.2em] uppercase">Fungsionaris
                                    Bidang {{ $div['id'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-2">
                        {{-- Coordinator --}}
                        <div class="col-span-2 md:col-span-2 lg:col-span-1">
                            <x-molecules.cards.member-card name="Koordinator" position="Koordinator {{ $div['id'] }}"
                                size="normal" :dept="$div['id']"
                                image="https://images.unsplash.com/photo-1519085185750-74071727339a?q=80&w=400&auto=format&fit=crop" />
                        </div>
                        {{-- Members --}}
                        @for($i = 1; $i <= 4; $i++)
                            <x-molecules.cards.member-card name="Anggota {{ $i }}" position="Anggota" size="normal"
                                :dept="$div['id']" />
                        @endfor
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-layout>