<?php

namespace App\Services\Dashboard;

use App\Models\Activity;
use App\Models\Announcement;
use App\Models\Aspiration;
use App\Models\Stat;
use App\Models\User;

class GetDashboardIndexService
{
    public function execute()
    {
        $stats = Stat::orderBy('order')->get();

        $counts = [
            'users'         => User::count(),
            'announcements' => Announcement::count(),
            'activities'    => Activity::count(),
            'products'      => \App\Models\Product::count(),
            'aspirations'   => Aspiration::count(),
            'staff'         => \App\Models\Staff::count(),
        ];

        $recentAnnouncements = Announcement::latest('published_at')
            ->limit(5)
            ->get(['id', 'title', 'published_at', 'slug']);

        $recentActivities = Activity::latest('created_at')
            ->limit(5)
            ->get(['id', 'title', 'start_date', 'slug']);

        $recentAspirations = Aspiration::latest('created_at')
            ->limit(5)
            ->get(['id', 'subject', 'created_at', 'status']);

        return [
            'stats'                 => $stats,
            'counts'                => $counts,
            'recentAnnouncements'   => $recentAnnouncements,
            'recentActivities'      => $recentActivities,
            'recentAspirations'     => $recentAspirations,
        ];
    }
}
