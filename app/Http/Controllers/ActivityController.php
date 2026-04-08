<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use App\Http\Resources\ResponseResource;
use App\Services\Activity\FilterActivitiesService;
use App\Services\Activity\GetActivityBySlugService;
use App\Services\Activity\GetAllActivitiesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct(
        private GetAllActivitiesService $getAllActivities,
        private GetActivityBySlugService $getActivityBySlug,
        private FilterActivitiesService $filterActivities,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $activities = $this->getAllActivities->execute($request->query('status'));

        return ResponseResource::paginated(
            $activities,
            ActivityResource::collection($activities),
            'Activities retrieved successfully'
        );
    }

    public function show(string $slug): JsonResponse
    {
        $activity = $this->getActivityBySlug->execute($slug);

        return ResponseResource::success(
            new ActivityResource($activity),
            'Activity retrieved successfully'
        );
    }

    public function filter(Request $request): JsonResponse
    {
        $request->validate([
            'status' => 'nullable|in:upcoming,ongoing,past',
            'search' => 'nullable|string|max:100',
        ]);

        $activities = $this->filterActivities->execute($request->only(['status', 'search']));

        return ResponseResource::paginated(
            $activities,
            ActivityResource::collection($activities),
            'Activities filtered successfully'
        );
    }
}
