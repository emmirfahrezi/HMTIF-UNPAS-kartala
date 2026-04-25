<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Services\Division\CreateDivisionService;
use App\Services\Division\DeleteDivisionService;
use App\Services\Division\GetDivisionsDashboardService;
use App\Services\Division\UpdateDivisionService;
use Illuminate\Http\Request;

class DashboardDivisionController extends Controller
{
    public function __construct(
        private GetDivisionsDashboardService $getDivisions,
        private CreateDivisionService $createDivision,
        private UpdateDivisionService $updateDivision,
        private DeleteDivisionService $deleteDivision,
    ) {}

    public function index(Request $request)
    {
        $divisions = $this->getDivisions->execute($request);

        return view('dashboard.staffs.divisions.index', compact('divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:divisions,slug',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $this->createDivision->execute($validated);

        return redirect()->route('dashboard.staffs.divisions')->with('success', 'Divisi berhasil ditambahkan.');
    }

    public function edit(Division $division)
    {
        return view('dashboard.staffs.divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:divisions,slug,{$division->id}",
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $this->updateDivision->execute($division, $validated);

        return redirect()->route('dashboard.staffs.divisions')->with('success', 'Divisi berhasil diperbarui.');
    }

    public function destroy(Division $division)
    {
        $this->deleteDivision->execute($division);

        return redirect()->route('dashboard.staffs.divisions')->with('success', 'Divisi berhasil dihapus.');
    }
}
