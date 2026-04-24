{{-- Dashboard Sidebar --}}
@php
    $currentRoute = request()->path();

    $menuGroups = [
        'Overview' => [
            ['label' => 'Dashboard', 'icon' => 'heroicon-o-squares-2x2', 'href' => '/dashboard', 'match' => 'dashboard'],
        ],
        'Konten' => [
            ['label' => 'Kegiatan', 'icon' => 'heroicon-o-calendar', 'href' => '/dashboard/activities', 'match' => 'dashboard/activities'],
            ['label' => 'Pengumuman', 'icon' => 'heroicon-o-megaphone', 'href' => '/dashboard/announcements', 'match' => 'dashboard/announcements'],
        ],
        'Organisasi' => [
            ['label' => 'Pengurus', 'icon' => 'heroicon-o-users', 'href' => '/dashboard/staffs', 'match' => 'dashboard/staffs'],
            ['label' => 'Aspirasi', 'icon' => 'heroicon-o-chat-bubble-left-right', 'href' => '/dashboard/aspirations', 'match' => 'dashboard/aspirations'],
            ['label' => 'Notulensi', 'icon' => 'heroicon-o-clipboard-document-list', 'href' => '/dashboard/minutes', 'match' => 'dashboard/minutes'],
        ],
        'Store' => [
            ['label' => 'Produk', 'icon' => 'heroicon-o-shopping-bag', 'href' => '/dashboard/products', 'match' => 'dashboard/products'],
        ],
        'Pengaturan' => [
            ['label' => 'Statistik', 'icon' => 'heroicon-o-chart-bar', 'href' => '/dashboard/stats', 'match' => 'dashboard/stats'],
            ['label' => 'Pengguna', 'icon' => 'heroicon-o-user-circle', 'href' => '/dashboard/users', 'match' => 'dashboard/users'],
            ['label' => 'Pengaturan', 'icon' => 'heroicon-o-cog-6-tooth', 'href' => '/dashboard/settings', 'match' => 'dashboard/settings'],
        ],
    ];
@endphp

<aside id="dashSidebar" class="dash-sidebar fixed top-0 left-0 h-screen bg-white border-r border-slate-200 flex flex-col overflow-y-auto">

    {{-- Logo --}}
    <div class="h-16 flex items-center gap-3 px-6 border-b border-slate-100 shrink-0">
        <img src="{{ config('app.logo_url') }}" alt="Logo HMTIF" class="size-9 object-contain logo-remove-bg">
        <span class="font-bold text-slate-800 text-sm tracking-tight">KARTALA</span>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 py-4 px-3 space-y-6">
        @foreach ($menuGroups as $group => $items)
            <div>
                @if ($group !== 'Overview')
                    <p class="px-3 mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $group }}</p>
                @endif

                <ul class="space-y-0.5">
                    @foreach ($items as $item)
                        @php
                            $isActive = $currentRoute === $item['match'] || str_starts_with($currentRoute, $item['match'] . '/');
                            $isExactDashboard = $item['match'] === 'dashboard' && $currentRoute === 'dashboard';
                            if ($item['match'] === 'dashboard' && $currentRoute !== 'dashboard') {
                                $isActive = false;
                            }
                        @endphp
                        <li>
                            <a href="{{ $item['href'] }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                                    {{ $isActive
                                        ? 'bg-primary/10 text-primary'
                                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                                <x-dynamic-component :component="$item['icon']" class="size-5 shrink-0" />
                                <span>{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </nav>

    {{-- Bottom --}}
    <div class="p-4 border-t border-slate-100 shrink-0">
        <a href="/"
            class="flex items-center gap-2 px-3 py-2 text-sm text-slate-500 hover:text-primary rounded-lg hover:bg-slate-50 transition-all">
            <x-heroicon-o-arrow-left class="size-4" />
            <span>Kembali ke Website</span>
        </a>
    </div>
</aside>
