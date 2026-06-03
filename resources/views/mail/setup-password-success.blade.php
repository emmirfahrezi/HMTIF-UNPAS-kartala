{{--
Halaman: Sukses Atur Password Baru
Variables yang dibutuhkan BE:
- $email : string (Email penerima untuk ditampilkan di panel info)
--}}

<x-layouts.app title="Password Berhasil Diatur | HMTIF-UNPAS">
    <main class="min-h-screen flex items-center justify-center bg-slate-50 relative overflow-hidden py-12 px-4">
        {{-- Decorative Elements --}}
        <div class="absolute -top-24 -right-24 size-96 bg-emerald-500/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 size-96 bg-primary/5 rounded-full blur-3xl"></div>

        <div class="w-full max-w-[440px] relative">
            {{-- Logo & Header --}}
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center size-16 bg-white rounded-2xl shadow-sm mb-4 border border-slate-100">
                    <img src="{{ config('app.logo_url') }}" alt="Logo HMTIF"
                        class="size-10 object-contain logo-remove-bg">
                </div>
            </div>

            {{-- Success Card --}}
            <div
                class="bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl shadow-slate-200/50 p-8 border border-white/20 text-center">

                {{-- Success Icon --}}
                <div
                    class="mx-auto size-20 rounded-full bg-emerald-50 border-2 border-emerald-100 flex items-center justify-center mb-6 animate-bounce-once">
                    <svg class="size-10 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>

                {{-- Message --}}
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight mb-2">Password Berhasil Diatur! 🎉</h1>
                <p class="text-slate-500 font-medium text-sm leading-relaxed mb-8">
                    Akun Anda sudah aktif dan siap digunakan. Silakan login menggunakan email dan password yang baru
                    saja Anda buat.
                </p>

                <div class="mb-8 rounded-xl border border-amber-200 bg-amber-50 p-4 text-left">
                    <p class="text-xs font-semibold leading-relaxed text-amber-800">
                        Jika bukan Anda yang mengatur password ini, segera hubungi admin HMTIF untuk pengamanan akun.
                    </p>
                </div>

                {{-- Account Info --}}
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 mb-8 text-left">
                    <div class="flex items-center gap-3">
                        <div
                            class="size-9 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
                            <x-heroicon-s-envelope class="size-4" />
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Email Akun</p>
                            <p class="text-sm font-bold text-slate-800">{{ $email ?? 'user@hmtif-unpas.ac.id' }}</p>
                        </div>
                    </div>
                </div>

                {{-- CTA --}}
                <a href="{{ route('login') }}"
                    class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-2xl font-semibold bg-primary text-white hover:bg-primary-hover shadow-lg shadow-primary/20 transition-all hover:scale-[1.02] active:scale-95">
                    <x-heroicon-o-arrow-right-on-rectangle class="size-5" />
                    Lanjut ke Halaman Login
                </a>
            </div>

            {{-- Footer --}}
            <p class="text-center mt-8 text-sm text-slate-400 font-medium italic">
                &copy; {{ date('Y') }} HMTIF-UNPAS.
            </p>
        </div>
    </main>

    <style>
        @keyframes bounce-once {

            0%,
            100% {
                transform: translateY(0);
            }

            30% {
                transform: translateY(-12px);
            }

            50% {
                transform: translateY(-4px);
            }

            70% {
                transform: translateY(-8px);
            }
        }

        .animate-bounce-once {
            animation: bounce-once 0.8s ease-out 0.3s both;
        }
    </style>
</x-layouts.app>
