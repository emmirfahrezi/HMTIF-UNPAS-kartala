@props([
    'title' => 'Dashboard — HMTIF UNPAS',
    'pageTitle' => 'Dashboard',
    'breadcrumbs' => [],
])
<!DOCTYPE html>
<html lang="id">

<head>
    <x-shared.head-meta :title="$title" :is-seo="false" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/dashboard/main.js'])
    
    {{-- Quill Rich Text Editor --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body 
    class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 antialiased overflow-x-hidden transition-colors duration-300"
    x-data="{ 
        darkMode: localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches),
        sidebarOpen: false,
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('darkMode', this.darkMode);
        }
    }"
    x-init="
        $watch('darkMode', val => {
            if (val) document.documentElement.classList.add('dark');
            else document.documentElement.classList.remove('dark');
        })
    "
>
    {{-- Sidebar Overlay (mobile) --}}
    <div 
        x-show="sidebarOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden"
        style="display: none;"
    ></div>

    {{-- Sidebar --}}
    <x-organisms.dashboard.sidebar />

    {{-- Main Content --}}
    <div class="lg:ml-[260px] min-h-screen flex flex-col transition-all duration-300">

        {{-- Top Bar --}}
        <x-organisms.dashboard.topbar :pageTitle="$pageTitle" :breadcrumbs="$breadcrumbs" />

        {{-- Flash Message --}}
        <x-molecules.shared.flash />

        {{-- Page Content --}}
        <main class="flex-1 p-6 lg:p-10">
            {{-- Header Section --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 dark:text-white mb-2">{{ $pageTitle }}</h1>
                    <nav class="flex items-center gap-2 text-sm text-slate-400 dark:text-slate-500">
                        <a href="/dashboard" class="hover:text-primary transition flex items-center gap-1.5">
                            <x-heroicon-o-home class="size-4" />
                            <span>Home</span>
                        </a>
                        @foreach ($breadcrumbs as $crumb)
                            <span class="text-slate-300 dark:text-slate-700">/</span>
                            @if (isset($crumb['href']))
                                <a href="{{ $crumb['href'] }}" class="hover:text-primary transition">{{ $crumb['label'] }}</a>
                            @else
                                <span class="text-slate-500 dark:text-slate-300 font-medium">{{ $crumb['label'] }}</span>
                            @endif
                        @endforeach
                    </nav>
                </div>

                @if (isset($headerActions))
                    <div class="flex items-center gap-3">
                        {{ $headerActions }}
                    </div>
                @endif
            </div>

            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="border-t border-slate-200 dark:border-slate-900 bg-white dark:bg-slate-950 px-6 py-4 transition-colors">
            <p class="text-xs text-slate-400 dark:text-slate-600 text-center">
                &copy; {{ date('Y') }} HMTIF UNPAS — Dashboard Admin
            </p>
        </footer>
        <x-molecules.shared.modal-confirm />
    </div>


    {{-- Quill JS --}}
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    
    {{ $scripts ?? '' }}
    @stack('scripts')
</body>
</html>

