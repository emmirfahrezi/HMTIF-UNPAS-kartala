<x-layouts.app title="Login | HMTIF-UNPAS">
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
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Selamat Datang</h1>
                <p class="text-slate-500 mt-2 font-medium">Silakan masuk untuk mengelola portal Kartala</p>
            </div>

            {{-- Login Card --}}
            <div x-data="{
                    showPassword: false,
                    submitting: false
                }"
                class="bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl shadow-slate-200/50 p-8 border border-white/20">
                <form action="{{ route('login.store') }}" method="POST" class="space-y-6" @submit="submitting = true"
                    novalidate>
                    @csrf

                    {{-- Email Field --}}
                    <x-molecules.pages.forms.form-field id="email_address" label="Email Address" :required="true">
                        <input id="email_field" name="email" type="email" autocomplete="username" inputmode="email"
                            placeholder="nama@email.com" required value="{{ old('email') }}"
                            class="w-full px-4 py-3 bg-white border border-border rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all duration-300 placeholder:text-body/40 text-heading font-medium @error('email') border-red-500 ring-red-500/10 @enderror" />
                        @error('email')
                            <p class="text-xs font-bold text-red-500 mt-1">{{ $message }}</p>
                        @enderror
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
                        @error('password')
                            <p class="text-xs font-bold text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </x-molecules.pages.forms.form-field>

                    <div class="mt-2 border-t border-slate-100 text-end">
                        <p class="text-sm text-slate-400 pt-2">
                            <a href="#" class="text-primary font-semibold hover:underline">Lupa password?</a>
                        </p>
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

            {{-- Footer Info --}}
            <p class="text-center mt-8 text-sm text-slate-400 font-medium italic">
                &copy; {{ date('Y') }} HMTIF-UNPAS.
            </p>
        </div>
    </main>

</x-layouts.app>