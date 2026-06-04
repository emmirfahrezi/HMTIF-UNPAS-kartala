<x-layouts.app title="Lupa Password | HMTIF-UNPAS" :transparent="false">
    <main class="min-h-screen bg-slate-50 px-4 py-12">
        <div class="mx-auto flex min-h-[calc(100vh-6rem)] w-full max-w-md items-center">
            <div class="w-full rounded-[2rem] border border-white/70 bg-white p-8 shadow-2xl shadow-slate-200/60">
                <div class="mb-8 text-center">
                    <div class="mx-auto mb-4 flex size-16 items-center justify-center rounded-2xl border border-slate-100 bg-white shadow-sm">
                        <img src="{{ config('app.logo_url') }}" alt="Logo HMTIF" class="size-10 object-contain logo-remove-bg">
                    </div>
                    <h1 class="text-2xl font-black text-slate-950">Reset Password</h1>
                    <p class="mt-2 text-sm font-medium leading-6 text-slate-500">
                        Masukkan email akun dashboard untuk menerima link reset password.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-6 rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-4 text-sm font-semibold leading-relaxed text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <x-molecules.pages.forms.form-field id="email" label="Email Akun" :required="true">
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="username"
                            inputmode="email"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            required
                            class="w-full rounded-xl border border-border bg-white px-4 py-3 font-medium text-heading outline-none transition-all duration-300 placeholder:text-body/40 focus:border-primary focus:ring-2 focus:ring-primary/20 @error('email') border-red-500 ring-red-500/10 @enderror">
                    </x-molecules.pages.forms.form-field>

                    @error('email')
                        <p class="-mt-4 text-sm font-semibold text-red-500">{{ $message }}</p>
                    @enderror

                    <x-molecules.shared.security.password-policy compact />

                    <button type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-primary px-5 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition hover:bg-primary-hover">
                        Kirim Link Reset
                    </button>

                    <a href="{{ route('login') }}"
                        class="inline-flex w-full items-center justify-center rounded-2xl px-5 py-3 text-sm font-bold text-slate-500 transition hover:bg-slate-50 hover:text-primary">
                        Kembali ke Login
                    </a>
                </form>
            </div>
        </div>
    </main>
</x-layouts.app>
