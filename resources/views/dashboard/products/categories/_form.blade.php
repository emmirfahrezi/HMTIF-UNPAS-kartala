<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
            <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-tag class="size-32" />
            </div>
            
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
                    <x-heroicon-s-bookmark class="size-5" />
                </span>
                Informasi Kategori
            </h3>

            <div class="space-y-6" x-data="slugHelper(@js(old('name', $category?->name)), @js(old('slug', $category?->slug)))">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-molecules.shared.forms.form-input 
                        label="Nama Kategori" 
                        name="name" 
                        placeholder="Contoh: Apparel, Digital, dll."
                        :value="$category?->name ?? ''" 
                        required 
                        x-model="sourceValue" />

                    <x-molecules.shared.forms.form-input 
                        label="Slug" 
                        name="slug" 
                        placeholder="auto-generated"
                        :value="$category?->slug ?? ''" 
                        required 
                        x-model="slugValue" 
                        readonly />
                </div>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-8">
        {{-- Info Card --}}
        <div class="bg-primary/5 dark:bg-primary/10 rounded-2xl p-6 border border-primary/10 dark:border-primary/20 relative overflow-hidden transition-colors duration-300">
             <div class="absolute top-0 right-0 p-4 opacity-[0.05] text-primary pointer-events-none">
                <x-heroicon-o-light-bulb class="size-20" />
            </div>
            <div class="flex gap-4 relative z-10">
                <div class="size-10 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center shrink-0">
                    <x-heroicon-s-information-circle class="size-5" />
                </div>
                <div>
                    <h4 class="text-xs font-black text-primary uppercase tracking-widest mb-1">Tips</h4>
                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        Gunakan nama kategori yang singkat dan deskriptif untuk memudahkan pencarian produk oleh user.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

