<x-layouts.dashboard pageTitle="Detail Aspirasi" :breadcrumbs="[['label' => 'Aspirasi', 'href' => '/dashboard/aspirations'], ['label' => 'Detail']]">
    <div class="max-w-5xl mx-auto space-y-6">
        {{-- Header Card --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-4 transition-colors duration-300">
            <div class="flex items-center gap-4">
                <div class="size-14 bg-primary/10 dark:bg-primary/20 rounded-2xl flex items-center justify-center text-primary">
                    <x-heroicon-o-chat-bubble-left-right class="size-7" />
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ $aspiration->subject }}</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Dikirim pada {{ $aspiration->created_at->format('d F Y, H:i') }} WIB</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                @php
                    $statusColors = [
                        'pending' => 'bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-500',
                        'reviewed' => 'bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-500',
                        'resolved' => 'bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-500',
                        'rejected' => 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-500',
                    ];
                @endphp
                <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase {{ $statusColors[$aspiration->status] ?? 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400' }}">
                    {{ $aspiration->status }}
                </span>
                
                @if ($aspiration->is_spotlight)
                    <span class="flex items-center gap-1 px-3 py-1.5 bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-500 rounded-full text-xs font-bold uppercase">
                        <x-heroicon-s-star class="size-3.5" />
                        Spotlight
                    </span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left Column: Sender Info --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white dark:bg-slate-900/50 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800 transition-colors duration-300">
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-5 flex items-center gap-2">
                        <x-heroicon-o-user class="size-4 text-primary" />
                        Informasi Pengirim
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Nama Lengkap</p>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $aspiration->name ?: 'Anonim' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">NIM</p>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $aspiration->nim ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Email</p>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $aspiration->email ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Kode Tracking</p>
                            <div class="inline-flex items-center gap-2 px-2 py-1 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-lg">
                                <code class="text-xs font-mono text-primary font-bold">{{ $aspiration->tracking_code }}</code>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Card --}}
                <div class="bg-slate-900 dark:bg-slate-950 rounded-3xl p-6 shadow-xl shadow-slate-200 dark:shadow-none text-white border dark:border-slate-800 transition-all">
                    <h3 class="text-sm font-bold mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-1 gap-3">
                        <x-atoms.shared.button 
                            variant="on-primary"
                            href="/dashboard/aspirations/{{ $aspiration->id }}/edit"
                            icon="heroicon-o-pencil-square"
                            class="w-full">
                            Ubah Status
                        </x-atoms.shared.button>
                        <x-atoms.shared.button 
                            variant="danger"
                            @click="openDeleteModal('/dashboard/aspirations/{{ $aspiration->id }}')"
                            icon="heroicon-o-trash"
                            class="w-full">
                            Hapus Aspirasi
                        </x-atoms.shared.button>
                    </div>
                </div>
            </div>

            {{-- Right Column: Message Content --}}
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-slate-900/50 rounded-3xl p-8 shadow-sm border border-slate-100 dark:border-slate-800 min-h-[400px] flex flex-col transition-colors duration-300">
                    <div class="flex items-center gap-2 text-slate-400 dark:text-slate-500 mb-6">
                        <x-heroicon-o-document-text class="size-5" />
                        <span class="text-xs font-bold uppercase tracking-widest">Isi Aspirasi</span>
                    </div>
                    
                    <div class="prose dark:prose-invert prose-slate max-w-none flex-1">
                        <p class="text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-line text-lg italic font-serif">
                            "{{ $aspiration->message }}"
                        </p>
                    </div>

                    <div class="mt-8 pt-8 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ config('app.logo_url') }}" class="size-8 opacity-20 grayscale dark:invert" alt="Logo">
                            <span class="text-[10px] text-slate-300 dark:text-slate-600 font-bold uppercase tracking-widest">HMTIF UNPAS • Kartala Dashboard</span>
                        </div>
                        <x-atoms.shared.button 
                            variant="ghost" 
                            size="sm"
                            href="/dashboard/aspirations"
                            class="text-xs font-bold text-primary">
                            Kembali ke Daftar
                        </x-atoms.shared.button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-layouts.dashboard>
