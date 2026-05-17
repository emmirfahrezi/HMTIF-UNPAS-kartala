<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityLog;
use App\Services\Activity\CreateActivityService;
use App\Services\Activity\DeleteActivityService;
use App\Services\Activity\GetActivitiesDashboardService;
use App\Services\Activity\UpdateActivityService;
use Illuminate\Http\Request;

class DashboardActivityController extends Controller
{
    public function __construct(
        private GetActivitiesDashboardService $getActivities,
        private CreateActivityService $createActivity,
        private UpdateActivityService $updateActivity,
        private DeleteActivityService $deleteActivity,
    ) {}

    public function index(Request $request)
    {
        $activities = $this->getActivities->execute($request);

        return view('dashboard.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('dashboard.activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:activities,slug',
            'description' => 'required|string',
            'body' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:1024',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'registration_url' => 'nullable|url|max:1024',
            'status' => 'required|in:upcoming,ongoing,past',
            'file' => 'nullable|file|max:10240',
        ]);

        $activity = $this->createActivity->execute($validated, $request->file('file'));

        ActivityLog::record('created', $activity, "Menambahkan kegiatan: {$activity->title}");

        return redirect()->route('dashboard.activities')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Activity $activity)
    {
        return view('dashboard.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:activities,slug,{$activity->id}",
            'description' => 'required|string',
            'body' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:1024',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'registration_url' => 'nullable|url|max:1024',
            'status' => 'required|in:upcoming,ongoing,past',
            'file' => 'nullable|file|max:10240',
        ]);

        $this->updateActivity->execute($activity, $validated, $request->file('file'));

        ActivityLog::record('updated', $activity, "Memperbarui kegiatan: {$activity->title}");

        return redirect()->route('dashboard.activities')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Activity $activity)
    {
        $title = $activity->title;
        ActivityLog::record('deleted', $activity, "Menghapus kegiatan: {$title}");

        $this->deleteActivity->execute($activity);

        return redirect()->route('dashboard.activities')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
