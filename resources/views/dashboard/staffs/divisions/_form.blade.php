<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
            <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-building-office-2 class="size-32" />
            </div>
            
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
                    <x-heroicon-s-rectangle-group class="size-5" />
                </span>
                Informasi Divisi
            </h3>

            <div class="space-y-6" x-data="slugHelper(@js(old('name', $division?->name)), @js(old('slug', $division?->slug)))">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-molecules.shared.forms.form-input 
                        label="Nama Divisi" 
                        name="name" 
                        placeholder="Contoh: Minat Bakat"
                        :value="$division?->name ?? ''" 
                        required 
                        x-model="sourceValue" />

                    <x-molecules.shared.forms.form-input 
                        label="Slug" 
                        name="slug" 
                        placeholder="auto-generated"
                        :value="$division?->slug ?? ''" 
                        required 
                        x-model="slugValue" 
                        readonly />
                </div>

                <x-molecules.shared.forms.form-input 
                    label="Deskripsi (Opsional)" 
                    name="description" 
                    type="textarea"
                    placeholder="Tuliskan deskripsi atau tugas divisi ini..."
                    :value="$division?->description ?? ''" 
                    :rows="4" />
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-8">
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
            <div class="absolute top-0 right-0 p-6 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-list-bullet class="size-24" />
            </div>
            
            <h3 class="text-xs font-black text-slate-800 dark:text-white mb-6 uppercase tracking-widest text-center">Pengaturan</h3>
            
            <div class="space-y-6">
                <x-molecules.shared.forms.form-input 
                    label="Urutan Tampil" 
                    name="order" 
                    type="number"
                    :value="$division?->order ?? 0" 
                    helper="Urutan divisi di halaman Struktur Organisasi" />
            </div>
        </div>

        {{-- Info Card --}}
        <div class="bg-primary/5 dark:bg-primary/10 rounded-2xl p-6 border border-primary/10 dark:border-primary/20 transition-colors duration-300">
            <div class="flex gap-4">
                <div class="size-10 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center shrink-0">
                    <x-heroicon-s-information-circle class="size-5" />
                </div>
                <div>
                    <h4 class="text-xs font-black text-primary uppercase tracking-widest mb-1">Info</h4>
                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        Divisi dengan urutan terkecil akan muncul paling awal.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
