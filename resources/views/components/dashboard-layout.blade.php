@props([
    'title' => 'Dashboard — HMTIF UNPAS',
    'pageTitle' => 'Dashboard',
    'breadcrumbs' => [],
])
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Dashboard-specific styles */
        .dash-sidebar {
            width: 260px;
            transition: transform 0.3s ease;
        }

        .dash-content {
            margin-left: 260px;
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 1023px) {
            .dash-sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
            }

            .dash-sidebar.open {
                transform: translateX(0);
            }

            .dash-content {
                margin-left: 0;
            }
        }

        .dash-sidebar-overlay {
            display: none;
        }

        .dash-sidebar-overlay.open {
            display: block;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    {{-- Sidebar Overlay (mobile) --}}
    <div id="sidebarOverlay" class="dash-sidebar-overlay fixed inset-0 bg-black/30 z-40 lg:hidden"
        onclick="toggleSidebar()"></div>

    {{-- Sidebar --}}
    <x-dashboard.sidebar />

    {{-- Main Content --}}
    <div class="dash-content min-h-screen flex flex-col">

        {{-- Top Bar --}}
        <x-dashboard.topbar :pageTitle="$pageTitle" :breadcrumbs="$breadcrumbs" />

        {{-- Flash Message --}}
        <x-dashboard.flash-message />

        {{-- Page Content --}}
        <main class="flex-1 p-6 lg:p-8">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="border-t border-slate-200 bg-white px-6 py-4">
            <p class="text-xs text-slate-400 text-center">
                &copy; {{ date('Y') }} HMTIF UNPAS — Dashboard Admin
            </p>
        </footer>
    </div>

    {{-- Sidebar Toggle Script --}}
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('dashSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        }
    </script>

    {{ $scripts ?? '' }}
</body>

</html>
