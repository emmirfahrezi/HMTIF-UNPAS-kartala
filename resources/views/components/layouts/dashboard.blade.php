@props([
    'title' => null,
    'pageTitle' => 'Dashboard',
    'breadcrumbs' => [],
])
@php
    $title = $title ?? ($pageTitle !== 'Dashboard' ? $pageTitle . ' | Dashboard — HMTIF-UNPAS' : 'Dashboard | HMTIF-UNPAS');
    $currentRoute = request()->path();
    $user = auth()->user();
    $roleName = $user->role_label;
    $hasFullAccess = (bool) ($hasFullAccess ?? true);
    $allowedMenus = $allowedMenus ?? [];

    $cleanPath = preg_replace('/^dashboard\/?/', '', $currentRoute);
    if (str_starts_with($cleanPath, 'staffs/divisions')) {
        $pageKey = 'staffs/divisions';
    } else {
        $pathParts = explode('/', $cleanPath);
        $pageKey = !empty($pathParts[0]) ? $pathParts[0] : 'dashboard';
    }

    // Determine visual skeleton structure based on route
    $isCreateOrEdit =
        str_contains($cleanPath, '/create') ||
        str_contains($cleanPath, '/edit') ||
        str_contains($cleanPath, '/reorder');
    $isShow =
        str_contains($cleanPath, '/show') ||
        preg_match('/^[a-z\-]+\/[a-zA-Z0-9\-]+$/', $cleanPath) ||
        (str_starts_with($cleanPath, 'aspirations/') && !str_contains($cleanPath, '/index'));

    if ($cleanPath === '' || $cleanPath === 'dashboard') {
        $skeletonType = 'overview';
    } elseif ($cleanPath === 'profile') {
        $skeletonType = 'profile';
    } elseif ($cleanPath === 'settings') {
        $skeletonType = 'settings';
    } elseif ($cleanPath === 'home-sections') {
        $skeletonType = 'home-sections';
    } elseif ($isCreateOrEdit) {
        $skeletonType = 'form';
    } elseif ($isShow) {
        $skeletonType = 'show';
    } else {
        $skeletonType = 'table';
    }
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <x-shared.head-meta :title="$title" :is-seo="false" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/dashboard/main.js'])

    {{-- Quill CSS bundled via npm/Vite (dashboard.css @import) --}}

    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body
    class="font-dashboard bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 antialiased overflow-x-hidden transition-colors duration-300"
    x-data="{
        darkMode: localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches),
        sidebarOpen: false,
        pageLoading: true,
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('darkMode', this.darkMode);
        }
    }" x-init="$watch('darkMode', val => {
        if (val) document.documentElement.classList.add('dark');
        else document.documentElement.classList.remove('dark');
    });
    $nextTick(() => { setTimeout(() => pageLoading = false, 200) });">
    {{-- Sidebar Overlay (mobile) --}}
    <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden" style="display: none;"></div>

    {{-- Sidebar --}}
    <x-organisms.dashboard.sidebar />

    {{-- Main Content --}}
    <div class="lg:ml-[260px] min-h-screen flex flex-col transition-all duration-300">

        {{-- Top Bar --}}
        <x-organisms.dashboard.topbar :pageTitle="$pageTitle" :breadcrumbs="$breadcrumbs" />

        {{-- Flash Message --}}
        <x-molecules.shared.flash />

        {{-- Page Content --}}
        <main class="flex-1 p-6 lg:p-10 relative">
            <!-- 1. SKELETON SHIMMER LOADER (Tampil saat pageLoading = true) -->
            <div x-show="pageLoading" class="space-y-8 animate-pulse pointer-events-none select-none">
                <!-- Header Skeleton -->
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <div class="space-y-3">
                        <div class="h-8 w-56 bg-slate-200 dark:bg-slate-800 rounded-xl"></div>
                        <div class="h-4 w-36 bg-slate-100 dark:bg-slate-800/80 rounded-lg"></div>
                    </div>
                    @if (isset($headerActions))
                        <div class="h-10 w-36 bg-slate-200 dark:bg-slate-800 rounded-xl"></div>
                    @endif
                </div>

                @if ($skeletonType === 'overview')
                    <!-- OVERVIEW SKELETON -->
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <template x-for="i in 6">
                            <div
                                class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-5 space-y-4 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <div class="h-10 w-10 bg-slate-200 dark:bg-slate-800 rounded-xl"></div>
                                    <div class="h-4 w-12 bg-slate-100 dark:bg-slate-800/60 rounded-md"></div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-7 w-12 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                                    <div class="h-3.5 w-20 bg-slate-100 dark:bg-slate-800/80 rounded-md"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <template x-for="col in 3">
                            <div
                                class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 space-y-5 shadow-sm">
                                <div
                                    class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                                    <div class="h-5 w-32 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                                    <div class="h-4 w-16 bg-slate-100 dark:bg-slate-800/60 rounded-md"></div>
                                </div>
                                <div class="space-y-4">
                                    <template x-for="row in 5">
                                        <div
                                            class="py-2 border-b border-slate-50 dark:border-slate-800/30 last:border-0 space-y-2">
                                            <div class="h-4 w-5/6 bg-slate-200 dark:bg-slate-800 rounded-md"></div>
                                            <div class="h-3 w-16 bg-slate-100 dark:bg-slate-800/60 rounded"></div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                @elseif ($skeletonType === 'home-sections')
                    <!-- HOME SECTIONS SKELETON -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <template x-for="i in 5">
                            <div
                                class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 space-y-5 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 bg-slate-200 dark:bg-slate-800 rounded-xl shrink-0"></div>
                                    <div class="h-5 w-40 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-3.5 w-full bg-slate-100 dark:bg-slate-800/60 rounded"></div>
                                    <div class="h-3.5 w-5/6 bg-slate-100 dark:bg-slate-800/60 rounded"></div>
                                </div>
                                <div
                                    class="h-10 w-full bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-slate-100 dark:border-slate-800/50">
                                </div>
                            </div>
                        </template>
                    </div>
                @elseif ($skeletonType === 'profile')
                    <!-- PROFILE SKELETON -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div
                            class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 flex flex-col items-center space-y-6 shadow-sm">
                            <div class="h-28 w-28 bg-slate-200 dark:bg-slate-800 rounded-2xl shrink-0"></div>
                            <div class="space-y-2 text-center w-full">
                                <div class="h-5 w-24 bg-slate-200 dark:bg-slate-800 rounded-lg mx-auto"></div>
                                <div class="h-3.5 w-36 bg-slate-100 dark:bg-slate-800/60 rounded mx-auto"></div>
                                <div class="h-6 w-20 bg-slate-100 dark:bg-slate-800/80 rounded-full mx-auto mt-2"></div>
                            </div>
                            <div class="w-full pt-4 space-y-3">
                                <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                <div class="h-10 w-full bg-slate-200 dark:bg-slate-800 rounded-xl"></div>
                            </div>
                        </div>
                        <div class="lg:col-span-2 space-y-6">
                            <div
                                class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 space-y-6 shadow-sm">
                                <div
                                    class="flex items-center gap-3 border-b border-slate-100 dark:border-slate-800 pb-4">
                                    <div class="h-6 w-6 bg-slate-200 dark:bg-slate-800 rounded-full"></div>
                                    <div class="h-5 w-32 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <div class="h-4 w-24 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                        <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="h-4 w-32 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                        <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="h-4 w-24 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                        <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="h-4 w-32 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                        <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-4 w-24 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                    <div class="h-20 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($skeletonType === 'settings')
                    <!-- SETTINGS SKELETON -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div
                            class="lg:col-span-2 bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 space-y-6 shadow-sm">
                            <div
                                class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                                <div class="h-5 w-40 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                                <div class="h-6 w-16 bg-slate-100 dark:bg-slate-800/80 rounded-full"></div>
                            </div>
                            <div class="space-y-4">
                                <div
                                    class="grid grid-cols-6 gap-4 text-xs font-bold text-slate-400 border-b border-slate-50 dark:border-slate-800/30 pb-2">
                                    <div class="col-span-2">ROLE</div>
                                    <div>C</div>
                                    <div>R</div>
                                    <div>U</div>
                                    <div>D</div>
                                </div>
                                <template x-for="i in 5">
                                    <div
                                        class="grid grid-cols-6 gap-4 items-center py-2 border-b border-slate-50 dark:border-slate-800/30 last:border-0">
                                        <div class="col-span-2 flex items-center gap-2">
                                            <div class="h-2 w-2 bg-slate-200 dark:bg-slate-800 rounded-full"></div>
                                            <div class="h-4 w-20 bg-slate-200 dark:bg-slate-800 rounded-md"></div>
                                        </div>
                                        <div class="h-5 w-10 bg-slate-100 dark:bg-slate-800 rounded-full"></div>
                                        <div class="h-5 w-10 bg-slate-100 dark:bg-slate-800 rounded-full"></div>
                                        <div class="h-5 w-10 bg-slate-100 dark:bg-slate-800 rounded-full"></div>
                                        <div class="h-5 w-10 bg-slate-100 dark:bg-slate-800 rounded-full"></div>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div
                                class="h-24 w-full bg-blue-50/50 dark:bg-blue-950/20 border border-blue-100 dark:border-blue-900/30 rounded-2xl p-4 flex items-start gap-3">
                                <div class="h-6 w-6 bg-slate-200 dark:bg-slate-800 rounded-full shrink-0"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-4 w-20 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                    <div class="h-3 w-full bg-slate-100 dark:bg-slate-800/60 rounded"></div>
                                </div>
                            </div>
                            <div
                                class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 space-y-4 shadow-sm">
                                <div class="h-5 w-36 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                                <div class="space-y-2">
                                    <div class="h-4 w-16 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                    <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                </div>
                                <div class="space-y-3 pt-2">
                                    <div class="h-4 w-28 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                    <template x-for="i in 4">
                                        <div class="flex items-center gap-2 py-1">
                                            <div class="h-4 w-4 bg-slate-200 dark:bg-slate-800 rounded-full shrink-0">
                                            </div>
                                            <div class="h-3.5 w-32 bg-slate-100 dark:bg-slate-800/60 rounded"></div>
                                        </div>
                                    </template>
                                </div>
                                <div class="h-10 w-full bg-slate-200 dark:bg-slate-800 rounded-xl pt-2"></div>
                            </div>
                        </div>
                    </div>
                @elseif ($skeletonType === 'form')
                    <!-- FORM SKELETON -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 space-y-6">
                            <div
                                class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 space-y-5 shadow-sm">
                                <div
                                    class="flex items-center gap-3 border-b border-slate-100 dark:border-slate-800 pb-4">
                                    <div class="h-6 w-6 bg-slate-200 dark:bg-slate-800 rounded-full"></div>
                                    <div class="h-5 w-36 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <div class="h-4 w-24 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                        <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="h-4 w-20 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                        <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-4 w-24 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                    <div
                                        class="border border-slate-100 dark:border-slate-800 rounded-xl overflow-hidden">
                                        <div
                                            class="h-10 w-full bg-slate-50 dark:bg-slate-950 border-b border-slate-100 dark:border-slate-800 flex items-center gap-2 px-3">
                                            <div class="h-5 w-16 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                            <div class="h-5 w-12 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                            <div class="h-5 w-20 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                        </div>
                                        <div class="h-40 w-full bg-slate-100/50 dark:bg-slate-900/30"></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 space-y-4 shadow-sm">
                                <div class="h-5 w-32 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <div class="h-4 w-24 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                        <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="h-4 w-24 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                        <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div
                                class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 space-y-4 shadow-sm">
                                <div class="h-5 w-32 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                                <div class="space-y-2">
                                    <div class="h-4 w-24 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                    <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-4 w-32 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                    <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-4 w-24 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                    <div
                                        class="h-12 w-full bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-dashed border-slate-200 dark:border-slate-800 flex items-center justify-center">
                                        <div class="h-4 w-24 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 space-y-4 shadow-sm">
                                <div class="h-5 w-32 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                                <div class="h-10 w-full bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                            </div>
                        </div>
                    </div>
                @elseif ($skeletonType === 'show')
                    <!-- SHOW/DETAIL SKELETON -->
                    <div
                        class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 space-y-6 shadow-sm">
                        <div
                            class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 bg-slate-200 dark:bg-slate-800 rounded-xl"></div>
                                <div class="space-y-1">
                                    <div class="h-5 w-40 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                                    <div class="h-3.5 w-24 bg-slate-100 dark:bg-slate-800/60 rounded"></div>
                                </div>
                            </div>
                            <div class="h-8 w-24 bg-slate-100 dark:bg-slate-800/80 rounded-full"></div>
                        </div>
                        <div class="space-y-4">
                            <div class="h-6 w-1/3 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                            <div class="space-y-2">
                                <div class="h-4 w-full bg-slate-100 dark:bg-slate-800/60 rounded"></div>
                                <div class="h-4 w-full bg-slate-100 dark:bg-slate-800/60 rounded"></div>
                                <div class="h-4 w-2/3 bg-slate-100 dark:bg-slate-800/60 rounded"></div>
                            </div>
                        </div>
                        <div class="border-t border-slate-100 dark:border-slate-800 pt-6 space-y-4">
                            <div class="h-5 w-32 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                            <div class="flex gap-4">
                                <div class="h-10 w-10 bg-slate-200 dark:bg-slate-800 rounded-full shrink-0"></div>
                                <div class="flex-1 bg-slate-50 dark:bg-slate-800/30 rounded-2xl p-4 space-y-2">
                                    <div class="h-4 w-32 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                    <div class="h-3.5 w-full bg-slate-100 dark:bg-slate-800/60 rounded"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- TABLE INDEX SKELETON (FALLBACK) -->
                    <!-- Filter Card Skeleton -->
                    <div
                        class="h-16 w-full bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-4 flex items-center justify-between shadow-sm">
                        <div class="flex gap-3">
                            <div class="h-8 w-48 bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                            <div class="h-8 w-24 bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                        </div>
                        <div class="h-8 w-32 bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                    </div>

                    <!-- Table/Data Cards Skeleton -->
                    <div
                        class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-2xl overflow-hidden p-6 space-y-6 shadow-sm">
                        <div
                            class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                            <div class="h-6 w-32 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                            <div class="h-8 w-8 bg-slate-100 dark:bg-slate-800 rounded-full"></div>
                        </div>
                        <div class="space-y-5">
                            <template x-for="i in 5">
                                <div
                                    class="flex items-center gap-4 py-2 border-b border-slate-50 dark:border-slate-800/30 last:border-0">
                                    <div class="h-4 w-4 bg-slate-200 dark:bg-slate-800 rounded"></div>
                                    <div class="h-10 w-10 bg-slate-200 dark:bg-slate-800 rounded-full shrink-0"></div>
                                    <div class="flex-1 space-y-2">
                                        <div class="h-4 w-1/3 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                                        <div class="h-3 w-1/4 bg-slate-100 dark:bg-slate-800 rounded-lg"></div>
                                    </div>
                                    <div class="h-8 w-20 bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
                                </div>
                            </template>
                        </div>
                    </div>
                @endif
            </div>

            <!-- 2. KONTEN ASLI (Masuk dengan Transisi Premium setelah Load) -->
            <div x-show="!pageLoading" x-cloak x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                class="space-y-8">
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
                                    <a href="{{ $crumb['href'] }}"
                                        class="hover:text-primary transition">{{ $crumb['label'] }}</a>
                                @else
                                    <span
                                        class="text-slate-500 dark:text-slate-300 font-medium">{{ $crumb['label'] }}</span>
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
            </div>
        </main>

        {{-- Footer --}}
        <footer
            class="border-t border-slate-200 dark:border-slate-900 bg-white dark:bg-slate-950 px-6 py-4 transition-colors">
            <p class="text-xs text-slate-400 dark:text-slate-600 text-center">
                &copy; {{ date('Y') }} HMTIF-UNPAS — Dashboard Admin
            </p>
        </footer>
        <x-molecules.shared.modal-confirm />
    </div>


    {{-- Quill JS bundled via npm/Vite (window.Quill exposed in main.js) --}}

    {{ $scripts ?? '' }}
    @stack('scripts')
</body>

</html>
