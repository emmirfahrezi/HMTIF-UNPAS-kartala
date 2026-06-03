<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        {{-- Primary Information --}}
        <div
            class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
            <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-user-group class="size-32" />
            </div>

            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span
                    class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
                    <x-heroicon-s-identification class="size-5" />
                </span>
                Informasi Pengurus
            </h3>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-molecules.shared.forms.form-input label="Nama Lengkap" name="name"
                        placeholder="Nama lengkap pengurus..." :value="$staff?->name ?? ''" required />

                    <x-molecules.shared.forms.form-input label="Jabatan" name="position"
                        placeholder="Contoh: Ketua Umum" :value="$staff?->position ?? ''" required />
                </div>

                <x-molecules.shared.forms.form-input label="Divisi" name="division_id" type="select" :value="$staff?->division_id ?? ''"
                    :options="$divisions ?? []" required />

            </div>
        </div>

        {{-- Biography & Social Media --}}
        <div
            class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span
                    class="size-8 rounded-xl bg-blue-500/10 dark:bg-blue-500/20 text-blue-500 flex items-center justify-center">
                    <x-heroicon-s-hashtag class="size-5" />
                </span>
                Profil & Sosial Media
            </h3>

            <div class="space-y-6">
                <x-molecules.shared.forms.form-input label="Bio Singkat" name="bio" type="textarea"
                    placeholder="Tuliskan biodata singkat..." :value="$staff?->bio ?? ''" :rows="3" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-molecules.shared.forms.form-input label="Instagram" name="instagram" placeholder="@username"
                        :value="$staff?->instagram ?? ''" />

                    <x-molecules.shared.forms.form-input label="LinkedIn" name="linkedin"
                        placeholder="URL profil LinkedIn..." :value="$staff?->linkedin ?? ''" />
                </div>
            </div>
        </div>
    </div>

    {{-- Sidebar Content --}}
    <div class="space-y-8">
        {{-- Photo & Status --}}
        <div
            class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
            <div class="absolute top-0 right-0 p-6 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-camera class="size-24" />
            </div>

            <h3 class="text-xs font-black text-slate-800 dark:text-white mb-6 uppercase tracking-widest">Foto & Status
            </h3>

            <div class="space-y-6">
                <x-molecules.shared.forms.image-picker
                    label="Foto Profil"
                    name="photo"
                    file-name="photo_file"
                    :value="$staff?->photo ?? ''"
                    helper="Pilih link gambar atau upload dari device. Format: JPG, JPEG, PNG. Maks. 2MB. Kosongkan jika tidak ingin mengubah." />

                <div class="space-y-4 pt-4 border-t border-slate-50 dark:border-slate-800">
                    <x-molecules.shared.forms.form-input type="toggle" label="Status Aktif" name="is_active"
                        :value="$staff?->is_active ?? true" />

                    <x-molecules.shared.forms.form-input type="toggle" label="BPH (Inti)" name="is_bph"
                        :value="$staff?->is_bph ?? false" />


                </div>
            </div>
        </div>

        {{-- Info Card --}}
        <div
            class="bg-primary/5 dark:bg-primary/10 rounded-2xl p-6 border border-primary/10 dark:border-primary/20 transition-colors duration-300">
            <div class="flex gap-4">
                <div
                    class="size-10 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center shrink-0">
                    <x-heroicon-s-light-bulb class="size-5" />
                </div>
                <div>
                    <h4 class="text-xs font-black text-primary uppercase tracking-widest mb-1">Tips</h4>
                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        Pengurus yang ditandai sebagai **BPH** akan muncul di posisi teratas pada halaman struktur
                        organisasi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
