<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use App\Services\Stat\CreateStatService;
use App\Services\Stat\DeleteStatService;
use App\Services\Stat\GetStatsDashboardService;
use App\Services\Stat\UpdateStatService;
use Illuminate\Http\Request;

class DashboardStatController extends Controller
{
    public function __construct(
        private GetStatsDashboardService $getStats,
        private CreateStatService $createStat,
        private UpdateStatService $updateStat,
        private DeleteStatService $deleteStat,
    ) {}

    public function index(Request $request)
    {
        $stats = $this->getStats->execute($request);

        return view('dashboard.stats.index', compact('stats'));
    }

    public function create()
    {
        return view('dashboard.stats.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $this->createStat->execute($validated);

        return redirect()->route('dashboard.stats')->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function edit(Stat $stat)
    {
        return view('dashboard.stats.edit', compact('stat'));
    }

    public function update(Request $request, Stat $stat)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $this->updateStat->execute($stat, $validated);

        return redirect()->route('dashboard.stats')->with('success', 'Statistik berhasil diperbarui.');
    }

    public function destroy(Stat $stat)
    {
        $this->deleteStat->execute($stat);

        return redirect()->route('dashboard.stats')->with('success', 'Statistik berhasil dihapus.');
    }
}
