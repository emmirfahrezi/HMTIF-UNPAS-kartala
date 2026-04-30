@props([
    'title' => '',
    'code' => '',
])

<!DOCTYPE html>
<html lang="id">
<head>
    <x-shared.head-meta :title="$title" :is-seo="false" />
    
    {{-- Main Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 antialiased overflow-hidden">
    <div class="min-h-screen flex items-center justify-center p-6 relative">
        {{-- Artistic Background --}}
        <div class="absolute inset-0 flex items-center justify-center opacity-40 pointer-events-none select-none">
            <span class="text-[20rem] md:text-[30rem] error-code uppercase">
                {{ $code }}
            </span>
        </div>

        <div class="max-w-md w-full text-center relative z-10">
            <div class="mb-6 flex justify-center">
                <img src="{{ config('app.logo_url') }}" alt="Logo HMTIF" class="h-12 w-auto object-contain logo-remove-bg brightness-110">
            </div>
            <div class="mb-8 inline-flex items-center justify-center size-20 bg-white rounded-3xl shadow-xl shadow-slate-200 border border-slate-100 text-primary">
                {{ $icon }}
            </div>
            
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">
                {{ $title }}
            </h1>
            
            <p class="text-slate-500 text-lg mb-10 leading-relaxed font-medium">
                {{ $slot }}
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ url()->previous() == url()->current() ? '/' : url()->previous() }}" 
                   class="w-full sm:w-auto px-8 py-3.5 bg-white text-slate-700 rounded-2xl text-sm font-bold border border-slate-200 hover:bg-slate-50 transition-all shadow-sm active:scale-95">
                    Kembali
                </a>
                <a href="/" 
                   class="w-full sm:w-auto px-8 py-3.5 bg-primary text-white rounded-2xl text-sm font-bold hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 active:scale-95">
                    Halaman Utama
                </a>
            </div>
        </div>
    </div>
</body>
</html>

