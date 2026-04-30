{{-- Track Aspiration (Official Brand Theme) --}}
<section class="py-12 relative">
    @php
        use App\Models\Aspiration;
        $trackCode = trim((string) request('code'));
        $aspiration = $trackCode ? Aspiration::where('tracking_code', $trackCode)->first() : null;
        
        $statusMap = [
            'pending'  => ['label' => 'Aspirasi Masuk', 'color' => 'amber', 'step' => 1],
            'reviewed' => ['label' => 'Sedang Diproses', 'color' => 'primary-soft', 'step' => 2],
            'resolved' => ['label' => 'Selesai', 'color' => 'emerald', 'step' => 3],
        ];
        
        $currentStatus = $aspiration ? ($statusMap[$aspiration->status] ?? $statusMap['pending']) : null;
    @endphp

    <div class="mx-auto px-6 lg:px-8 max-w-5xl">
        <div class="bg-primary-dark rounded-2xl p-8 md:p-14 shadow-2xl relative overflow-hidden group">
            {{-- Official Pattern Decor --}}
            <div class="absolute top-0 right-0 w-80 h-80 bg-primary opacity-20 rounded-full -mr-40 -mt-40 blur-3xl group-hover:scale-110 transition-transform duration-1000"></div>

            <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="text-center lg:text-left flex-1">
                    <h2 class="text-4xl font-black text-white uppercase italic tracking-tighter leading-none mb-4">
                        Pantau <span class="text-primary-soft">Aspirasimu</span>
                    </h2>
                    <p class="text-white/40 text-sm max-w-sm font-medium leading-relaxed">
                        Masukkan kode tracking untuk memantau perkembangan aspirasi Anda secara transparan.
                    </p>
                </div>

                <form action="{{ route('aspirations') }}" method="GET" class="w-full lg:w-auto flex flex-col sm:flex-row gap-4">
                    <div class="relative group/input flex-1 sm:w-80">
                        <x-heroicon-o-hashtag class="size-5 text-white/20 absolute left-5 top-1/2 -translate-y-1/2 group-focus-within/input:text-primary-soft transition-colors" />
                        <input type="text" name="code" value="{{ $trackCode }}" placeholder="XXXXXXXXX"
                            autocomplete="off"
                            class="w-full pl-12 pr-6 py-5 bg-white/5 border border-white/10 rounded-[1.5rem] text-white placeholder:text-white/20 focus:outline-none focus:ring-4 focus:ring-primary/20 focus:border-primary-soft/50 transition-all font-black tracking-widest text-sm uppercase">
                    </div>
                    <x-atoms.shared.button 
                        type="submit"
                        variant="primary"
                        rounded="rounded-[1.5rem]"
                        class="px-10 py-5 font-black text-sm hover:bg-primary-soft hover:text-primary-dark shadow-xl shadow-black/20 hover:-translate-y-1 active:scale-95 transition-all shrink-0">
                        <span>Cek Status</span>
                        <x-heroicon-o-magnifying-glass class="size-5" />
                    </x-atoms.shared.button>
                </form>
            </div>

            @if ($trackCode !== '')
                @if ($aspiration)
                    {{-- Results Area --}}
                    <div class="relative z-10 mt-16 pt-16 border-t border-white/10 flex flex-col gap-10 animate-in fade-in slide-in-from-bottom-8 duration-700">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-8">
                            <div class="flex items-center gap-5">
                                <div class="size-16 rounded-[1.25rem] bg-white/5 border border-white/10 flex items-center justify-center text-primary-soft shadow-inner">
                                    <x-heroicon-o-chat-bubble-bottom-center-text class="size-8" />
                                </div>
                                <div>
                                    <h3 class="text-white font-black text-2xl leading-none mb-2 uppercase tracking-tight">{{ $aspiration->tracking_code }}</h3>
                                    <p class="text-white/40 text-xs font-bold uppercase tracking-widest">Dikirim: {{ $aspiration->created_at->format('d M Y') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 px-6 py-3 bg-white/5 border border-white/10 rounded-2xl">
                                <span class="size-2.5 rounded-full bg-{{ $currentStatus['color'] == 'primary-soft' ? 'primary-soft' : ($currentStatus['color'] . '-500') }} {{ $aspiration->status != 'resolved' ? 'animate-pulse' : '' }}"></span>
                                <span class="text-xs font-black text-white uppercase tracking-widest">{{ $currentStatus['label'] }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <div class="lg:col-span-2 space-y-8">
                                <div class="bg-white/5 rounded-[2.5rem] p-8 border border-white/5 shadow-inner">
                                    <label class="text-[10px] font-black text-white/20 uppercase tracking-[0.2em] mb-6 block">Aspirasi Kamu:</label>
                                    <h4 class="text-white font-black text-xl mb-4 italic leading-tight">"{{ $aspiration->subject }}"</h4>
                                    <p class="text-white/60 text-base leading-relaxed font-medium">{{ $aspiration->message }}</p>
                                </div>

                                <div class="bg-primary/20 rounded-[2.5rem] p-8 border border-white/10 relative shadow-inner">
                                    <div class="absolute -top-3 left-10 px-4 py-1.5 bg-primary rounded-full text-[10px] font-black text-white uppercase tracking-widest italic shadow-lg shadow-black/20">
                                        Tanggapan Advokasi
                                    </div>
                                    <div class="flex gap-6">
                                        <div class="size-12 rounded-2xl bg-primary-soft flex items-center justify-center text-primary-dark shrink-0 mt-1 shadow-lg">
                                            <x-heroicon-s-shield-check class="size-7" />
                                        </div>
                                        <div class="flex-1">
                                            @if($aspiration->status == 'pending')
                                                <p class="text-white/50 text-sm italic font-medium leading-relaxed">Menunggu tim advokasi meninjau aspirasimu. Kami akan segera memprosesnya.</p>
                                            @elseif($aspiration->status == 'reviewed')
                                                <p class="text-white/80 text-sm leading-relaxed font-medium">Aspirasi kamu sedang dalam tahap koordinasi dengan departemen terkait. Terima kasih atas kesabarannya.</p>
                                            @else
                                                <p class="text-white/90 text-sm leading-relaxed font-medium">Aspirasi ini telah selesai ditindaklanjuti. Terima kasih telah berkontribusi.</p>
                                            @endif
                                            <p class="text-primary-soft text-[11px] font-black uppercase tracking-[0.2em] mt-6 italic">— Tim Advokasi HMTIF</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="bg-white/5 rounded-[2.5rem] p-8 border border-white/5 h-full flex flex-col relative overflow-hidden">
                                    <label class="text-[10px] font-black text-white/20 uppercase tracking-[0.2em] mb-8 block relative z-10">Progres:</label>
                                    
                                    <div class="space-y-10 relative flex-1 z-10">
                                        {{-- Timeline Line --}}
                                        <div class="absolute left-[15px] top-0 bottom-4 w-0.5 bg-white/5 border-l border-dashed border-white/20"></div>
                                        
                                        {{-- Step 1 --}}
                                        <div class="flex gap-5 relative">
                                            <div class="size-8 rounded-full {{ $currentStatus['step'] >= 1 ? 'bg-primary-soft text-primary-dark ring-4 ring-primary-soft/20' : 'bg-white/10' }} flex items-center justify-center z-10 transition-all duration-700">
                                                <x-heroicon-s-check class="size-5" />
                                            </div>
                                            <div class="pt-1">
                                                <h5 class="text-white text-xs font-black leading-none mb-1.5 uppercase tracking-wide">Diterima</h5>
                                                <p class="text-white/20 text-[10px] font-bold italic uppercase tracking-tighter">Step 1</p>
                                            </div>
                                        </div>

                                        {{-- Step 2 --}}
                                        <div class="flex gap-5 relative {{ $currentStatus['step'] < 2 ? 'opacity-30 grayscale' : '' }}">
                                            <div class="size-8 rounded-full {{ $currentStatus['step'] >= 2 ? 'bg-primary-soft text-primary-dark ring-4 ring-primary-soft/20' : 'bg-white/10' }} flex items-center justify-center z-10 transition-all duration-700">
                                                @if($currentStatus['step'] == 2)
                                                    <div class="size-2 rounded-full bg-primary-dark animate-pulse"></div>
                                                @elseif($currentStatus['step'] > 2)
                                                    <x-heroicon-s-check class="size-5" />
                                                @else
                                                    <span class="text-[10px] font-black text-white/20">2</span>
                                                @endif
                                            </div>
                                            <div class="pt-1">
                                                <h5 class="text-white text-xs font-black leading-none mb-1.5 uppercase tracking-wide">Diproses</h5>
                                                <p class="text-white/20 text-[10px] font-bold italic uppercase tracking-tighter">Step 2</p>
                                            </div>
                                        </div>

                                        {{-- Step 3 --}}
                                        <div class="flex gap-5 relative {{ $currentStatus['step'] < 3 ? 'opacity-30 grayscale' : '' }}">
                                            <div class="size-8 rounded-full {{ $currentStatus['step'] >= 3 ? 'bg-primary-soft text-primary-dark ring-4 ring-primary-soft/20' : 'bg-white/10' }} flex items-center justify-center z-10 transition-all duration-700">
                                                <x-heroicon-s-check class="size-5" />
                                            </div>
                                            <div class="pt-1">
                                                <h5 class="text-white text-xs font-black leading-none mb-1.5 uppercase tracking-wide">Selesai</h5>
                                                <p class="text-white/20 text-[10px] font-bold italic uppercase tracking-tighter">Step 3</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Not Found State (Brand) --}}
                    <div class="relative z-10 mt-16 pt-16 border-t border-white/10 text-center animate-in fade-in zoom-in duration-500">
                        <div class="size-24 bg-white/5 border border-white/10 rounded-[2.5rem] flex items-center justify-center text-primary-soft mx-auto mb-8 shadow-inner">
                            <x-heroicon-o-magnifying-glass-circle class="size-12" />
                        </div>
                        <h3 class="text-white font-black text-2xl mb-3 italic tracking-tight uppercase">Kode Tidak Valid</h3>
                        <p class="text-white/30 text-sm font-medium max-w-sm mx-auto leading-relaxed">Pastikan kode yang Anda masukkan sudah benar.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</section>