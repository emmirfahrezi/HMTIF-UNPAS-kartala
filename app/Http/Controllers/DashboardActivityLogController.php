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
            ->when($request->search, fn($q) => $q->where(fn($sub) => $sub
                ->where('description', 'like', "%{$request->search}%")
                ->orWhereHas('user.staff', fn($s) => $s->where('name', 'like', "%{$request->search}%"))
                ->orWhereHas('user', fn($u) => $u->where('email', 'like', "%{$request->search}%"))))
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

    public function bulkDestroy(Request $request)
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'string'])['ids'];
        ActivityLog::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', count($ids) . ' log aktivitas berhasil dihapus.');
    }
}
