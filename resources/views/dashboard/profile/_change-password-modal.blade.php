{{-- Modal Ganti Password (Alpine Overlay Modal) --}}
<div x-show="passwordModalOpen" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto bg-slate-950/45 backdrop-blur-sm"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @keydown.escape.window="passwordModalOpen = false">

    <div @click.away="passwordModalOpen = false"
        class="w-full max-w-md bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-200/50 dark:border-slate-800/50 p-8 shadow-2xl space-y-6 relative"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4">
        
        {{-- Close Button --}}
        <button type="button" @click="passwordModalOpen = false"
            class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors">
            <x-heroicon-o-x-mark class="size-6" />
        </button>

        <div class="flex items-center gap-3">
            <div class="size-10 rounded-2xl bg-amber-500/10 text-amber-500 flex items-center justify-center">
                <x-heroicon-o-key class="size-5" />
            </div>
            <div>
                <h3 class="text-base font-black text-slate-850 dark:text-white">Ganti Password</h3>
                <p class="text-xs text-slate-400 dark:text-slate-500">Perbarui kunci sandi akun Anda</p>
            </div>
        </div>

        {{-- Form Password --}}
        <form action="{{ route('dashboard.profile.password') }}" method="POST" class="space-y-5"
            x-data="{
                saving: false
            }"
            @submit="saving = true">
            @csrf
            @method('PUT')

            {{-- Password Lama --}}
            <x-molecules.shared.forms.form-input 
                type="password" 
                label="Password Saat Ini" 
                name="old_password" 
                placeholder="••••••••"
                required 
            />

            {{-- Password Baru --}}
            <x-molecules.shared.forms.form-input 
                type="password" 
                label="Password Baru" 
                name="password" 
                placeholder="••••••••"
                helper="Minimal 8 karakter berupa kombinasi huruf & angka."
                required 
            />

            {{-- Konfirmasi Password --}}
            <x-molecules.shared.forms.form-input 
                type="password" 
                label="Konfirmasi Password Baru" 
                name="password_confirmation" 
                placeholder="••••••••"
                required 
            />

            {{-- Actions Button --}}
            <div class="flex justify-end gap-3 pt-3 border-t border-slate-100 dark:border-slate-800/50">
                <x-atoms.shared.button 
                    type="button" 
                    variant="ghost" 
                    @click="passwordModalOpen = false">
                    Batal
                </x-atoms.shared.button>
                <x-atoms.shared.button 
                    type="submit" 
                    variant="warning" 
                    class="shadow-lg shadow-amber-500/20">
                    <span x-show="!saving" class="flex items-center gap-1.5">
                        <x-heroicon-o-check class="size-4" />
                        Simpan Password
                    </span>
                    <span x-show="saving" class="flex items-center gap-2" style="display: none;">
                        <svg class="animate-spin size-4" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Menyimpan...
                    </span>
                </x-atoms.shared.button>
            </div>
        </form>
    </div>
</div>
