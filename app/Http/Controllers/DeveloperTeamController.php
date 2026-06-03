<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Period;
use App\Services\DeveloperTeam\DeleteDeveloperTeamPeriodContentService;
use App\Services\DeveloperTeam\GetDeveloperTeamContentService;
use App\Services\DeveloperTeam\SaveDeveloperTeamContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeveloperTeamController extends Controller
{
    // -----------------------------------------------------------------------
    // Public
    // -----------------------------------------------------------------------

    public function show(Request $request, GetDeveloperTeamContentService $getContent): View
    {
        $periods      = Period::orderBy('display_order')->get();
        $activePeriod = Period::resolveFromRequest($request, $periods);
        $content      = $getContent->execute($activePeriod);

        return view('pages.developer-team', compact('periods', 'activePeriod', 'content'));
    }

    // -----------------------------------------------------------------------
    // Dashboard
    // -----------------------------------------------------------------------

    public function index(Request $request, GetDeveloperTeamContentService $getContent): View
    {
        $periods      = Period::orderBy('display_order')->get();
        $activePeriod = Period::resolveFromRequest($request, $periods);
        $content      = $getContent->execute($activePeriod);

        return view('dashboard.developer-teams.index', compact('periods', 'activePeriod', 'content'));
    }

    public function save(Request $request, SaveDeveloperTeamContentService $saveContent): RedirectResponse
    {
        $validated = $request->validate([
            'period'                      => 'required|string|exists:periods,label',
            'title'                       => 'required|string|max:255',
            'description'                 => 'nullable|string',
            'members'                     => 'nullable|array',
            'members.*.name'              => 'nullable|string|max:255',
            'members.*.role'              => 'nullable|string|max:255',
            'members.*.division'          => 'nullable|string|max:255',
            'members.*.photo'             => 'nullable|string|max:1024',
            'milestones'                  => 'nullable|array',
            'milestones.*.period'         => 'nullable|string|max:50',
            'milestones.*.title'          => 'nullable|string|max:255',
            'milestones.*.description'    => 'nullable|string',
            'milestones.*.status'         => 'nullable|string|in:done,current,planned',
        ]);

        $period = Period::where('label', $validated['period'])->firstOrFail();

        $saveContent->execute($validated, $period);

        ActivityLog::record('updated', new \App\Models\DeveloperTeamSetting(), "Menyimpan konten Tim Pengembang periode {$period->label}.");

        return redirect()->back()->with('success', "Konten Tim Pengembang periode {$period->label} berhasil disimpan.");
    }

    public function deletePeriod(Request $request, DeleteDeveloperTeamPeriodContentService $deleteContent): RedirectResponse
    {
        $label  = $request->validate(['period' => 'required|string|exists:periods,label'])['period'];
        $period = Period::where('label', $label)->firstOrFail();

        $deleteContent->execute($period);

        ActivityLog::record('deleted', new \App\Models\DeveloperTeamSetting(), "Menghapus konten Tim Pengembang periode {$period->label}.");

        return redirect()->route('dashboard.developer-teams')
            ->with('success', "Konten Tim Pengembang periode {$period->label} berhasil dihapus.");
    }
}
