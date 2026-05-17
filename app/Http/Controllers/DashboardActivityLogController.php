<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $categories = ActivityLog::getActionLabels();

        $logs = ActivityLog::query()
            ->with('user.staff')
            ->when($request->search, fn($q) => $q
                ->where('description', 'like', "%{$request->search}%")
                ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$request->search}%")))
            ->when($request->category, function ($q) use ($request) {
                $action = ActivityLog::labelToAction($request->category);
                if ($action) {
                    $q->where('action', $action);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('dashboard.activity-logs.index', compact('logs', 'categories'));
    }
}