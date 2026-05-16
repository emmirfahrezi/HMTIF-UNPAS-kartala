<div class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-data="slugHelper(@js(old('title', $activity?->title)), @js(old('slug', $activity?->slug)))">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        {{-- Primary Information --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
            <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-sparkles class="size-32" />
            </div>
            
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
                    <x-heroicon-s-information-circle class="size-5" />
                </span>
                Informasi Kegiatan
            </h3>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-molecules.shared.forms.form-input 
                        label="Judul Kegiatan" 
                        name="title" 
                        placeholder="Masukan nama kegiatan..."
                        :value="$activity?->title ?? ''" 
                        x-model="sourceValue"
                        required />

                    <x-molecules.shared.forms.form-input 
                        label="Slug (Auto)" 
                        name="slug" 
                        placeholder="dibuat otomatis"
                        :value="$activity?->slug ?? ''" 
                        x-model="slugValue"
                        readonly
                        required />
                </div>

                <x-molecules.shared.forms.form-input 
                    label="Deskripsi Singkat" 
                    name="description" 
                    type="richtext"
                    placeholder="Tuliskan deskripsi singkat kegiatan..."
                    :value="$activity?->description ?? ''" 
                    required />
            </div>
        </div>

        {{-- Schedule & Location --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-500 flex items-center justify-center">
                    <x-heroicon-s-calendar-days class="size-5" />
                </span>
                Jadwal & Lokasi
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-molecules.shared.forms.form-input 
                    label="Tanggal Mulai" 
                    name="start_date" 
                    type="datetime-local"
                    :value="$activity?->start_date?->format('Y-m-d\TH:i') ?? ''" 
                    required />

                <x-molecules.shared.forms.form-input 
                    label="Tanggal Selesai" 
                    name="end_date" 
                    type="datetime-local"
                    :value="$activity?->end_date?->format('Y-m-d\TH:i') ?? ''" />

                <x-molecules.shared.forms.form-input 
                    label="Lokasi / Tempat" 
                    name="location" 
                    placeholder="Contoh: Aula Unpas"
                    :value="$activity?->location ?? ''" />

                <x-molecules.shared.forms.form-input 
                    label="URL Registrasi" 
                    name="registration_url" 
                    placeholder="https://..."
                    :value="$activity?->registration_url ?? ''" />
            </div>
        </div>

        {{-- Content Body --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm transition-colors duration-300">
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-blue-500/10 dark:bg-blue-500/20 text-blue-500 flex items-center justify-center">
                    <x-heroicon-s-document-text class="size-5" />
                </span>
                Detail Konten
            </h3>

            <x-molecules.shared.forms.form-input 
                name="body" 
                type="richtext"
                placeholder="Tuliskan detail lengkap kegiatan di sini..."
                :value="$activity?->body ?? ''" />
        </div>

        </div>

    {{-- Sidebar Content --}}
    <div class="space-y-8">
        {{-- Status & Thumbnail --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
            <div class="absolute top-0 right-0 p-6 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-photo class="size-24" />
            </div>
            
            <h3 class="text-xs font-black text-slate-800 dark:text-white mb-6 uppercase tracking-widest">Media & Status</h3>
            
            <div class="space-y-6">
                <x-molecules.shared.forms.form-input 
                    label="Status Kegiatan" 
                    name="status" 
                    type="select"
                    :value="$activity?->status ?? 'upcoming'" 
                    :options="['upcoming' => 'Mendatang', 'ongoing' => 'Berlangsung', 'past' => 'Selesai']"
                    required />

                <x-molecules.shared.forms.form-input 
                    label="URL Gambar Thumbnail" 
                    name="thumbnail" 
                    placeholder="https://..."
                    :value="$activity?->thumbnail ?? ''" 
                    helper="Gunakan URL gambar dari internet" />

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">File Lampiran</label>
                    <input type="file" name="file"
                        class="w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/5 dark:file:bg-primary/20 file:text-primary hover:file:bg-primary/10 transition cursor-pointer" />
                    @if ($activity?->file)
                        <div class="flex items-center gap-2 p-3 bg-slate-50 dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 mt-2">
                            <x-heroicon-o-paper-clip class="size-4 text-slate-400 dark:text-slate-500" />
                            <span class="text-[10px] font-medium text-slate-500 dark:text-slate-400 truncate">{{ $activity->file }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Help Card --}}
        <div class="bg-emerald-50 dark:bg-emerald-500/10 rounded-2xl p-6 border border-emerald-100 dark:border-emerald-500/20">
            <div class="flex gap-4">
                <div class="size-10 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-500 flex items-center justify-center shrink-0">
                    <x-heroicon-s-clock class="size-5" />
                </div>
                <div>
                    <h4 class="text-xs font-black text-emerald-600 dark:text-emerald-500 uppercase tracking-widest mb-1">Status Kegiatan</h4>
                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        Ubah status ke **Berlangsung** jika kegiatan sedang berjalan agar muncul di halaman depan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
