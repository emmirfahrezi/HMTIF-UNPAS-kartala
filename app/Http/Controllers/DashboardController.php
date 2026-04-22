<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Announcement;
use App\Models\Aspiration;
use App\Models\Product;
use App\Models\Staff;
use App\Models\Stat;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $stats = Stat::orderBy('order')->get();

        $counts = [
            'users'         => User::count(),
            'announcements' => Announcement::count(),
            'activities'    => Activity::count(),
            'products'      => Product::count(),
            'aspirations'   => Aspiration::count(),
            'staff'         => Staff::count(),
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

        return view('dashboard.index', [
            'user'                  => $user,
            'stats'                 => $stats,
            'counts'                => $counts,
            'recentAnnouncements'   => $recentAnnouncements,
            'recentActivities'      => $recentActivities,
            'recentAspirations'     => $recentAspirations,
        ]);
    }

    public function announcements(Request $request)
    {
        $announcements = Announcement::query()
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->latest('published_at')
            ->paginate(10);

        return view('dashboard.announcements.index', compact('announcements'));
    }

    public function activities(Request $request)
    {
        $activities = Activity::query()
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->latest('created_at')
            ->paginate(10);

        return view('dashboard.activities.index', compact('activities'));
    }

    public function products(Request $request)
    {
        $products = Product::query()
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->latest('created_at')
            ->paginate(10);

        return view('dashboard.products.index', compact('products'));
    }

    public function aspirations(Request $request)
    {
        $aspirations = Aspiration::query()
            ->when($request->search, fn($q) => $q->where('subject', 'like', "%{$request->search}%"))
            ->latest('created_at')
            ->paginate(10);

        return view('dashboard.aspirations.index', compact('aspirations'));
    }

    public function users(Request $request)
    {
        $users = User::query()
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%")->orWhere('email', 'like', "%{$request->search}%"))
            ->latest('created_at')
            ->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }
}
