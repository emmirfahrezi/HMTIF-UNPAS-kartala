<x-layouts.app title="Login | HMTIF-UNPAS">
    @php
        $passwordEmailRouteAvailable = \Illuminate\Support\Facades\Route::has('password.email');
        $adminContactEmail = config('mail.from.address', 'admin@hmtif-unpas.ac.id');
    @endphp

    <main class="min-h-screen flex items-center justify-center bg-slate-50 relative overflow-hidden py-12 px-4">
        {{-- Decorative Elements --}}
        <div class="absolute -top-24 -right-24 size-96 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 size-96 bg-blue-500/5 rounded-full blur-3xl"></div>

        <div
            x-data="{
                showPassword: false,
                submitting: false,
                forgotPasswordOpen: false,
                resetSubmitting: false,
                adminContactCopied: false
            }"
            class="w-full max-w-[440px] relative"
        >
            {{-- Logo & Header --}}
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center size-16 bg-white rounded-2xl shadow-sm mb-4 border border-slate-100">
                    <img src="{{ config('app.logo_url') }}" alt="Logo HMTIF"
                        class="size-10 object-contain logo-remove-bg">
                </div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Login Dashboard</h1>
                <p class="text-slate-500 mt-2 font-medium">Masuk memakai email dan password akun HMTIF</p>
            </div>

            {{-- Login Card --}}
            <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl shadow-slate-200/50 p-8 border border-white/20">
                <form action="{{ route('login.store') }}" method="POST" class="space-y-6" @submit="submitting = true"
                    novalidate>
                    @csrf

                    @if (session('status'))
                        <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-4 text-sm font-semibold leading-relaxed text-emerald-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->has('email') || $errors->has('password'))
                        <div class="rounded-2xl border border-red-500/20 bg-red-500/5 p-4 text-sm font-semibold leading-relaxed text-red-600">
                            {{ $errors->first('email') ?: $errors->first('password') ?: 'Email atau password salah.' }}
                        </div>
                    @endif

                    {{-- Email Field --}}
                    <x-molecules.pages.forms.form-field id="email_address" label="Email" :required="true">
                        <input id="email_field" name="email" type="email" autocomplete="username" inputmode="email"
                            placeholder="nama@email.com" required value="{{ old('email') }}"
                            class="w-full px-4 py-3 bg-white border border-border rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all duration-300 placeholder:text-body/40 text-heading font-medium @error('email') border-red-500 ring-red-500/10 @enderror" />
                    </x-molecules.pages.forms.form-field>

                    {{-- Password Field --}}
                    <x-molecules.pages.forms.form-field id="password_label" label="Password" :required="true">
                        <div class="relative group">
                            <input id="password_field" name="password" :type="showPassword ? 'text' : 'password'"
                                placeholder="••••••••" required
                                class="w-full px-4 py-3 bg-white border border-border rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all duration-300 placeholder:text-body/40 text-heading font-medium @error('password') border-red-500 ring-red-500/10 @enderror" />
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                                <span x-show="!showPassword"><x-heroicon-o-eye class="size-5" /></span>
                                <span x-show="showPassword" style="display: none;"><x-heroicon-o-eye-slash
                                        class="size-5" /></span>
                            </button>
                        </div>
                    </x-molecules.pages.forms.form-field>

                    <div class="mt-2 border-t border-slate-100 text-end pt-2">
                        <button type="button" @click="forgotPasswordOpen = true"
                            class="text-sm font-semibold text-primary hover:underline">
                            Lupa password?
                        </button>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full px-6 py-4 rounded-2xl font-semibold bg-primary text-white hover:bg-primary-hover shadow-lg shadow-primary/20 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2"
                            :disabled="submitting">
                            <span x-show="!submitting">Masuk ke Dashboard</span>
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

            {{-- Forgot Password Modal --}}
            <div x-show="forgotPasswordOpen" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/45 p-4 backdrop-blur-sm"
                x-transition.opacity
                @keydown.escape.window="forgotPasswordOpen = false">
                <div @click.away="forgotPasswordOpen = false"
                    class="w-full max-w-md rounded-[2rem] border border-white/20 bg-white p-8 shadow-2xl shadow-slate-950/20"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                    <div class="mb-6 flex items-start justify-between gap-4">
                        <div class="flex gap-3">
                            <div class="flex size-11 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                                <x-heroicon-o-envelope class="size-5" />
                            </div>
                            <div>
                                <h2 class="text-lg font-black text-slate-900">Reset Password</h2>
                                <p class="mt-1 text-sm font-medium leading-relaxed text-slate-500">
                                    Verifikasi email akun untuk menerima link reset password.
                                </p>
                            </div>
                        </div>
                        <button type="button" @click="forgotPasswordOpen = false"
                            class="text-slate-400 transition hover:text-slate-600">
                            <x-heroicon-o-x-mark class="size-6" />
                        </button>
                    </div>

                    @if ($passwordEmailRouteAvailable)
                        <form action="{{ route('password.email') }}" method="POST" class="space-y-4"
                            @submit="resetSubmitting = true">
                            @csrf
                            <x-molecules.pages.forms.form-field id="reset_email_address" label="Email Akun" :required="true">
                                <input id="reset_email_address" name="email" type="email" autocomplete="username"
                                    inputmode="email" placeholder="nama@email.com" required value="{{ old('email') }}"
                                    class="w-full px-4 py-3 bg-white border border-border rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all duration-300 placeholder:text-body/40 text-heading font-medium" />
                            </x-molecules.pages.forms.form-field>

                            <p class="text-xs font-medium leading-relaxed text-slate-500">
                                Jika email terdaftar, link reset password akan dikirim. Sistem tidak akan menampilkan apakah email terdaftar atau tidak.
                            </p>

                            <x-molecules.shared.security.password-policy compact />

                            <button type="submit"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-primary px-5 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition hover:bg-primary-hover disabled:opacity-60"
                                :disabled="resetSubmitting">
                                <span x-show="!resetSubmitting">Kirim Link Reset</span>
                                <span x-show="resetSubmitting" style="display: none;">Mengirim...</span>
                            </button>
                        </form>
                    @else
                        <div class="space-y-4">
                            <div class="rounded-2xl border border-amber-500/20 bg-amber-500/5 p-4 text-sm font-medium leading-relaxed text-amber-800">
                                Reset password via email perlu endpoint backend terlebih dahulu. Sampai fitur ini aktif, gunakan opsi hubungi admin.
                            </div>

                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <p class="text-xs font-black uppercase tracking-widest text-slate-400">Opsi Kedua</p>
                                <p class="mt-2 text-sm font-medium leading-relaxed text-slate-600">
                                    Hubungi admin HMTIF melalui email berikut untuk verifikasi akun dan pengiriman link pengaturan password baru.
                                </p>
                                <div class="mt-4 rounded-xl border border-slate-200 bg-white p-3">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Email Admin</p>
                                    <p class="mt-1 break-all text-sm font-bold text-slate-800">{{ $adminContactEmail }}</p>
                                </div>
                            </div>

                            <x-molecules.shared.security.password-policy compact />

                            <button type="button"
                                @click="
                                    navigator.clipboard?.writeText(@js($adminContactEmail));
                                    adminContactCopied = true;
                                    setTimeout(() => adminContactCopied = false, 1800);
                                "
                                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-primary px-5 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition hover:bg-primary-hover">
                                <x-heroicon-o-clipboard-document class="size-4" />
                                <span x-show="!adminContactCopied">Copy Email Admin</span>
                                <span x-show="adminContactCopied" style="display: none;">Email Dicopy</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Footer Info --}}
            <p class="text-center mt-8 text-sm text-slate-400 font-medium italic">
                &copy; {{ date('Y') }} HMTIF-UNPAS.
            </p>
        </div>
    </main>

</x-layouts.app>
