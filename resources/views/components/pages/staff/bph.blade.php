    {{-- 1. Pimpinan Utama (Ketum & Sekjend) & BPH --}}
    <div class="mb-32">
        <div class="flex items-center gap-4 mb-16">
            <div class="h-8 w-2 bg-primary rounded-full"></div>
            <h2 class="text-heading font-black text-4xl uppercase tracking-tighter italic">Badan Pengurus <span
                    class="text-primary italic">Harian</span></h2>
            <div class="h-px flex-1 bg-gradient-to-r from-primary/20 to-transparent"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto">
            <x-molecules.cards.member-card name="Fahreza Fauzan" position="Ketua Himpunan" size="xl"
                dept="KARTALA" class="reveal-delay-1"
                image="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=600&auto=format&fit=crop" />
            <x-molecules.cards.member-card name="Ahmad Jaelani" position="Sekretaris Jenderal" size="xl"
                dept="KARTALA" class="reveal-delay-2"
                image="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=600&auto=format&fit=crop" />
        </div>

        {{-- 2. BPH --}}
        <div class="mt-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <x-molecules.cards.member-card name="Siti Nurhaliza" position="Sekretaris Umum" size="normal"
                    dept="SEC" class="reveal-delay-1" />
                <x-molecules.cards.member-card name="Lestari Putri" position="Bendahara Umum" size="normal"
                    dept="TRE" class="reveal-delay-2" />
                <x-molecules.cards.member-card name="Cindy Clarissa" position="Kepala Bidang 1" size="normal"
                    dept="KAB" class="reveal-delay-3" />

                <x-molecules.cards.member-card name="Randi Kurnia" position="Wkl Sekretaris Umum" size="normal"
                    dept="SEC" class="reveal-delay-1" />
                <x-molecules.cards.member-card name="Dedi Wijaya" position="Wkl Bendahara Umum" size="normal"
                    dept="TRE" class="reveal-delay-2" />
                <x-molecules.cards.member-card name="Budi Santoso" position="Kepala Bidang 2" size="normal"
                    dept="KAB" class="reveal-delay-3" />
            </div>
        </div>
    </div>
