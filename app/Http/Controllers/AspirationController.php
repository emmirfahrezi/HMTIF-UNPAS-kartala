<?php

namespace App\Http\Controllers;

use App\Http\Resources\AspirationResource;
use App\Http\Resources\ResponseResource;
use App\Services\Aspiration\GetWeeklySpotlightService;
use App\Services\Aspiration\SubmitAspirationService;
use App\Services\Aspiration\TrackAspirationService;
use App\Services\Aspiration\TrackAspirationByNimService;
use App\Services\Mail\MailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    public function __construct(
        private SubmitAspirationService $submitAspiration,
        private TrackAspirationService $trackAspiration,
        private TrackAspirationByNimService $trackAspirationByNim,
        private GetWeeklySpotlightService $getWeeklySpotlight,
        private MailService $mailService,
    ) {}

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'    => 'nullable|string|max:100',
            'nim'     => 'nullable|string|max:20',
            'email'   => 'nullable|email|max:100',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:5000',
        ]);

        $aspiration = $this->submitAspiration->execute($validated);

        // Kirim notifikasi email ke admin (non-blocking)
        try {
            $this->mailService->sendAspirationNotification($aspiration->toArray());
        } catch (\Throwable) {}

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

    public function trackByNim(string $nim): JsonResponse
    {
        $aspirations = $this->trackAspirationByNim->execute($nim);

        return ResponseResource::success(
            AspirationResource::collection($aspirations),
            'Aspirations retrieved successfully'
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

    public function storeWeb(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama'   => 'nullable|string|max:100',
            'nim'    => 'nullable|string|max:20',
            'email'  => 'nullable|email|max:100',
            'tujuan' => 'required|string|max:200',
            'pesan'  => 'required|string',
        ]);

        $aspiration = $this->submitAspiration->execute([
            'name'    => $validated['nama'] ?? null,
            'nim'     => $validated['nim'] ?? null,
            'email'   => $validated['email'] ?? null,
            'subject' => $validated['tujuan'],
            'message' => $validated['pesan'],
        ]);

        // Kirim notifikasi email ke admin
        try {
            $this->mailService->sendAspirationNotification($aspiration->toArray());
        } catch (\Throwable) {}

        return redirect()
            ->back()
            ->with('aspiration_success', true)
            ->with('tracking_code', $aspiration->tracking_code);
    }
}
