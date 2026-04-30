<x-layouts.dashboard pageTitle="Dashboard Overview">
    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        <x-molecules.dashboard.cards.stat-card label="Pengguna" :value="$counts['users'] ?? 0" icon="heroicon-o-user-circle"
            color="primary" href="/dashboard/users" />
        <x-molecules.dashboard.cards.stat-card label="Pengumuman" :value="$counts['announcements'] ?? 0" icon="heroicon-o-megaphone"
            color="blue" href="/dashboard/announcements" />
        <x-molecules.dashboard.cards.stat-card label="Kegiatan" :value="$counts['activities'] ?? 0" icon="heroicon-o-calendar"
            color="emerald" href="/dashboard/activities" />
        <x-molecules.dashboard.cards.stat-card label="Produk" :value="$counts['products'] ?? 0" icon="heroicon-o-shopping-bag"
            color="purple" href="/dashboard/products" />
        <x-molecules.dashboard.cards.stat-card label="Aspirasi" :value="$counts['aspirations'] ?? 0"
            icon="heroicon-o-chat-bubble-left-right" color="amber" href="/dashboard/aspirations" />
        <x-molecules.dashboard.cards.stat-card label="Pengurus" :value="$counts['staff'] ?? 0" icon="heroicon-o-users" color="rose"
            href="/dashboard/staffs" />
    </div>

    {{-- Recent Items --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Recent Announcements --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden transition-colors duration-300">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100 dark:border-slate-800">
                <h3 class="font-bold text-slate-800 dark:text-white text-sm">Pengumuman Terbaru</h3>
                <a href="/dashboard/announcements"
                    class="text-xs text-primary font-semibold hover:underline">Lihat Semua</a>
            </div>
            <ul class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse ($recentAnnouncements as $item)
                    <li class="px-5 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                        <p class="text-sm font-medium text-slate-700 dark:text-slate-200 truncate">{{ $item->title }}</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">
                            {{ $item->published_at?->translatedFormat('d M Y') ?? '-' }}
                        </p>
                    </li>
                @empty
                    <li class="px-5 py-6 text-center text-sm text-slate-400 dark:text-slate-600">Belum ada pengumuman</li>
                @endforelse
            </ul>
        </div>

        {{-- Recent Activities --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden transition-colors duration-300">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100 dark:border-slate-800">
                <h3 class="font-bold text-slate-800 dark:text-white text-sm">Kegiatan Terbaru</h3>
                <a href="/dashboard/activities"
                    class="text-xs text-primary font-semibold hover:underline">Lihat Semua</a>
            </div>
            <ul class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse ($recentActivities as $item)
                    <li class="px-5 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                        <p class="text-sm font-medium text-slate-700 dark:text-slate-200 truncate">{{ $item->title }}</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">
                            {{ $item->start_date?->translatedFormat('d M Y') ?? '-' }}
                        </p>
                    </li>
                @empty
                    <li class="px-5 py-6 text-center text-sm text-slate-400 dark:text-slate-600">Belum ada kegiatan</li>
                @endforelse
            </ul>
        </div>

        {{-- Recent Aspirations --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden transition-colors duration-300">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100 dark:border-slate-800">
                <h3 class="font-bold text-slate-800 dark:text-white text-sm">Aspirasi Terbaru</h3>
                <a href="/dashboard/aspirations"
                    class="text-xs text-primary font-semibold hover:underline">Lihat Semua</a>
            </div>
            <ul class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse ($recentAspirations as $item)
                    <li class="px-5 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                        <div class="flex items-center justify-between gap-3">
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-200 truncate flex-1">{{ $item->subject }}</p>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-500',
                                    'reviewed' => 'bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-500',
                                    'resolved' => 'bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-500',
                                    'rejected' => 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-500',
                                ];
                            @endphp
                            <span
                                class="shrink-0 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase {{ $statusColors[$item->status] ?? 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400' }}">
                                {{ $item->status }}
                            </span>
                        </div>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">
                            {{ $item->created_at?->translatedFormat('d M Y') }}
                        </p>
                    </li>
                @empty
                    <li class="px-5 py-6 text-center text-sm text-slate-400 dark:text-slate-600">Belum ada aspirasi</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-layouts.dashboard>

