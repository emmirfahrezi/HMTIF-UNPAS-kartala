<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Staff;
use App\Models\User;
use App\Services\Staff\CreateStaffService;
use App\Services\Staff\DeleteStaffService;
use App\Services\Staff\GetStaffsDashboardService;
use App\Services\Staff\UpdateStaffService;
use Illuminate\Http\Request;

class DashboardStaffController extends Controller
{
    public function __construct(
        private GetStaffsDashboardService $getStaffs,
        private CreateStaffService $createStaff,
        private UpdateStaffService $updateStaff,
        private DeleteStaffService $deleteStaff,
    ) {}

    public function index(Request $request)
    {
        $staffs = $this->getStaffs->execute($request);

        return view('dashboard.staffs.index', compact('staffs'));
    }

    public function create()
    {
        $divisions = Division::orderBy('order')->get();
        $users = User::orderBy('name')->get();

        return view('dashboard.staffs.create', compact('divisions', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'user_id' => 'nullable|exists:users,id',
            'photo' => 'nullable|url|max:1024',
            'bio' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:1024',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_bph' => 'boolean',
        ]);

        $this->createStaff->execute($validated);

        return redirect()->route('dashboard.staffs')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function edit(Staff $staff)
    {
        $divisions = Division::orderBy('order')->get();
        $users = User::orderBy('name')->get();

        return view('dashboard.staffs.edit', compact('staff', 'divisions', 'users'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'user_id' => 'nullable|exists:users,id',
            'photo' => 'nullable|url|max:1024',
            'bio' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:1024',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_bph' => 'boolean',
        ]);

        $this->updateStaff->execute($staff, $validated);

        return redirect()->route('dashboard.staffs')->with('success', 'Staff berhasil diperbarui.');
    }

    public function destroy(Staff $staff)
    {
        $this->deleteStaff->execute($staff);

        return redirect()->route('dashboard.staffs')->with('success', 'Staff berhasil dihapus.');
    }
}
