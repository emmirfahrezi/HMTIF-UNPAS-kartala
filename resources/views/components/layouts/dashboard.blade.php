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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/dashboard/dashboard.css'])
</head>

<body class="bg-slate-50 text-slate-800 antialiased">
    @vite(['resources/js/dashboard/dashboard.js'])
    {{-- Sidebar Overlay (mobile) --}}
    <div id="sidebarOverlay" class="dash-sidebar-overlay fixed inset-0 bg-black/30 z-40 lg:hidden"
        onclick="toggleSidebar()"></div>

    {{-- Sidebar --}}
    <x-organisms.dashboard.sidebar />

    {{-- Main Content --}}
    <div class="dash-content min-h-screen flex flex-col">

        {{-- Top Bar --}}
        <x-organisms.dashboard.topbar :pageTitle="$pageTitle" :breadcrumbs="$breadcrumbs" />

        {{-- Flash Message --}}
        <x-molecules.dashboard.ui.flash-message />

        {{-- Page Content --}}
        <main class="flex-1 p-6 lg:p-8">
            {{-- Header Section --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 mb-2">{{ $pageTitle }}</h1>
                    <nav class="flex items-center gap-2 text-sm text-slate-400">
                        <a href="/dashboard" class="hover:text-primary transition flex items-center gap-1.5">
                            <x-heroicon-o-home class="size-4" />
                            <span>Home</span>
                        </a>
                        @foreach ($breadcrumbs as $crumb)
                            <span class="text-slate-300">/</span>
                            @if (isset($crumb['href']))
                                <a href="{{ $crumb['href'] }}" class="hover:text-primary transition">{{ $crumb['label'] }}</a>
                            @else
                                <span class="text-slate-500 font-medium">{{ $crumb['label'] }}</span>
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
        <footer class="border-t border-slate-200 bg-white px-6 py-4">
            <p class="text-xs text-slate-400 text-center">
                &copy; {{ date('Y') }} HMTIF UNPAS — Dashboard Admin
            </p>
        </footer>
    </div>


    {{ $scripts ?? '' }}
</body>

</html>
