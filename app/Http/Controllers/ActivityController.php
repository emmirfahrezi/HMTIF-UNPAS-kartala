<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if (!$user || !in_array($user->role, ['admin', 'bph', 'koordinator'])) {
                abort(403, 'Anda tidak memiliki akses untuk melihat log aktivitas.');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        // 📦 1. Siapkan data untuk dropdown filter (pakai cache agar ringan)
        $divisions = Cache::remember('activity_log_divisions', 3600, function () {
            return Division::orderBy('name')->pluck('name', 'name');
        });

        $actions = [
            'create' => 'Membuat Data',
            'update' => 'Mengubah Data',
            'delete' => 'Menghapus Data',
            'login'  => 'Login',
            'logout' => 'Logout',
        ];

        $query = ActivityLog::with(['user.staff.division'])->latest();

        if ($request->filled('division')) {
            $query->whereHas('user.staff.division', function ($q) use ($request) {
                $q->where('name', $request->division);
            });
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        $logs = $query->paginate(20)->withQueryString();

        return view('activities.index', compact('logs', 'divisions', 'actions'));
    }

    public function show(ActivityLog $activityLog)
    {
        $activityLog->load(['user.staff.division', 'model']);
        
        return view('activities.show', compact('activityLog'));
    }
}