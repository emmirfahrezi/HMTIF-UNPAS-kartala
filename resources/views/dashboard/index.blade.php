<x-dashboard-layout pageTitle="Dashboard Overview">
    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        <x-dashboard.stat-card label="Pengguna" :value="$counts['users'] ?? 0" icon="heroicon-o-user-circle"
            color="primary" href="/dashboard/users" />
        <x-dashboard.stat-card label="Pengumuman" :value="$counts['announcements'] ?? 0" icon="heroicon-o-megaphone"
            color="blue" href="/dashboard/announcements" />
        <x-dashboard.stat-card label="Kegiatan" :value="$counts['activities'] ?? 0" icon="heroicon-o-calendar"
            color="emerald" href="/dashboard/activities" />
        <x-dashboard.stat-card label="Produk" :value="$counts['products'] ?? 0" icon="heroicon-o-shopping-bag"
            color="purple" href="/dashboard/products" />
        <x-dashboard.stat-card label="Aspirasi" :value="$counts['aspirations'] ?? 0"
            icon="heroicon-o-chat-bubble-left-right" color="amber" href="/dashboard/aspirations" />
        <x-dashboard.stat-card label="Pengurus" :value="$counts['staff'] ?? 0" icon="heroicon-o-users" color="rose"
            href="/dashboard/staffs" />
    </div>

    {{-- Recent Items --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Recent Announcements --}}
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <h3 class="font-bold text-slate-800 text-sm">Pengumuman Terbaru</h3>
                <a href="/dashboard/announcements"
                    class="text-xs text-primary font-semibold hover:underline">Lihat Semua</a>
            </div>
            <ul class="divide-y divide-slate-50">
                @forelse ($recentAnnouncements as $item)
                    <li class="px-5 py-3 hover:bg-slate-50 transition">
                        <p class="text-sm font-medium text-slate-700 truncate">{{ $item->title }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ $item->published_at?->translatedFormat('d M Y') ?? '-' }}
                        </p>
                    </li>
                @empty
                    <li class="px-5 py-6 text-center text-sm text-slate-400">Belum ada pengumuman</li>
                @endforelse
            </ul>
        </div>

        {{-- Recent Activities --}}
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <h3 class="font-bold text-slate-800 text-sm">Kegiatan Terbaru</h3>
                <a href="/dashboard/activities"
                    class="text-xs text-primary font-semibold hover:underline">Lihat Semua</a>
            </div>
            <ul class="divide-y divide-slate-50">
                @forelse ($recentActivities as $item)
                    <li class="px-5 py-3 hover:bg-slate-50 transition">
                        <p class="text-sm font-medium text-slate-700 truncate">{{ $item->title }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ $item->start_date?->translatedFormat('d M Y') ?? '-' }}
                        </p>
                    </li>
                @empty
                    <li class="px-5 py-6 text-center text-sm text-slate-400">Belum ada kegiatan</li>
                @endforelse
            </ul>
        </div>

        {{-- Recent Aspirations --}}
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <h3 class="font-bold text-slate-800 text-sm">Aspirasi Terbaru</h3>
                <a href="/dashboard/aspirations"
                    class="text-xs text-primary font-semibold hover:underline">Lihat Semua</a>
            </div>
            <ul class="divide-y divide-slate-50">
                @forelse ($recentAspirations as $item)
                    <li class="px-5 py-3 hover:bg-slate-50 transition">
                        <div class="flex items-center justify-between gap-3">
                            <p class="text-sm font-medium text-slate-700 truncate flex-1">{{ $item->subject }}</p>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'reviewed' => 'bg-blue-100 text-blue-700',
                                    'resolved' => 'bg-emerald-100 text-emerald-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                ];
                            @endphp
                            <span
                                class="shrink-0 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase {{ $statusColors[$item->status] ?? 'bg-slate-100 text-slate-600' }}">
                                {{ $item->status }}
                            </span>
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ $item->created_at?->translatedFormat('d M Y') }}
                        </p>
                    </li>
                @empty
                    <li class="px-5 py-6 text-center text-sm text-slate-400">Belum ada aspirasi</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-dashboard-layout>
