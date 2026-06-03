@php
    $archiveTypes = $archiveTypes ?? [
        'general_letter' => 'Surat Umum',
        'lpj' => 'LPJ',
        'proposal' => 'Proposal',
        'nota' => 'Nota',
    ];
    $divisionOptions = ['' => 'Pilih Bidang'] + collect($divisions ?? [])
        ->mapWithKeys(fn ($division) => [data_get($division, 'id') => data_get($division, 'name')])
        ->filter(fn ($name, $id) => filled($id) && filled($name))
        ->all();
    $isEdit = filled(data_get($archive ?? null, 'id'));
    $fileName = data_get($archive ?? null, 'file_name') ?: basename((string) data_get($archive ?? null, 'file_url', ''));
@endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
            <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-archive-box class="size-32" />
            </div>

            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
                    <x-heroicon-s-information-circle class="size-5" />
                </span>
                Informasi Arsip
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <x-molecules.shared.forms.form-input
                        label="Nama Surat"
                        name="name"
                        placeholder="Contoh: Proposal Kegiatan Kartala"
                        :value="data_get($archive ?? null, 'name', '')"
                        required />
                </div>

                <x-molecules.shared.forms.form-input
                    label="Jenis Dokumen"
                    name="type"
                    type="select"
                    :value="data_get($archive ?? null, 'type', 'general_letter')"
                    :options="$archiveTypes"
                    required />

                <x-molecules.shared.forms.form-input
                    label="Bidang / Divisi"
                    name="division_id"
                    type="select"
                    :value="data_get($archive ?? null, 'division_id', '')"
                    :options="$divisionOptions"
                    required />
            </div>
        </div>
    </div>

    <aside class="space-y-8">
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
            <div class="absolute top-0 right-0 p-6 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-document-arrow-up class="size-24" />
            </div>

            <h3 class="text-xs font-black text-slate-800 dark:text-white mb-6 uppercase tracking-widest">File PDF</h3>

            <x-molecules.shared.forms.form-input
                label="Upload PDF"
                name="file"
                type="file"
                accept="application/pdf"
                helper="{{ $isEdit ? 'Kosongkan jika tidak ingin mengganti file. Format PDF.' : 'Wajib upload file PDF.' }}"
                :required="! $isEdit" />

            @if($isEdit && $fileName)
                <div class="mt-4 flex items-center gap-3 rounded-2xl border border-slate-100 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950">
                    <div class="size-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                        <x-heroicon-o-document-text class="size-5" />
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">File Saat Ini</p>
                        <p class="truncate text-xs font-bold text-slate-600 dark:text-slate-300">{{ $fileName }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="bg-primary/5 dark:bg-primary/10 rounded-2xl p-6 border border-primary/10 dark:border-primary/20 transition-colors duration-300">
            <div class="flex gap-4">
                <div class="size-10 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center shrink-0">
                    <x-heroicon-s-light-bulb class="size-5" />
                </div>
                <div>
                    <h4 class="text-xs font-black text-primary uppercase tracking-widest mb-1">Catatan</h4>
                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        Pengarsipan hanya menyimpan dokumen PDF. Link share dan QR Code disediakan setelah data arsip tersimpan.
                    </p>
                </div>
            </div>
        </div>
    </aside>
</div>
