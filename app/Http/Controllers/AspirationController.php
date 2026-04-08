<?php

namespace App\Http\Controllers;

use App\Http\Resources\AspirationResource;
use App\Http\Resources\ResponseResource;
use App\Services\Aspiration\GetWeeklySpotlightService;
use App\Services\Aspiration\SubmitAspirationService;
use App\Services\Aspiration\TrackAspirationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    public function __construct(
        private SubmitAspirationService $submitAspiration,
        private TrackAspirationService $trackAspiration,
        private GetWeeklySpotlightService $getWeeklySpotlight,
    ) {}

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'    => 'nullable|string|max:100',
            'email'   => 'nullable|email|max:100',
            'subject' => 'required|string|max:200',
            'message' => 'required|string',
        ]);

        $aspiration = $this->submitAspiration->execute($validated);

        return ResponseResource::success(
            new AspirationResource($aspiration),
            'Aspirasi berhasil dikirim',
            201
        );
    }

    public function track(string $trackingCode): JsonResponse
    {
        $aspiration = $this->trackAspiration->execute($trackingCode);

        return ResponseResource::success(
            new AspirationResource($aspiration),
            'Aspiration status retrieved successfully'
        );
    }

    public function spotlight(): JsonResponse
    {
        $aspirations = $this->getWeeklySpotlight->execute();

        return ResponseResource::success(
            AspirationResource::collection($aspirations),
            'Weekly spotlight retrieved successfully'
        );
    }
}
