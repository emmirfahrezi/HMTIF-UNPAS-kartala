<x-layouts.dashboard pageTitle="Detail Aspirasi" :breadcrumbs="[['label' => 'Aspirasi', 'href' => '/dashboard/aspirations'], ['label' => 'Detail']]">
    @php
        $statusColorClass = $aspiration->status_color_class ?: match ($aspiration->status) {
            'pending' => 'bg-amber-500/10 border border-amber-500/20 text-amber-600 dark:text-amber-400',
            'reviewed' => 'bg-sky-500/10 border border-sky-500/20 text-sky-600 dark:text-sky-400',
            'resolved' => 'bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400',
            'rejected' => 'bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400',
            default => 'bg-slate-500/10 border border-slate-500/20 text-slate-600 dark:text-slate-400',
        };
    @endphp

    <div x-data="{ feedbackModalOpen: false }" class="max-w-5xl mx-auto space-y-6">
        
        {{-- Header Card --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-4 transition-colors duration-300">
            <div class="flex items-center gap-4">
                <div class="size-14 bg-primary/10 dark:bg-primary/20 rounded-2xl flex items-center justify-center text-primary">
                    <x-heroicon-o-chat-bubble-left-right class="size-7" />
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white break-words">{{ $aspiration->subject }}</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Dikirim pada {{ $aspiration->created_at->format('d F Y, H:i') }} WIB</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <span class="{{ $statusColorClass }} rounded-full px-4 py-1.5 text-xs font-medium">
                    {{ $aspiration->status_label }}
                </span>
                

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

                @if ($permissions['update'] ?? false)
                    {{-- Action Card --}}
                    <div class="bg-slate-900 dark:bg-slate-950 rounded-3xl p-6 shadow-xl shadow-slate-200 dark:shadow-none text-white border dark:border-slate-800 transition-all">
                        <h3 class="text-sm font-bold mb-4">Aksi Cepat</h3>
                        <div class="grid grid-cols-1 gap-3">
                            <x-atoms.shared.button
                                type="button"
                                variant="primary"
                                @click="feedbackModalOpen = true"
                                icon="heroicon-o-chat-bubble-left-right"
                                class="w-full">
                                Balas & Feedback
                            </x-atoms.shared.button>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right Column: Message Content & Feedback History --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Aspiration Message Card --}}
                <div class="bg-white dark:bg-slate-900/50 rounded-3xl p-8 shadow-sm border border-slate-100 dark:border-slate-800 min-h-[300px] flex flex-col transition-colors duration-300">
                    <div class="flex items-center gap-2 text-slate-400 dark:text-slate-500 mb-6">
                        <x-heroicon-o-document-text class="size-5" />
                        <span class="text-xs font-bold uppercase tracking-widest">Isi Aspirasi</span>
                    </div>
                    
                    <div class="prose dark:prose-invert prose-slate max-w-none flex-1">
                        <p class="text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-line text-lg italic font-serif break-words">
                            "{{ $aspiration->message }}"
                        </p>
                    </div>

                    <div class="mt-8 pt-8 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ config('app.logo_url') }}" class="size-8 opacity-20 grayscale dark:invert" alt="Logo">
                            <span class="text-[10px] text-slate-300 dark:text-slate-600 font-bold uppercase tracking-widest">HMTIF-UNPAS • Kartala Dashboard</span>
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

                {{-- Feedback Reply Card (If exists) --}}
                @if (!empty($aspiration->admin_feedback))
                    <div class="bg-white dark:bg-slate-900/50 rounded-3xl p-8 shadow-sm border border-slate-100 dark:border-slate-800 transition-colors duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="size-10 rounded-2xl bg-indigo-500/10 text-indigo-500 flex items-center justify-center shrink-0">
                                    <x-heroicon-o-check-badge class="size-6" />
                                </div>
                                <div>
                                    <h3 class="text-base font-black text-slate-850 dark:text-white">Tanggapan Resmi Pengurus</h3>
                                    <p class="text-xs text-slate-400 dark:text-slate-500">Dikirim oleh Admin HMTIF-UNPAS</p>
                                </div>
                            </div>
                            <span class="text-xs text-slate-400 dark:text-slate-500 font-medium">
                                {{ $aspiration->feedback_sent_at ? \Carbon\Carbon::parse($aspiration->feedback_sent_at)->format('d F Y, H:i') : now()->format('d F Y, H:i') }} WIB
                            </span>
                        </div>

                        <div class="bg-indigo-50/50 dark:bg-indigo-500/5 border border-indigo-100/50 dark:border-indigo-500/10 rounded-2xl p-5 text-sm leading-relaxed text-slate-700 dark:text-slate-300 break-words">
                            {{ $aspiration->admin_feedback }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if ($permissions['update'] ?? false)
            @include('dashboard.aspirations._show-feedback-modal')
        @endif

    </div>
</x-layouts.dashboard>
