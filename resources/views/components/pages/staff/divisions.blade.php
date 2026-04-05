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
            <div class="flex items-center justify-between mb-12 border-b border-primary/10 pb-6 reveal reveal-left">
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
                <div class="col-span-2 md:col-span-2 lg:col-span-1 reveal reveal-up reveal-delay-1">
                    <x-molecules.cards.member-card name="Koordinator" position="Koordinator {{ $div['id'] }}"
                        size="normal" :dept="$div['id']"
                        image="https://images.unsplash.com/photo-1519085185750-74071727339a?q=80&w=400&auto=format&fit=crop" />
                </div>
                {{-- Members --}}
                @php $delay = 2; @endphp
                @for($i = 1; $i <= 4; $i++)
                    <div class="reveal reveal-up reveal-delay-{{ $delay++ }}">
                        <x-molecules.cards.member-card name="Anggota {{ $i }}" position="Anggota" size="normal"
                            :dept="$div['id']" />
                    </div>
                @endfor
            </div>
        </div>
    @endforeach
