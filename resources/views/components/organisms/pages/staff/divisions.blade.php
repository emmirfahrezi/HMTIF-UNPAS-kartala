    {{-- 3. Departemen / Divisi --}}
    @props(['divisions'])


    @foreach ($divisions as $div)
        @php
            $divisionCode = $div->abbreviation_code;
            $coordinator = $div->staffs->first();
            $members = $div->staffs->slice(1);
        @endphp

        <div class="mb-20 md:mb-24">
            <div
                class="flex items-center justify-between mb-10 md:mb-12 border-b border-primary/10 pb-5 md:pb-6 reveal reveal-left gap-4">
                <div class="flex items-center gap-4 flex-1 min-w-0">
                    <div class="h-6 w-1.5 bg-primary/40 rounded-full shrink-0"></div>
                    <div class="min-w-0">
                        <h3 class="text-heading font-black text-sm sm:text-base md:text-2xl uppercase tracking-widest break-words leading-tight">
                            {{ $div->name }}
                        </h3>
                        <p class="text-primary font-bold text-[8px] sm:text-[10px] mt-1 tracking-[0.2em] uppercase">Fungsionaris
                            Bidang {{ $divisionCode }}</p>
                    </div>
                </div>
                <a href="{{ route('divisions.show', $div->slug) }}"
                    class="inline-flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2 rounded-lg border border-secondary/50 text-heading text-[10px] md:text-xs font-black uppercase tracking-widest hover:bg-secondary transition-colors shrink-0">
                    Detail Bidang
                    <x-heroicon-o-arrow-right class="size-3.5 md:size-4" />
                </a>
            </div>

            <div
                class="flex md:grid md:grid-cols-3 lg:grid-cols-4 gap-3 overflow-x-auto overflow-y-hidden md:overflow-visible snap-x snap-mandatory md:snap-none touch-pan-x overscroll-x-contain pb-2 md:pb-0 -mx-1 px-1 no-scrollbar">
                {{-- Coordinator --}}
                @if ($coordinator)
                    <div
                        class="min-w-[82%] sm:min-w-[58%] md:min-w-0 md:col-span-1 lg:col-span-1 snap-start reveal reveal-up reveal-delay-1">
                        <x-molecules.pages.cards.member-card :name="$coordinator->name" :position="$coordinator->position" size="normal"
                            :dept="$divisionCode" :image="$coordinator->photo ?: asset('images/placeholders/member.svg')" :href="route('staff.show', $coordinator->id)" />
                    </div>
                @endif
                {{-- Members --}}
                @foreach ($members as $index => $member)
                    <div
                        class="min-w-[82%] sm:min-w-[58%] md:min-w-0 snap-start reveal reveal-up reveal-delay-{{ ($index % 4) + 2 }}">
                        <x-molecules.pages.cards.member-card :name="$member->name" :position="$member->position" size="normal"
                            :dept="$divisionCode" :image="$member->photo ?: asset('images/placeholders/member.svg')" :href="route('staff.show', $member->id)" />
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    @if ($divisions->isEmpty())
        <p class="text-sm text-body/60">Belum ada data divisi yang tersedia.</p>
    @endif

