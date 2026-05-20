<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Services\Announcement\CreateAnnouncementService;
use App\Services\Announcement\DeleteAnnouncementService;
use App\Services\Announcement\GetAnnouncementsService;
use App\Services\Announcement\UpdateAnnouncementService;
use Illuminate\Http\Request;

class DashboardAnnouncementController extends Controller
{
    public function __construct(
        private GetAnnouncementsService $getAnnouncements,
        private CreateAnnouncementService $createAnnouncement,
        private UpdateAnnouncementService $updateAnnouncement,
        private DeleteAnnouncementService $deleteAnnouncement,
    ) {}

    public function index(Request $request)
    {
        $announcements = $this->getAnnouncements->execute($request);
        $categories = AnnouncementCategory::all();

        return view('dashboard.announcements.index', compact('announcements', 'categories'));
    }

    public function create()
    {
        $categories = AnnouncementCategory::all();

        return view('dashboard.announcements.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:announcements,slug',
            'announcement_category_id' => 'nullable|exists:announcement_categories,id',
            'excerpt' => 'nullable|string|max:1024',
            'body' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:1024',
            'published_at' => 'nullable|date',
            'file' => 'nullable|file|max:10240',
        ]);

        $announcement = $this->createAnnouncement->execute($validated, $request->file('file'));

        ActivityLog::record('created', $announcement, "Menambahkan pengumuman: {$announcement->title}");

        return redirect()->route('dashboard.announcements')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Announcement $announcement)
    {
        $categories = AnnouncementCategory::all();

        return view('dashboard.announcements.edit', compact('announcement', 'categories'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:announcements,slug,{$announcement->id}",
            'announcement_category_id' => 'nullable|exists:announcement_categories,id',
            'excerpt' => 'nullable|string|max:1024',
            'body' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:1024',
            'published_at' => 'nullable|date',
            'file' => 'nullable|file|max:10240',
        ]);

        $this->updateAnnouncement->execute($announcement, $validated, $request->file('file'));

        ActivityLog::record('updated', $announcement, "Memperbarui pengumuman: {$announcement->title}");

        return redirect()->route('dashboard.announcements')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        $title = $announcement->title;
        ActivityLog::record('deleted', $announcement, "Menghapus pengumuman: {$title}");

        $this->deleteAnnouncement->execute($announcement);

        return redirect()->route('dashboard.announcements')->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'string'])['ids'];

        $announcements = Announcement::whereIn('id', $ids)->get();
        foreach ($announcements as $announcement) {
            ActivityLog::record('deleted', $announcement, "Menghapus pengumuman: {$announcement->title}");
            $this->deleteAnnouncement->execute($announcement);
        }

        return redirect()->back()->with('success', count($ids) . ' pengumuman berhasil dihapus.');
    }

    public function bulkDestroyCat(Request $request)
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'integer'])['ids'];
        AnnouncementCategory::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', count($ids) . ' kategori pengumuman berhasil dihapus.');
    }
}
