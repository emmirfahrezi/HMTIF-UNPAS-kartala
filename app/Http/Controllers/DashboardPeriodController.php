<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Period;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardPeriodController extends Controller
{
    public function index(): View
    {
        $periods = Period::orderBy('display_order')->get();

        return view('dashboard.staffs.periods.index', compact('periods'));
    }

    public function create(): View
    {
        return view('dashboard.staffs.periods.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label'         => 'required|string|max:50|unique:periods,label',
            'display_order' => 'nullable|integer|min:0',
            'is_active'     => 'boolean',
        ]);

        $validated['is_active']     = $request->boolean('is_active');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        $period = Period::create($validated);

        ActivityLog::record('created', $period, "Menambahkan periode: {$period->label}");

        return redirect()->route('dashboard.staffs.periods')
            ->with('success', "Periode {$period->label} berhasil ditambahkan.");
    }

    public function edit(Period $period): View
    {
        return view('dashboard.staffs.periods.edit', compact('period'));
    }

    public function update(Request $request, Period $period): RedirectResponse
    {
        $validated = $request->validate([
            'label'         => "required|string|max:50|unique:periods,label,{$period->id}",
            'display_order' => 'nullable|integer|min:0',
            'is_active'     => 'boolean',
        ]);

        $validated['is_active']     = $request->boolean('is_active');
        $validated['display_order'] = $validated['display_order'] ?? $period->display_order;

        $period->update($validated);

        ActivityLog::record('updated', $period, "Memperbarui periode: {$period->label}");

        return redirect()->route('dashboard.staffs.periods')
            ->with('success', "Periode {$period->label} berhasil diperbarui.");
    }

    public function destroy(Period $period): RedirectResponse
    {
        // Cegah hapus periode yang masih dipakai assignment
        if ($period->staffPeriods()->exists()) {
            return redirect()->back()
                ->with('error', "Periode {$period->label} tidak bisa dihapus karena masih dipakai data pengurus.");
        }

        $label = $period->label;
        ActivityLog::record('deleted', $period, "Menghapus periode: {$label}");

        $period->delete();

        return redirect()->route('dashboard.staffs.periods')
            ->with('success', "Periode {$label} berhasil dihapus.");
    }

    public function bulkDestroy(Request $request): RedirectResponse
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'string'])['ids'];

        $periods   = Period::whereIn('id', $ids)->get();
        $skipped   = 0;
        $deleted   = 0;

        foreach ($periods as $period) {
            if ($period->staffPeriods()->exists()) {
                $skipped++;
                continue;
            }

            ActivityLog::record('deleted', $period, "Menghapus periode: {$period->label}");
            $period->delete();
            $deleted++;
        }

        $msg = "{$deleted} periode berhasil dihapus.";
        if ($skipped > 0) {
            $msg .= " {$skipped} periode dilewati karena masih dipakai data pengurus.";
        }

        return redirect()->back()->with('success', $msg);
    }
}
