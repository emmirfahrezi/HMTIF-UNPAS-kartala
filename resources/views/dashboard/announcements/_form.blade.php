<div class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-data="slugHelper(@js(old('title', $announcement?->title)), @js(old('slug', $announcement?->slug)))">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        {{-- Primary Information --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
            <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-megaphone class="size-32" />
            </div>
            
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
                    <x-heroicon-s-information-circle class="size-5" />
                </span>
                Informasi Pengumuman
            </h3>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-molecules.shared.forms.form-input 
                        label="Judul Pengumuman" 
                        name="title" 
                        placeholder="Masukan judul..."
                        :value="$announcement?->title ?? ''" 
                        x-model="sourceValue"
                        required />

                    <x-molecules.shared.forms.form-input 
                        label="Slug (Auto)" 
                        name="slug" 
                        placeholder="dibuat otomatis"
                        :value="$announcement?->slug ?? ''" 
                        x-model="slugValue"
                        readonly
                        required />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-molecules.shared.forms.form-input 
                        label="Kategori" 
                        name="announcement_category_id" 
                        type="select"
                        :value="$announcement?->announcement_category_id ?? ''" 
                        :options="$categories ?? []"
                        required />
                    
                    <x-molecules.shared.forms.form-input 
                        label="Tanggal Publikasi" 
                        name="published_at" 
                        type="datetime-local"
                        :value="$announcement?->published_at?->format('Y-m-d\TH:i') ?? now()->format('Y-m-d\TH:i')" />
                </div>

                <x-molecules.shared.forms.form-input 
                    label="Ringkasan Singkat" 
                    name="excerpt" 
                    type="textarea"
                    placeholder="Tuliskan ringkasan singkat pengumuman..."
                    :value="$announcement?->excerpt ?? ''" 
                    :rows="3" />
            </div>
        </div>

        {{-- Content Body --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm transition-colors duration-300">
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-blue-500/10 dark:bg-blue-500/20 text-blue-500 flex items-center justify-center">
                    <x-heroicon-s-document-text class="size-5" />
                </span>
                Isi Pengumuman
            </h3>

            <x-molecules.shared.forms.form-input 
                name="body" 
                type="richtext"
                placeholder="Tuliskan isi lengkap pengumuman di sini..."
                :value="$announcement?->body ?? ''" 
                required />
        </div>

    </div>

    {{-- Sidebar Content --}}
    <div class="space-y-8">
        {{-- Media --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
            <div class="absolute top-0 right-0 p-6 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-photo class="size-24" />
            </div>
            
            <h3 class="text-xs font-black text-slate-800 dark:text-white mb-6 uppercase tracking-widest">Thumbnail & Lampiran</h3>
            
            <div class="space-y-6">
                <x-molecules.shared.forms.image-picker
                    label="Gambar Thumbnail"
                    name="thumbnail"
                    file-name="thumbnail_file"
                    :value="$announcement?->thumbnail ?? ''"
                    helper="Pilih link gambar atau upload dari device. Format: JPG, JPEG, PNG. Maks. 2MB. Kosongkan jika tidak ingin mengubah." />

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">File Lampiran</label>
                    <input type="file" name="file"
                        class="w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/5 dark:file:bg-primary/20 file:text-primary hover:file:bg-primary/10 transition cursor-pointer" />
                    @if ($announcement?->file)
                        <div class="flex items-center gap-2 p-3 bg-slate-50 dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 mt-2">
                            <x-heroicon-o-paper-clip class="size-4 text-slate-400 dark:text-slate-500" />
                            <span class="text-[10px] font-medium text-slate-500 dark:text-slate-400 truncate">{{ $announcement->file }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Publication Status Tip --}}
        <div class="bg-primary/5 dark:bg-primary/10 rounded-2xl p-6 border border-primary/10 dark:border-primary/20 transition-colors duration-300">
            <div class="flex gap-4">
                <div class="size-10 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center shrink-0">
                    <x-heroicon-s-light-bulb class="size-5" />
                </div>
                <div>
                    <h4 class="text-xs font-black text-primary uppercase tracking-widest mb-1">Tips</h4>
                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        Pengumuman yang dijadwalkan di masa depan tidak akan muncul di website sampai waktu tersebut tiba.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
