    {{-- Upcoming Highlight Timeline --}}
    <section class="py-16 bg-section/30 overflow-hidden">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="flex items-center gap-4 mb-10 overflow-hidden reveal reveal-left">
                <span class="w-12 h-px bg-primary/20"></span>
                <h2 class="text-xl font-black text-heading italic uppercase tracking-tighter">Timeline <span class="text-primary italic">Mendatang</span></h2>
                <span class="flex-1 h-px bg-gray-100 italic font-black uppercase tracking-widest text-[10px]">Geser untuk melihat agenda >></span>
            </div>

            <div class="flex gap-6 overflow-x-auto pb-8 no-scrollbar -mx-4 px-4 snap-x snap-mandatory">
                @php $delay = 1; @endphp
                @foreach([
                    ['month' => 'OKT', 'day' => '24', 'title' => 'Informatics Championship', 'status' => 'Main Event', 'color' => 'primary'],
                    ['month' => 'NOV', 'day' => '05', 'title' => 'LDKM 2024: Kartala Generation', 'status' => 'Internal', 'color' => 'blue'],
                    ['month' => 'DES', 'day' => '15', 'title' => 'Tech Talk: AI Evolution', 'status' => 'Webinar', 'color' => 'purple'],
                    ['month' => 'JAN', 'day' => '12', 'title' => 'Informatics Care: Bakti Sosial', 'status' => 'Community', 'color' => 'red'],
                ] as $timeline)
                <div class="shrink-0 w-80 snap-center reveal reveal-up reveal-delay-{{ $delay++ }}">
                    <div class="group bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-500 relative overflow-hidden">
                         <div class="absolute top-0 right-0 w-32 h-32 bg-{{ $timeline['color'] == 'primary' ? 'primary' : $timeline['color'] . '-500' }}/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700"></div>
                         
                         <div class="flex items-start justify-between mb-8">
                             <div class="relative flex flex-col items-center">
                                 <div class="absolute inset-x-0 -inset-y-1 bg-gray-50 animate-shimmer rounded-md"></div>
                                 <span class="relative z-10 text-xs font-black text-primary uppercase tracking-widest">{{ $timeline['month'] }}</span>
                                 <span class="relative z-10 text-4xl font-black text-heading tracking-tighter">{{ $timeline['day'] }}</span>
                             </div>
                             <span class="px-3 py-1 bg-gray-50 border border-gray-100 rounded-lg text-[9px] font-black uppercase tracking-widest text-gray-400 group-hover:bg-primary group-hover:text-white transition-all">
                                 {{ $timeline['status'] }}
                             </span>
                         </div>
                         
                         <div class="flex flex-col gap-1 mb-4">
                            <div class="relative">
                                <div class="absolute inset-x-0 inset-y-1 bg-gray-50 animate-shimmer rounded-md"></div>
                                <h2 class="relative z-10 font-bold text-heading text-lg group-hover:text-primary transition-colors line-clamp-1 leading-tight italic uppercase tracking-tighter">{{ $timeline['title'] }}</h2>
                            </div>
                         </div>
                         <div class="flex items-center gap-2">
                             <div class="w-2 h-2 rounded-full bg-{{ $timeline['color'] == 'primary' ? 'primary' : $timeline['color'] . '-500' }}"></div>
                             <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest group-hover:text-gray-600 transition-colors">Terkonfirmasi</span>
                         </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
