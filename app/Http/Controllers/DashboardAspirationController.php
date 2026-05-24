<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\ActivityLog;
use App\Services\Aspiration\GetAspirationsDashboardService;
use App\Services\Mail\MailService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DashboardAspirationController extends Controller
{
    public function __construct(
        private GetAspirationsDashboardService $getAspirations,
        private MailService $mailService,
    ) {}

    public function index(Request $request): View
    {
        $aspirations = $this->getAspirations->execute($request);

        return view('dashboard.aspirations.index', compact('aspirations'));
    }

    public function show(string $id): View
    {
        $aspiration = Aspiration::findOrFail($id);

        // Overlay feedback dari file JSON sampai kolom DB tersedia
        $feedbackFile = storage_path('app/aspiration_feedback.json');
        if (file_exists($feedbackFile)) {
            $feedbackData = json_decode(file_get_contents($feedbackFile), true) ?: [];
            if (isset($feedbackData[$id])) {
                $aspiration->status           = $feedbackData[$id]['status'];
                $aspiration->admin_feedback   = $feedbackData[$id]['feedback'];
                $aspiration->feedback_sent_at = $feedbackData[$id]['sent_at'];
            }
        }

        return view('dashboard.aspirations.show', compact('aspiration'));
    }

    public function feedback(string $id, Request $request): RedirectResponse
    {
        $request->validate([
            'status'   => 'required|in:pending,reviewed,resolved,rejected',
            'feedback' => 'required|string|min:5',
        ]);

        $aspiration = Aspiration::find($id);

        if ($aspiration) {
            $aspiration->update(['status' => $request->status]);

            // Kirim email tanggapan otomatis jika email diisi
            if (! empty($aspiration->email)) {
                try {
                    $this->mailService->sendAspirationStatusUpdate(
                        $aspiration->email,
                        $aspiration->name ?: 'Pelapor',
                        $aspiration->subject,
                        $request->status,
                        $aspiration->tracking_code,
                        $request->feedback,
                    );
                } catch (\Throwable $e) {
                    Log::error('Gagal mengirim email feedback aspirasi: ' . $e->getMessage());
                }
            }
        }

        // Simpan feedback ke file JSON (sementara, sampai kolom DB tersedia)
        $feedbackFile = storage_path('app/aspiration_feedback.json');
        $feedbackData = [];
        if (file_exists($feedbackFile)) {
            $feedbackData = json_decode(file_get_contents($feedbackFile), true) ?: [];
        }
        $feedbackData[$id] = [
            'status'   => $request->status,
            'feedback' => $request->feedback,
            'sent_at'  => now()->format('Y-m-d H:i:s'),
        ];
        file_put_contents($feedbackFile, json_encode($feedbackData));

        return redirect()
            ->route('dashboard.aspirations.show', $id)
            ->with('success', 'Feedback berhasil dikirim dan status aspirasi diperbarui!');
    }
}
