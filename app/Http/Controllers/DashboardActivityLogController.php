<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ActivityLog::query()
            ->when($request->search, fn($q) => $q
                ->where('title', 'like', "%{$request->search}%")
                ->orWhere('performed_by', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('category', $request->category))
            ->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();

        $categories = ActivityLog::distinct()->pluck('category')->sort()->values();

        return view('dashboard.activity-logs.index', compact('logs', 'categories'));
    }

    public function create()
    {
        $categories = ActivityLog::distinct()->pluck('category')->sort()->values();

        return view('dashboard.activity-logs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'date'         => 'required|date',
            'category'     => 'required|string|max:255',
            'performed_by' => 'required|string|max:255',
        ]);

        ActivityLog::create($validated);

        return redirect()->route('dashboard.activity-logs')
            ->with('success', 'Log aktivitas berhasil ditambahkan.');
    }

    public function edit(ActivityLog $activityLog)
    {
        $categories = ActivityLog::distinct()->pluck('category')->sort()->values();

        return view('dashboard.activity-logs.edit', compact('activityLog', 'categories'));
    }

    public function update(Request $request, ActivityLog $activityLog)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'date'         => 'required|date',
            'category'     => 'required|string|max:255',
            'performed_by' => 'required|string|max:255',
        ]);

        $activityLog->update($validated);

        return redirect()->route('dashboard.activity-logs')
            ->with('success', 'Log aktivitas berhasil diperbarui.');
    }

    public function destroy(ActivityLog $activityLog)
    {
        $activityLog->delete();

        return redirect()->route('dashboard.activity-logs')
            ->with('success', 'Log aktivitas berhasil dihapus.');
    }
}