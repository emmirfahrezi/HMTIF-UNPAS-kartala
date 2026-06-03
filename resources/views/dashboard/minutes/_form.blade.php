<div class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-data="minutesForm(@js($minute->attendees ?? []))">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        {{-- Meeting Information --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
            <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-information-circle class="size-32" />
            </div>
            
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
                    <x-heroicon-s-information-circle class="size-5" />
                </span>
                Informasi Rapat
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-molecules.shared.forms.form-input 
                    label="Nomor Surat / Notulensi" 
                    name="nomor" 
                    placeholder="Contoh: 001/HMTIF/IV/2024"
                    :value="$minute->nomor ?? ''" 
                    required />

                <x-molecules.shared.forms.form-input 
                    label="Perihal / Judul Rapat" 
                    name="perihal" 
                    placeholder="Contoh: Rapat Kerja Internal"
                    :value="$minute->perihal ?? ''" 
                    required />

                <x-molecules.shared.forms.form-input 
                    label="Tanggal Rapat" 
                    name="tanggal" 
                    type="date"
                    :value="isset($minute) ? $minute->tanggal->format('Y-m-d') : date('Y-m-d')" 
                    required />

                <div class="grid grid-cols-2 gap-4">
                    <x-molecules.shared.forms.form-input 
                        label="Waktu Mulai" 
                        name="waktu_mulai" 
                        type="time"
                        :value="$minute->waktu_mulai ?? '09:00'" 
                        required />
                    <x-molecules.shared.forms.form-input 
                        label="Selesai" 
                        name="waktu_selesai" 
                        type="time"
                        :value="$minute->waktu_selesai ?? ''" />
                </div>

                <x-molecules.shared.forms.form-input 
                    label="Tempat" 
                    name="tempat" 
                    placeholder="Contoh: Sekretariat HMTIF"
                    :value="$minute->tempat ?? ''" 
                    required />

                <x-molecules.shared.forms.form-input 
                    label="Dipimpin Oleh" 
                    name="dipimpin_oleh" 
                    placeholder="Nama pimpinan rapat"
                    :value="$minute->dipimpin_oleh ?? ''" 
                    required />
            </div>

            <div class="mt-6">
                <x-molecules.shared.forms.form-input 
                    label="Agenda Rapat" 
                    name="agenda" 
                    type="richtext"
                    placeholder="Sebutkan poin-poin agenda rapat..."
                    :value="$minute->agenda ?? ''" 
                    required />
            </div>
        </div>

        {{-- Meeting Content --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm transition-colors duration-300">
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-amber-500/10 dark:bg-amber-500/20 text-amber-500 flex items-center justify-center">
                    <x-heroicon-s-document-text class="size-5" />
                </span>
                Isi & Hasil Rapat
            </h3>

            <x-molecules.shared.forms.form-input 
                name="isi_rapat" 
                type="richtext"
                placeholder="Tuliskan detail pembahasan dan hasil keputusan rapat di sini..."
                :value="$minute->isi_rapat ?? ''" 
                required />
        </div>
    </div>

    {{-- Sidebar Content (Attendees) --}}
    <div class="space-y-8">
        {{-- Documentation --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm transition-colors duration-300">
            <h3 class="text-sm font-black text-slate-800 dark:text-white mb-4 uppercase tracking-widest">Dokumentasi</h3>
            <x-molecules.shared.forms.form-input 
                name="dokumentasi_file" 
                type="file"
                helper="Format: JPG, PNG, atau PDF. Maks 5MB." />
        </div>

        {{-- Attendees List --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col min-h-[400px] transition-colors duration-300">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-sm font-black text-slate-800 dark:text-white uppercase tracking-widest">Daftar Peserta</h3>
                <x-atoms.shared.button 
                    variant="soft" 
                    size="sm"
                    type="button" 
                    @click="addAttendee()"
                    class="!p-1.5 size-8 !rounded-lg"
                    title="Tambah Peserta">
                    <x-heroicon-o-plus-circle class="size-5" />
                </x-atoms.shared.button>
            </div>

            <div class="space-y-5 flex-1 overflow-y-auto max-h-[600px] pr-2 pt-1 custom-scrollbar">
                <template x-for="(attendee, index) in attendees" :key="index">
                    <div class="p-5 bg-slate-50 dark:bg-slate-900/80 border border-slate-200/70 dark:border-slate-700/70 rounded-2xl relative group/item animate-in fade-in slide-in-from-right-4 duration-300 shadow-sm">
                        <button type="button" @click="removeAttendee(index)"
                            class="absolute top-4 right-4 size-8 bg-white dark:bg-slate-950 text-red-500 border border-red-100 dark:border-red-900/50 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white shadow-sm transition opacity-100 lg:opacity-0 lg:group-hover/item:opacity-100 focus:opacity-100 focus:outline-none focus:ring-4 focus:ring-red-500/10"
                            title="Hapus Peserta">
                            <x-heroicon-o-x-mark class="size-4" />
                        </button>

                        <div class="mb-4 pr-10">
                            <p class="text-xs font-black text-primary uppercase tracking-widest">
                                Peserta <span x-text="index + 1"></span>
                            </p>
                        </div>

                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Nama Peserta</label>
                                <input type="text" :name="'attendees['+index+'][name]'" x-model="attendee.name" 
                                    placeholder="Contoh: John Doe"
                                    class="w-full px-4 py-3 bg-white dark:bg-slate-950/70 border border-slate-200 dark:border-slate-700/80 rounded-xl text-sm font-semibold text-slate-700 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all duration-300 shadow-sm" required />
                            </div>
                            
                            <div class="grid grid-cols-1 2xl:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">NIM</label>
                                    <input type="text" :name="'attendees['+index+'][nim]'" x-model="attendee.nim" 
                                        placeholder="NIM"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-950/70 border border-slate-200 dark:border-slate-700/80 rounded-xl text-sm font-semibold text-slate-700 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all duration-300 shadow-sm" />
                                </div>
                                
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Keterangan</label>
                                    <x-molecules.shared.forms.form-input
                                        type="select"
                                        name="attendees[][keterangan]"
                                        name-expression="'attendees[' + index + '][keterangan]'"
                                        selected-expression="attendee.keterangan || 'hadir'"
                                        model-expression="attendee.keterangan"
                                        :options="[
                                            'hadir' => 'Hadir',
                                            'izin' => 'Izin',
                                            'alpha' => 'Alpha',
                                        ]"
                                        required />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Jabatan (Opsional)</label>
                                <input type="text" :name="'attendees['+index+'][jabatan]'" x-model="attendee.jabatan" 
                                    placeholder="Jabatan"
                                    class="w-full px-4 py-3 bg-white dark:bg-slate-950/70 border border-slate-200 dark:border-slate-700/80 rounded-xl text-sm font-semibold text-slate-700 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all duration-300 shadow-sm" />
                            </div>
                        </div>
                    </div>
                </template>

                <template x-if="attendees.length === 0">
                    <div class="flex flex-col items-center justify-center py-12 text-center text-slate-400 dark:text-slate-600">
                        <x-heroicon-o-users class="size-10 mb-2 opacity-20" />
                        <p class="text-xs font-medium">Belum ada peserta.</p>
                        <button type="button" @click="addAttendee()" class="text-[10px] font-bold text-primary mt-1 hover:underline uppercase tracking-widest">Klik Tambah</button>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function minutesForm(initialAttendees = []) {
        return {
            attendees: initialAttendees.length > 0 ? initialAttendees : [],
            addAttendee() {
                this.attendees.push({
                    name: '',
                    nim: '',
                    jabatan: '',
                    keterangan: 'hadir'
                });
            },
            removeAttendee(index) {
                this.attendees.splice(index, 1);
            }
        };
    }
</script>
@endpush
