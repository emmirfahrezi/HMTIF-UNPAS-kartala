{{-- Form Section --}}
<div class="pb-20 md:pb-24 bg-section/30">
    <div class="mx-auto px-6 lg:px-8 max-w-5xl mt-6 md:mt-8 relative z-20">
        {{-- Form Card --}}
        <div
            class="bg-white rounded-2xl shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative">
            {{-- Decorative Background Elements --}}
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-primary/5 -mr-32 -mt-32 rounded-full blur-3xl pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 left-0 w-64 h-64 bg-primary/5 -ml-32 -mb-32 rounded-full blur-3xl pointer-events-none">
            </div>

            {{-- Form Header Accent --}}
            <div class="h-2 w-full bg-primary"></div>

            <div class="p-6 sm:p-10 lg:p-16 relative z-10" x-data="{ 
                pesan: '', 
                maxPesan: 1000,
                submitting: false,
                lastSubmit: 0,
                async submitForm(e) {
                    const now = Date.now();
                    if (now - this.lastSubmit < 5000) { // Throttle 5 detik
                        alert('Tunggu sebentar sebelum mengirim lagi.');
                        e.preventDefault();
                        return;
                    }
                    this.submitting = true;
                    this.lastSubmit = now;
                }
            }">
                <div
                    class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 border-b border-slate-50 pb-8">
                    <div>
                        <h2 class="text-3xl font-black text-slate-900 uppercase italic tracking-tighter mb-2">
                            Form <span class="text-primary">Aspirasi</span>
                        </h2>
                        <p class="text-slate-400 text-sm italic font-medium uppercase tracking-widest text-[10px]">
                            Lengkapi data di bawah untuk menyampaikan suaramu
                        </p>
                    </div>
                    <div class="flex items-center gap-3 px-4 py-2 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="w-2.5 h-2.5 rounded-full bg-primary animate-pulse"></div>
                        <span
                            class="text-[10px] font-bold text-slate-600 uppercase tracking-widest leading-none">Status:
                            Open</span>
                    </div>
                </div>

                @if (session('aspiration_success'))
                    <div x-data="{ show: true }" x-show="show"
                        class="mb-10 p-6 rounded-2xl border border-emerald-100 bg-emerald-50/50 flex items-start gap-4">
                        <div class="p-2 bg-emerald-100 text-emerald-600 rounded-xl">
                            <x-heroicon-o-check-circle class="size-6" />
                        </div>
                        <div class="flex-1">
                            <h4 class="text-emerald-900 font-bold mb-1 text-base">Aspirasi Terkirim!</h4>
                            <p class="text-emerald-700 font-medium leading-relaxed">
                                Aspirasi kamu sudah masuk ke antrian tindak lanjut.
                                @if (session('tracking_code'))
                                    Simpan kode tracking ini: <span
                                        class="bg-emerald-200/50 px-2 py-0.5 rounded font-black">{{ session('tracking_code') }}</span>
                                @endif
                            </p>
                        </div>
                        <button @click="show = false" class="text-emerald-400 hover:text-emerald-600">
                            <x-heroicon-o-x-mark class="size-5" />
                        </button>
                    </div>
                @endif

                <form action="{{ route('aspirations.store') }}" method="POST" class="aspiration-form space-y-12"
                    @submit="submitForm($event)" novalidate>
                    @csrf

                    {{-- Honeypot Security Field (Hidden from users) --}}
                    <div class="hidden" aria-hidden="true">
                        <input type="text" name="b_name_fake" tabindex="-1" value="" autocomplete="off">
                    </div>

                    {{-- Section 1: Identitas --}}
                    <div class="space-y-8">
                        <div class="flex items-center gap-3">
                            <span
                                class="flex items-center justify-center w-8 h-8 rounded-xl bg-primary text-white text-xs font-black italic shadow-lg shadow-primary/20">01</span>
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em]">Data Identitas</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Nama --}}
                            <div class="space-y-3">
                                <label for="nama"
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest block pl-1">Nama
                                    Lengkap</label>
                                <x-atoms.shared.input id="nama" name="nama" value="{{ old('nama') }}"
                                    placeholder="Masukkan nama lengkap kamu" autocomplete="name" maxlength="100"
                                    class="{{ $errors->has('nama') ? 'border-red-500 ring-red-500/10' : '' }}" />
                                <p class="text-[11px] text-slate-400 font-medium italic pl-1">Opsional, isi jika ingin
                                    dikenali.</p>
                                @error('nama') <p class="text-xs font-bold text-red-500 mt-1 pl-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- NIM --}}
                            <div class="space-y-3">
                                <label for="nim"
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest block pl-1">NIM
                                    Mahasiswa</label>
                                <x-atoms.shared.input id="nim" name="nim" value="{{ old('nim') }}"
                                    placeholder="Contoh: 213040001" inputmode="numeric" maxlength="15"
                                    class="{{ $errors->has('nim') ? 'border-red-500 ring-red-500/10' : '' }}" />
                                <p class="text-[11px] text-slate-400 font-medium italic pl-1">Opsional, isi untuk
                                    pelacakan status.</p>
                                @error('nim') <p class="text-xs font-bold text-red-500 mt-1 pl-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="space-y-3">
                            <label for="email"
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest block pl-1">Email
                                Mahasiswa</label>
                            <x-atoms.shared.input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="email@gmail.com"
                                class="{{ $errors->has('email') ? 'border-red-500 ring-red-500/10' : '' }}" />
                            <p class="text-[11px] text-slate-400 font-medium italic pl-1">Opsional, isi jika ingin
                                mendapatkan pemberitahuan kelanjutan mengenai status Aspirasi anda,</p>
                            @error('email') <p class="text-xs font-bold text-red-500 mt-1 pl-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Section 2: Aspirasi --}}
                    <div class="space-y-8">
                        <div class="flex items-center gap-3">
                            <span
                                class="flex items-center justify-center w-8 h-8 rounded-xl bg-primary text-white text-xs font-black italic shadow-lg shadow-primary/20">02</span>
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em]">Isi Aspirasi</h3>
                        </div>

                        {{-- Perihal --}}
                        <div class="space-y-3">
                            <label for="tujuan"
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest block pl-1">Perihal
                                <span class="text-red-500 font-black">*</span></label>
                            <x-atoms.shared.input id="tujuan" name="tujuan" value="{{ old('tujuan') }}"
                                placeholder="Contoh: Fasilitas Lab, Layanan Akademik, dsb." required maxlength="200"
                                class="{{ $errors->has('tujuan') ? 'border-red-500 ring-red-500/10' : '' }}" />
                            @error('tujuan') <p class="text-xs font-bold text-red-500 mt-1 pl-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Pesan --}}
                        <div class="space-y-3">
                            <div class="flex items-center justify-between pl-1">
                                <label for="pesan"
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Pesan
                                    Lengkap <span class="text-red-500 font-black">*</span></label>
                                <span class="text-[10px] font-bold"
                                    :class="pesan.length > maxPesan * 0.9 ? 'text-red-500' : 'text-slate-400'">
                                    <span x-text="pesan.length"></span> / <span x-text="maxPesan"></span>
                                </span>
                            </div>
                            <textarea id="pesan" name="pesan" rows="6" x-model="pesan" :maxlength="maxPesan"
                                class="w-full px-5 py-4 bg-white border rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all duration-300 placeholder:text-slate-300 text-slate-700 font-medium leading-relaxed {{ $errors->has('pesan') ? 'border-red-500 ring-2 ring-red-500/20' : 'border-slate-200' }}"
                                placeholder="Tuliskan aspirasi, keluhan, atau saran kamu secara detail di sini..."
                                required>{{ old('pesan') }}</textarea>
                            @error('pesan') <p class="text-xs font-bold text-red-500 mt-1 pl-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit Section --}}
                    <div
                        class="pt-10 flex flex-col sm:flex-row items-center justify-between gap-8 border-t border-slate-50 mt-16">
                        <div class="flex items-start gap-4">
                            <div
                                class="size-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 shrink-0">
                                <x-heroicon-o-shield-check class="size-6" />
                            </div>
                            <p
                                class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-relaxed max-w-xs">
                                <span class="text-emerald-600">Privasi Aman.</span><br>
                                Identitas kamu akan dijaga kerahasiaannya oleh tim advokasi.
                            </p>
                        </div>

                        <div class="w-full sm:w-auto">
                            <x-atoms.shared.button 
                                type="submit"
                                variant="primary"
                                size="lg"
                                class="w-full sm:w-auto"
                                x-bind:disabled="submitting">
                                <template x-if="!submitting">
                                    <span class="flex items-center gap-3">
                                        Kirim Aspirasi
                                        <x-heroicon-o-paper-airplane class="size-5" />
                                    </span>
                                </template>
                                <template x-if="submitting">
                                    <span class="flex items-center gap-2">
                                        <svg class="animate-spin size-5" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4" fill="none"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Mengirim...
                                    </span>
                                </template>
                            </x-atoms.shared.button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
