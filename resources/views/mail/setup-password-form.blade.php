<x-layouts.app title="Setup Password | HMTIF-UNPAS">
    <main class="min-h-screen flex items-center justify-center bg-slate-50 relative overflow-hidden py-12 px-4">
        {{-- Decorative Elements --}}
        <div class="absolute -top-24 -right-24 size-96 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 size-96 bg-blue-500/5 rounded-full blur-3xl"></div>

        <div class="w-full max-w-[440px] relative">
            {{-- Logo & Header --}}
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center size-16 bg-white rounded-2xl shadow-sm mb-4 border border-slate-100">
                    <img src="{{ config('app.logo_url') }}" alt="Logo HMTIF"
                        class="size-10 object-contain logo-remove-bg">
                </div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Atur Password</h1>
                <p class="text-slate-500 mt-2 font-medium">Buat password kuat untuk mengaktifkan akun dashboard</p>
            </div>

            {{-- Setup Password Card --}}
            <div x-data="{
                    showPassword: false,
                    showConfirmPassword: false,
                    submitting: false
                }"
                class="bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl shadow-slate-200/50 p-8 border border-white/20">
                <form action="{{ route('setup-password.store') }}" method="POST" class="space-y-6"
                    @submit="submitting = true" novalidate>
                    @csrf
                    {{-- Hidden Token Field (Backend akan mengirimkan token ini) --}}
                    <input type="hidden" name="token" value="{{ $token ?? '' }}">
                    <input type="hidden" name="email" value="{{ request()->query('email', '') }}">

                    {{-- General Error Alert (token invalid, email missing, dll.) --}}
                    @if($errors->has('token') || $errors->has('email'))
                        <div class="p-4 rounded-xl border border-red-200 bg-red-50 text-sm flex gap-3 items-start">
                            <svg class="size-5 text-red-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                            <div>
                                <p class="text-red-800 font-semibold">
                                    Tautan pengaturan password tidak valid atau sudah tidak berlaku.
                                </p>
                                <p class="mt-1 text-xs font-medium leading-relaxed text-red-700/80">
                                    Minta link baru melalui admin HMTIF atau alur reset password via email.
                                </p>
                            </div>
                        </div>
                    @endif

                    {{-- Info Box --}}
                    <div class="p-4 rounded-xl border border-blue-100 bg-blue-50/50 text-sm flex gap-3 items-start">
                        <x-heroicon-o-information-circle class="size-5 text-blue-500 shrink-0" />
                        <p class="text-blue-900/80 leading-relaxed text-xs">
                            Link ini hanya berlaku sementara dan hanya boleh digunakan oleh pemilik email akun.
                        </p>
                    </div>

                    <x-molecules.shared.security.password-policy />

                    {{-- Password Baru Field --}}
                    <x-molecules.pages.forms.form-field id="password_label" label="Password Baru" :required="true">
                        <div class="relative group">
                            <input id="password_field" name="password" :type="showPassword ? 'text' : 'password'"
                                placeholder="Password baru" required minlength="12" autocomplete="new-password"
                                class="w-full px-4 py-3 bg-white border border-border rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all duration-300 placeholder:text-body/40 text-heading font-medium @error('password') border-red-500 ring-red-500/10 @enderror" />
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                                <span x-show="!showPassword"><x-heroicon-o-eye class="size-5" /></span>
                                <span x-show="showPassword" style="display: none;"><x-heroicon-o-eye-slash
                                        class="size-5" /></span>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-xs font-bold text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </x-molecules.pages.forms.form-field>

                    {{-- Konfirmasi Password Field --}}
                    <x-molecules.pages.forms.form-field id="password_confirmation_label" label="Konfirmasi Password"
                        :required="true">
                        <div class="relative group">
                            <input id="password_confirmation_field" name="password_confirmation"
                                :type="showConfirmPassword ? 'text' : 'password'" placeholder="Ulangi password baru"
                                required minlength="12" autocomplete="new-password"
                                class="w-full px-4 py-3 bg-white border border-border rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all duration-300 placeholder:text-body/40 text-heading font-medium @error('password_confirmation') border-red-500 ring-red-500/10 @enderror" />
                            <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                                <span x-show="!showConfirmPassword"><x-heroicon-o-eye class="size-5" /></span>
                                <span x-show="showConfirmPassword" style="display: none;"><x-heroicon-o-eye-slash
                                        class="size-5" /></span>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="text-xs font-bold text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </x-molecules.pages.forms.form-field>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full px-6 py-4 rounded-2xl font-semibold bg-primary text-white hover:bg-primary-hover shadow-lg shadow-primary/20 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2"
                            :disabled="submitting">
                            <span x-show="!submitting">Simpan Password</span>
                            <span x-show="submitting" class="flex items-center gap-2" style="display: none;">
                                <svg class="animate-spin size-4" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4" fill="none"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Footer Info --}}
            <p class="text-center mt-8 text-sm text-slate-400 font-medium italic">
                &copy; {{ date('Y') }} HMTIF-UNPAS.
            </p>
        </div>
    </main>
</x-layouts.app>
