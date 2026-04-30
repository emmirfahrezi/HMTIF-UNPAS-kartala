    {{-- 3. Departemen / Divisi --}}
    @props(['divisions'])

    @php
        $divisionOrder = [
            'kajian strategis dan advokasi',
            'komunikasi dan informasi',
            'kewirausahaan kreatif',
            'pengembangan sumber daya mahasiswa',
            'minat dan bakat',
        ];

        $divisions = $divisions
            ->where('name', '!=', 'Badan Pengurus Harian')
            ->sortBy(function ($division) use ($divisionOrder) {
                $index = array_search(strtolower($division->name), $divisionOrder, true);
                return $index === false ? 999 : $index;
            })
            ->values();

        $abbrMap = [
            'kajian strategis dan advokasi' => 'KASTRAD',
            'komunikasi dan informasi' => 'KOMINFO',
            'pengembangan sumber daya mahasiswa' => 'PSDM',
            'minat dan bakat' => 'PMB',
            'kewirausahaan kreatif' => 'KESKRAF',
        ];
    @endphp

    @foreach ($divisions as $div)
        @php
            $divisionCode = $abbrMap[strtolower($div->name)] ?? strtoupper(substr($div->slug, 0, 6));
            $coordinator = $div->staffs->first();
            $members = $div->staffs->slice(1);
        @endphp

        <div class="mb-20 md:mb-24">
            <div
                class="flex items-center justify-between mb-10 md:mb-12 border-b border-primary/10 pb-5 md:pb-6 reveal reveal-left">
                <div class="flex items-center gap-4">
                    <div class="h-6 w-1.5 bg-primary/40 rounded-full"></div>
                    <div>
                        <h3 class="text-heading font-black text-xl md:text-2xl uppercase tracking-widest">
                            {{ $div->name }}
                        </h3>
                        <p class="text-primary font-bold text-[10px] mt-1 tracking-[0.2em] uppercase">Fungsionaris
                            Bidang {{ $divisionCode }}</p>
                    </div>
                </div>
                <a href="/detail-division?division={{ $div->slug }}"
                    class="hidden md:inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-secondary/50 text-heading text-xs font-black uppercase tracking-widest hover:bg-secondary transition-colors">
                    Detail Bidang
                    <x-heroicon-o-arrow-right class="size-4" />
                </a>
            </div>

            <div
                class="flex md:grid md:grid-cols-3 lg:grid-cols-4 gap-3 overflow-x-auto overflow-y-hidden md:overflow-visible snap-x snap-mandatory md:snap-none touch-pan-x overscroll-x-contain pb-2 md:pb-0 -mx-1 px-1 no-scrollbar">
                {{-- Coordinator --}}
                @if ($coordinator)
                    <div
                        class="min-w-[82%] sm:min-w-[58%] md:min-w-0 md:col-span-1 lg:col-span-1 snap-start reveal reveal-up reveal-delay-1">
                        <x-molecules.pages.cards.member-card :name="$coordinator->name" :position="$coordinator->position" size="normal"
                            :dept="$divisionCode" :image="$coordinator->photo ?: asset('images/placeholders/member.svg')" :href="'/detail-member?staff=' . $coordinator->id" />
                    </div>
                @endif
                {{-- Members --}}
                @foreach ($members as $index => $member)
                    <div
                        class="min-w-[82%] sm:min-w-[58%] md:min-w-0 snap-start reveal reveal-up reveal-delay-{{ ($index % 4) + 2 }}">
                        <x-molecules.pages.cards.member-card :name="$member->name" :position="$member->position" size="normal"
                            :dept="$divisionCode" :image="$member->photo ?: asset('images/placeholders/member.svg')" :href="'/detail-member?staff=' . $member->id" />
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    @if ($divisions->isEmpty())
        <p class="text-sm text-body/60">Belum ada data divisi. Jalankan seeder untuk menampilkan data.</p>
    @endif

