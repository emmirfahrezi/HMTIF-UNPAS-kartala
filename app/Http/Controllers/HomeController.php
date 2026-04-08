<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use App\Http\Resources\AnnouncementResource;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\StatResource;
use App\Services\Home\GetActivitiesPreviewService;
use App\Services\Home\GetAnnouncementsPreviewService;
use App\Services\Home\GetHomeStatsService;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function __construct(
        private GetHomeStatsService $getHomeStats,
        private GetActivitiesPreviewService $getActivitiesPreview,
        private GetAnnouncementsPreviewService $getAnnouncementsPreview,
    ) {}

    public function index(): JsonResponse
    {
        return ResponseResource::success([
            'stats'         => StatResource::collection($this->getHomeStats->execute()),
            'activities'    => ActivityResource::collection($this->getActivitiesPreview->execute()),
            'announcements' => AnnouncementResource::collection($this->getAnnouncementsPreview->execute()),
        ], 'Home data retrieved successfully');
    }
}
