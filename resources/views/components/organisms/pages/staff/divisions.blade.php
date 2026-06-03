    {{-- 3. Departemen / Divisi --}}
    @props(['divisions'])

    @foreach ($divisions as $div)
        @php
            $divisionCode = $div->abbreviation_code;
            $divisionName = trim((string) $div->name);
            $divisionTitle = $divisionName !== '' ? $divisionName : 'Bidang ' . ($divisionCode ?: 'Divisi');
            $divisionTitle = \Illuminate\Support\Str::startsWith(\Illuminate\Support\Str::lower($divisionTitle), 'bidang ')
                ? $divisionTitle
                : 'Bidang ' . $divisionTitle;
            $coordinator = $div->staffs->first();
            $members = $div->staffs->slice(1);
        @endphp

        <div class="mb-20 md:mb-24">
            <div
                class="flex items-center justify-between mb-10 md:mb-12 border-b border-primary/20 pb-5 md:pb-6 reveal reveal-left gap-4">
                <div class="flex items-center gap-4 flex-1 min-w-0">
                    <div class="h-7 w-1.5 bg-primary rounded-full shadow-sm shadow-primary/20 shrink-0"></div>
                    <div class="min-w-0">
                        <h2 class="text-heading font-black text-2xl sm:text-3xl md:text-4xl uppercase tracking-tight italic break-words leading-none">
                            {{ $divisionTitle }}
                        </h2>
                        <p class="mt-2 inline-flex rounded-full border border-primary/15 bg-primary/5 px-2.5 py-1 text-[8px] sm:text-[10px] font-bold uppercase tracking-[0.16em] text-primary-dark">
                            Fungsionaris Bidang {{ $divisionCode }}
                        </p>
                    </div>
                </div>
                <a href="{{ route('divisions.show', $div->slug) }}"
                    class="inline-flex items-center gap-2 rounded-lg border border-primary/20 bg-white px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.12em] text-primary-dark shadow-sm transition-colors hover:border-primary/40 hover:bg-primary/5 md:px-4 md:py-2 md:text-xs shrink-0">
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
                            :dept="$divisionCode" :image="$coordinator->photo_url" :href="route('staff.show', $coordinator->id)" />
                    </div>
                @endif
                {{-- Members --}}
                @foreach ($members as $index => $member)
                    <div
                        class="min-w-[82%] sm:min-w-[58%] md:min-w-0 snap-start reveal reveal-up reveal-delay-{{ ($index % 4) + 2 }}">
                        <x-molecules.pages.cards.member-card :name="$member->name" :position="$member->position" size="normal"
                            :dept="$divisionCode" :image="$member->photo_url" :href="route('staff.show', $member->id)" />
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    @if ($divisions->isEmpty())
        <p class="text-sm text-body/60">Belum ada data divisi yang tersedia.</p>
    @endif
