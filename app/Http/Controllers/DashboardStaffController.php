<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Division;
use App\Models\Period;
use App\Models\Staff;
use App\Models\StaffPeriod;
use App\Models\User;
use App\Services\Staff\CreateStaffService;
use App\Services\Staff\DeleteStaffService;
use App\Services\Staff\GetStaffsDashboardService;
use App\Services\Staff\UpdateStaffService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $periods      = Period::orderBy('display_order')->get();
        $activePeriod = Period::resolveFromRequest($request, $periods);
        $staffs       = $this->getStaffs->execute($request, $activePeriod);
        $divisions    = Division::orderBy('order', 'asc')->get();

        return view('dashboard.staffs.index', compact('staffs', 'divisions', 'periods', 'activePeriod'));
    }

    public function create()
    {
        $periods   = Period::orderBy('display_order')->get();
        $divisions = Division::orderBy('order', 'asc')->get()->pluck('name', 'id');
        $users     = User::orderBy('email', 'asc')->get()->pluck('email', 'id');

        return view('dashboard.staffs.create', compact('divisions', 'users', 'periods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'period_id'   => 'nullable|exists:periods,id',
            'name'        => 'required|string|max:255',
            'npm'         => 'nullable|string|digits:9',
            'position'    => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'user_id'     => 'nullable|exists:users,id',
            'photo'       => 'nullable|string|max:1024',
            'photo_file'  => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'bio'         => 'nullable|string',
            'instagram'   => 'nullable|string|max:255',
            'linkedin'    => 'nullable|string|max:1024',
            'order'       => 'nullable|integer',
            'is_active'   => 'boolean',
            'is_bph'      => 'boolean',
        ]);

        $staff = $this->createStaff->execute($validated, $request->file('photo_file'));

        ActivityLog::record('created', $staff, "Menambahkan pengurus: {$staff->name}");

        return redirect()->route('dashboard.staffs')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function edit(Staff $staff)
    {
        $periods   = Period::orderBy('display_order')->get();
        $divisions = Division::orderBy('order', 'asc')->get()->pluck('name', 'id');
        $users     = User::orderBy('email', 'asc')->get()->pluck('email', 'id');

        return view('dashboard.staffs.edit', compact('staff', 'divisions', 'users', 'periods'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'period_id'   => 'nullable|exists:periods,id',
            'name'        => 'required|string|max:255',
            'npm'         => 'nullable|string|digits:9',
            'position'    => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'user_id'     => 'nullable|exists:users,id',
            'photo'       => 'nullable|string|max:1024',
            'photo_file'  => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'bio'         => 'nullable|string',
            'instagram'   => 'nullable|string|max:255',
            'linkedin'    => 'nullable|string|max:1024',
            'order'       => 'nullable|integer',
            'is_active'   => 'boolean',
            'is_bph'      => 'boolean',
        ]);

        $this->updateStaff->execute($staff, $validated, $request->file('photo_file'));

        ActivityLog::record('updated', $staff, "Memperbarui pengurus: {$staff->name}");

        return redirect()->route('dashboard.staffs')->with('success', 'Staff berhasil diperbarui.');
    }

    public function destroy(Staff $staff)
    {
        $name         = $staff->name;
        $activePeriod = Period::where('is_active', true)->first();

        if ($activePeriod) {
            StaffPeriod::where('staff_id', $staff->id)
                ->where('period_id', $activePeriod->id)
                ->delete();

            ActivityLog::record('deleted', $staff, "Menghapus pengurus dari periode {$activePeriod->label}: {$name}");
        } else {
            ActivityLog::record('deleted', $staff, "Menghapus pengurus: {$name}");
            $this->deleteStaff->execute($staff);
        }

        return redirect()->route('dashboard.staffs')->with('success', 'Staff berhasil dihapus dari periode aktif.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids          = $request->validate(['ids' => 'required|array', 'ids.*' => 'string'])['ids'];
        $activePeriod = Period::where('is_active', true)->first();

        $staffs = Staff::whereIn('id', $ids)->get();
        foreach ($staffs as $staff) {
            if ($activePeriod) {
                StaffPeriod::where('staff_id', $staff->id)
                    ->where('period_id', $activePeriod->id)
                    ->delete();
                ActivityLog::record('deleted', $staff, "Menghapus pengurus dari periode {$activePeriod->label}: {$staff->name}");
            } else {
                ActivityLog::record('deleted', $staff, "Menghapus pengurus: {$staff->name}");
                $this->deleteStaff->execute($staff);
            }
        }

        return redirect()->back()->with('success', \count($ids) . ' pengurus berhasil dihapus dari periode aktif.');
    }

    public function truncate()
    {
        $activePeriod = Period::where('is_active', true)->first();

        if ($activePeriod) {
            StaffPeriod::where('period_id', $activePeriod->id)->delete();
            ActivityLog::record('deleted', new Staff(), "Mereset semua assignment periode {$activePeriod->label}.");
        } else {
            Staff::whereNotNull('photo')
                ->where('photo', 'not like', 'http%')
                ->pluck('photo')
                ->each(fn ($path) => Storage::disk('public')->delete($path));

            Staff::query()->delete();
            ActivityLog::record('deleted', new Staff(), 'Mereset (menghapus semua) data pengurus.');
        }

        return redirect()->route('dashboard.staffs')->with('success', 'Seluruh data pengurus berhasil dihapus dari periode aktif.');
    }

    public function reorder(Request $request)
    {
        $ids          = $request->validate(['ids' => 'required|array', 'ids.*' => 'string'])['ids'];
        $activePeriod = Period::where('is_active', true)->first();

        foreach ($ids as $order => $id) {
            if ($activePeriod) {
                StaffPeriod::where('staff_id', $id)
                    ->where('period_id', $activePeriod->id)
                    ->update(['order' => $order]);
            } else {
                Staff::where('id', $id)->update(['order' => $order]);
            }
        }

        return response()->json(['success' => true]);
    }
}