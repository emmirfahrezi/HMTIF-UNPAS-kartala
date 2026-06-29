{{-- Modal Balas & Feedback --}}
<div x-show="feedbackModalOpen" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto bg-slate-950/45 backdrop-blur-sm"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @keydown.escape.window="feedbackModalOpen = false">

    <div @click.away="feedbackModalOpen = false"
        class="w-full max-w-lg bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-200/50 dark:border-slate-800/50 p-8 shadow-2xl space-y-6 relative"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4">
        
        {{-- Close Button --}}
        <button type="button" @click="feedbackModalOpen = false"
            class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors animate-fade-in">
            <x-heroicon-o-x-mark class="size-6" />
        </button>

        <div class="flex items-center gap-3">
            <div class="size-10 rounded-2xl bg-indigo-500/10 text-indigo-500 flex items-center justify-center">
                <x-heroicon-o-chat-bubble-left-right class="size-5" />
            </div>
            <div>
                <h3 class="text-base font-black text-slate-850 dark:text-white">Balas & Kirim Feedback</h3>
                <p class="text-xs text-slate-400 dark:text-slate-500">Berikan tanggapan resmi dan ubah status aspirasi ini</p>
            </div>
        </div>

        {{-- Form Feedback --}}
        <form action="{{ route('dashboard.aspirations.feedback', $aspiration->id) }}" method="POST" class="space-y-5"
            x-data="{
                saving: false
            }"
            @submit="saving = true">
            @csrf
            @method('PUT')

            {{-- Ubah Status --}}
            <x-molecules.shared.forms.form-input 
                type="select" 
                label="Status Pelacakan" 
                name="status" 
                :value="$aspiration->status"
                :options="[
                    'pending' => 'Pending (Belum Diulas)',
                    'reviewed' => 'Reviewed (Sedang Diulas)',
                    'resolved' => 'Resolved (Selesai / Ditindaklanjuti)',
                    'rejected' => 'Rejected (Ditolak / Tidak Sesuai)'
                ]"
                required 
            />

            {{-- Pesan Feedback --}}
            <x-molecules.shared.forms.form-input 
                type="textarea" 
                label="Pesan Tanggapan (Feedback)" 
                name="feedback" 
                placeholder="Tuliskan tanggapan atau tindak lanjut resmi HMTIF..."
                required 
                :rows="5"
                helper="Pesan tanggapan ini akan dikirim via email dan dapat dilacak oleh pengirim."
            />

            {{-- Checkbox Salinan Email --}}
            @if ($aspiration->email)
            <div class="bg-indigo-500/5 dark:bg-indigo-500/10 rounded-2xl p-4 border border-indigo-100/5 dark:border-indigo-500/20 flex items-start gap-3 transition-all duration-300">
                <x-heroicon-o-envelope class="size-5 text-indigo-500 dark:text-indigo-400 shrink-0 mt-0.5" />
                <div class="space-y-1 flex-1">
                    <x-atoms.shared.checkbox 
                        name="send_email" 
                        id="send_email" 
                        value="1" 
                        :checked="true"
                        label="Kirim salinan ke Email" 
                    />
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 leading-normal mt-1.5 pl-7.5">Salinan tanggapan ini akan dikirim otomatis ke alamat email pengirim: <strong class="text-indigo-400 dark:text-indigo-300">{{ $aspiration->email }}</strong>.</p>
                </div>
            </div>
            @endif

            {{-- Actions Button --}}
            <div class="flex justify-end gap-3 pt-3 border-t border-slate-100 dark:border-slate-800/50">
                <x-atoms.shared.button 
                    type="button" 
                    variant="ghost" 
                    @click="feedbackModalOpen = false">
                    Batal
                </x-atoms.shared.button>
                <x-atoms.shared.button 
                    type="submit" 
                    variant="primary" 
                    class="shadow-lg shadow-primary/20">
                    <span x-show="!saving" class="flex items-center gap-1.5">
                        <x-heroicon-o-paper-airplane class="size-4" />
                        Kirim Tanggapan
                    </span>
                    <span x-show="saving" class="flex items-center gap-2" style="display: none;">
                        <svg class="animate-spin size-4" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Mengirim...
                    </span>
                </x-atoms.shared.button>
            </div>
        </form>
    </div>
</div>
