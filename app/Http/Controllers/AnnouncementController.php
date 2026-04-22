<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnnouncementCategoryResource;
use App\Http\Resources\AnnouncementResource;
use App\Http\Resources\ResponseResource;
use App\Services\Announcement\GetAllAnnouncementsService;
use App\Services\Announcement\GetAnnouncementBySlugService;
use App\Services\Announcement\GetAnnouncementCategoriesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function __construct(
        private GetAllAnnouncementsService $getAllAnnouncements,
        private GetAnnouncementBySlugService $getAnnouncementBySlug,
        private GetAnnouncementCategoriesService $getAnnouncementCategories,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $announcements = $this->getAllAnnouncements->execute(
            $request->query('category_id') ? (int) $request->query('category_id') : null,
            $request->query('search')
        );

        return ResponseResource::paginated(
            $announcements,
            AnnouncementResource::collection($announcements),
            'Announcements retrieved successfully'
        );
    }

    public function show(string $slug): JsonResponse
    {
        $announcement = $this->getAnnouncementBySlug->execute($slug);

        return ResponseResource::success(
            new AnnouncementResource($announcement),
            'Announcement retrieved successfully'
        );
    }

    public function categories(): JsonResponse
    {
        $categories = $this->getAnnouncementCategories->execute();

        return ResponseResource::success(
            AnnouncementCategoryResource::collection($categories),
            'Announcement categories retrieved successfully'
        );
    }
}
