{{-- Track Aspiration (Official Brand Theme) --}}
<section class="py-12 relative">
    @php
        $trackCode = strtoupper(trim((string) request('code')));
        $aspiration = $trackedAspiration ?? null;
        
        $statusMap = [
            'pending'  => ['label' => 'Aspirasi Masuk', 'step' => 1],
            'reviewed' => ['label' => 'Sedang Diproses', 'step' => 2],
            'resolved' => ['label' => 'Selesai', 'step' => 3],
        ];
        
        $currentStatus = $aspiration ? ($statusMap[$aspiration->status] ?? $statusMap['pending']) : null;

        // Custom high-contrast badges using brand global colors & dark contrast backdrops
        $badgeClasses = '';
        $dotColor = '';
        if ($aspiration) {
            $badgeClasses = match($aspiration->status) {
                'pending'  => 'bg-black/30 border border-secondary-soft/30 text-secondary-soft shadow-[0_4px_20px_rgba(0,0,0,0.15)]',
                'reviewed' => 'bg-black/30 border border-primary-soft/30 text-primary-soft shadow-[0_4px_20px_rgba(0,0,0,0.15)]',
                'resolved' => 'bg-black/30 border border-white/20 text-white shadow-[0_4px_20px_rgba(0,0,0,0.15)]',
                default    => 'bg-black/30 border border-white/10 text-white',
            };
            $dotColor = match($aspiration->status) {
                'pending'  => 'bg-secondary-soft',
                'reviewed' => 'bg-primary-soft',
                'resolved' => 'bg-white',
                default    => 'bg-white',
            };
        }
    @endphp

    <div class="mx-auto px-6 lg:px-8 max-w-5xl">
        {{-- Card Container using strictly official primary-dark --}}
        <div class="bg-primary-dark rounded-3xl p-8 md:p-14 shadow-2xl relative overflow-hidden border border-white/10 transition-colors duration-300 group">
            {{-- Glowing radial light background decor using strictly official primary --}}
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-primary opacity-30 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-1000"></div>

            <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="text-center lg:text-left flex-1">
                    <h2 class="text-4xl font-extrabold text-white uppercase tracking-tight leading-none mb-4">
                        Pantau <span class="text-primary-soft">Aspirasimu</span>
                    </h2>
                    <p class="text-white/60 text-sm max-w-sm font-medium leading-relaxed">
                        Masukkan kode tracking untuk memantau perkembangan aspirasi Anda secara transparan.
                    </p>
                </div>

                {{-- Glowing input field & premium action button using strictly brand colors --}}
                <form action="{{ route('aspirations') }}" method="GET" 
                    onsubmit="
                        const codeInput = this.querySelector('input[name=\'code\']');
                        if (!codeInput || !codeInput.value.trim()) {
                            event.preventDefault();
                            if (window.toast) {
                                window.toast('Silakan masukkan kode tracking terlebih dahulu!', 'warning');
                            }
                            return false;
                        }
                    "
                    class="w-full lg:w-auto flex flex-col sm:flex-row gap-4">
                    <div class="relative group/input flex-1 sm:w-85">
                        <x-heroicon-o-hashtag class="size-5 text-white/30 absolute left-5 top-1/2 -translate-y-1/2 group-focus-within/input:text-primary-soft transition-colors" />
                        <input type="text" name="code" value="{{ $trackCode }}" placeholder="XXXXXXXXX"
                            autocomplete="off"
                            oninput="this.value = this.value.toUpperCase()"
                            class="w-full pl-12 pr-6 py-5 bg-black/20 border border-white/15 rounded-2xl text-white placeholder:text-white/20 focus:outline-none focus:ring-4 focus:ring-primary/20 focus:border-primary-soft transition-all font-black tracking-widest text-sm uppercase">
                    </div>
                    <button type="submit"
                        class="px-10 py-5 bg-primary-soft hover:bg-white text-primary-dark font-black text-sm rounded-2xl shadow-lg shadow-black/20 hover:-translate-y-0.5 active:translate-y-0 transition-all shrink-0 flex items-center justify-center gap-2">
                        <span>Cek Status</span>
                        <x-heroicon-o-magnifying-glass class="size-5" />
                    </button>
                </form>
            </div>

            @if ($trackCode !== '')
                @if ($aspiration)
                    {{-- Results Area --}}
                    <div class="relative z-10 mt-12 pt-12 border-t border-white/10 flex flex-col gap-8 animate-in fade-in slide-in-from-bottom-8 duration-700">
                        {{-- Top Header info with deep contrast background --}}
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-8 bg-black/20 border border-white/10 rounded-3xl p-6 shadow-inner">
                            <div class="flex items-center gap-5">
                                <div class="size-16 rounded-2xl bg-black/20 border border-white/10 flex items-center justify-center text-primary-soft shadow-inner">
                                    <x-heroicon-o-chat-bubble-bottom-center-text class="size-8" />
                                </div>
                                <div>
                                    <h3 class="text-white font-black text-2xl leading-none mb-2 uppercase tracking-tight">{{ $aspiration->tracking_code }}</h3>
                                    <p class="text-white/40 text-xs font-bold uppercase tracking-widest">Dikirim: {{ $aspiration->created_at->format('d M Y') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 px-6 py-3 rounded-2xl border {{ $badgeClasses }}">
                                <span class="size-2.5 rounded-full {{ $dotColor }} {{ $aspiration->status != 'resolved' ? 'animate-pulse' : '' }}"></span>
                                <span class="text-xs font-black uppercase tracking-widest">{{ $currentStatus['label'] }}</span>
                            </div>
                        </div>

                        {{-- Details Grid --}}
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <div class="lg:col-span-2 space-y-8">
                                {{-- Aspiration Details card with deep contrast obsidian background --}}
                                <div class="bg-black/20 backdrop-blur-md rounded-3xl p-8 border border-white/10 shadow-lg">
                                    <label class="text-[10px] font-black text-primary-soft uppercase tracking-[0.2em] mb-4 block">Aspirasi Kamu:</label>
                                    <h4 class="text-white font-bold text-2xl mb-4 italic leading-tight break-words">"{{ $aspiration->subject }}"</h4>
                                    <p class="text-white/80 text-base leading-relaxed font-medium break-words">{{ $aspiration->message }}</p>
                                </div>

                                {{-- Advocacy Response card with deep contrast obsidian background --}}
                                <div class="bg-black/20 backdrop-blur-md rounded-3xl p-8 border border-white/10 relative shadow-lg">
                                    <div class="absolute -top-3 left-10 px-4 py-1.5 bg-primary-soft rounded-full text-[10px] font-black text-primary-dark uppercase tracking-widest italic shadow-lg shadow-black/20">
                                        Tanggapan Advokasi
                                    </div>
                                    <div class="flex gap-6 mt-2">
                                        <div class="size-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-primary-soft shrink-0 mt-1 shadow-inner">
                                            <x-heroicon-s-shield-check class="size-7" />
                                        </div>
                                        <div class="flex-1">
                                            @if(!empty($aspiration->admin_feedback))
                                                <p class="text-white/90 text-sm leading-relaxed font-semibold break-words">{{ $aspiration->admin_feedback }}</p>
                                            @else
                                                @if($aspiration->status == 'pending')
                                                    <p class="text-white/60 text-sm italic font-medium leading-relaxed">Menunggu tim advokasi meninjau aspirasimu. Kami akan segera memprosesnya.</p>
                                                @elseif($aspiration->status == 'reviewed')
                                                    <p class="text-white/80 text-sm leading-relaxed font-medium">Aspirasi kamu sedang dalam tahap koordinasi dengan departemen terkait. Terima kasih atas kesabarannya.</p>
                                                @else
                                                    <p class="text-primary-soft text-sm leading-relaxed font-black">Aspirasi ini telah selesai ditindaklanjuti. Terima kasih telah berkontribusi.</p>
                                                @endif
                                            @endif
                                            <p class="text-primary-soft text-[11px] font-black uppercase tracking-[0.2em] mt-6 italic">— Tim Advokasi HMTIF</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Timeline Column with premium active/inactive contrast and deep background --}}
                            <div class="space-y-6">
                                <div class="bg-black/20 backdrop-blur-md rounded-3xl p-8 border border-white/10 h-full flex flex-col relative overflow-hidden shadow-lg">
                                    <label class="text-[10px] font-black text-primary-soft uppercase tracking-[0.2em] mb-8 block relative z-10">Progres:</label>
                                    
                                    <div class="space-y-10 relative flex-1 z-10">
                                        {{-- Timeline Connector Line with high contrast solid primary-soft/30 --}}
                                        <div class="absolute left-[17px] top-0 bottom-4 w-0.5 bg-primary-soft/30"></div>
                                        
                                        {{-- Step 1 --}}
                                        <div class="flex gap-5 relative">
                                            <div class="size-9 rounded-full bg-primary-soft text-primary-dark ring-4 ring-primary-soft/25 flex items-center justify-center z-10 shadow-lg shadow-black/20 transition-all duration-700">
                                                <x-heroicon-s-check class="size-5" />
                                            </div>
                                            <div class="pt-1">
                                                <h5 class="text-white text-sm font-black leading-none mb-1.5 uppercase tracking-wide">Diterima</h5>
                                                <p class="text-primary-soft/60 text-[10px] font-bold italic uppercase tracking-wider">Langkah 1</p>
                                            </div>
                                        </div>

                                        {{-- Step 2 --}}
                                        @php $step2Active = $currentStatus['step'] >= 2; @endphp
                                        <div class="flex gap-5 relative transition-all duration-500">
                                            <div class="size-9 rounded-full flex items-center justify-center z-10 transition-all duration-700
                                                {{ $step2Active 
                                                    ? 'bg-primary-soft text-primary-dark ring-4 ring-primary-soft/25 shadow-lg shadow-black/20' 
                                                    : 'bg-black/30 border border-white/20 text-white/50' }}">
                                                @if($currentStatus['step'] == 2)
                                                    <div class="size-3 rounded-full bg-primary-dark animate-pulse"></div>
                                                @elseif($currentStatus['step'] > 2)
                                                    <x-heroicon-s-check class="size-5" />
                                                @else
                                                    <span class="text-xs font-black">2</span>
                                                @endif
                                            </div>
                                            <div class="pt-1">
                                                <h5 class="text-sm font-black leading-none mb-1.5 uppercase tracking-wide {{ $step2Active ? 'text-white' : 'text-white/50' }}">Diproses</h5>
                                                <p class="text-[10px] font-bold italic uppercase tracking-wider {{ $step2Active ? 'text-primary-soft/60' : 'text-white/25' }}">Langkah 2</p>
                                            </div>
                                        </div>

                                        {{-- Step 3 --}}
                                        @php $step3Active = $currentStatus['step'] >= 3; @endphp
                                        <div class="flex gap-5 relative transition-all duration-500">
                                            <div class="size-9 rounded-full flex items-center justify-center z-10 transition-all duration-700
                                                {{ $step3Active 
                                                    ? 'bg-primary-soft text-primary-dark ring-4 ring-primary-soft/25 shadow-lg shadow-black/20' 
                                                    : 'bg-black/30 border border-white/20 text-white/50' }}">
                                                @if($step3Active)
                                                    <x-heroicon-s-check class="size-5" />
                                                @else
                                                    <span class="text-xs font-black">3</span>
                                                @endif
                                            </div>
                                            <div class="pt-1">
                                                <h5 class="text-sm font-black leading-none mb-1.5 uppercase tracking-wide {{ $step3Active ? 'text-white' : 'text-white/50' }}">Selesai</h5>
                                                <p class="text-[10px] font-bold italic uppercase tracking-wider {{ $step3Active ? 'text-primary-soft/60' : 'text-white/25' }}">Langkah 3</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Not Found State (Brand matching global theme) --}}
                    <div class="relative z-10 mt-16 pt-16 border-t border-white/10 text-center animate-in fade-in zoom-in duration-500">
                        <div class="size-24 bg-black/20 border border-white/10 rounded-3xl flex items-center justify-center text-primary-soft mx-auto mb-8 shadow-inner">
                            <x-heroicon-o-magnifying-glass-circle class="size-12" />
                        </div>
                        <h3 class="text-white font-black text-2xl mb-3 italic tracking-tight uppercase">Kode Tidak Valid</h3>
                        <p class="text-white/40 text-sm font-medium max-w-sm mx-auto leading-relaxed">Pastikan kode yang Anda masukkan sudah benar.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</section>
