<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Division;
use App\Models\Staff;
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
        $staffs    = $this->getStaffs->execute($request);
        $divisions = Division::orderBy('order', 'asc')->get();

        return view('dashboard.staffs.index', compact('staffs', 'divisions'));
    }

    public function create()
    {
        $divisions = Division::orderBy('order', 'asc')->get()->pluck('name', 'id');
        $users     = User::orderBy('email', 'asc')->get()->pluck('email', 'id');

        return view('dashboard.staffs.create', compact('divisions', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'position'    => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'user_id'     => 'nullable|exists:users,id',
            'photo'       => 'nullable|string|max:1024',
            'photo_file'  => 'nullable|file|image|max:2048',
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
        $divisions = Division::orderBy('order', 'asc')->get()->pluck('name', 'id');
        $users     = User::orderBy('email', 'asc')->get()->pluck('email', 'id');

        return view('dashboard.staffs.edit', compact('staff', 'divisions', 'users'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'position'    => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'user_id'     => 'nullable|exists:users,id',
            'photo'       => 'nullable|string|max:1024',
            'photo_file'  => 'nullable|file|image|max:2048',
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
        $name = $staff->name;
        ActivityLog::record('deleted', $staff, "Menghapus pengurus: {$name}");

        $this->deleteStaff->execute($staff);

        return redirect()->route('dashboard.staffs')->with('success', 'Staff berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'string'])['ids'];

        $staffs = Staff::whereIn('id', $ids)->get();
        foreach ($staffs as $staff) {
            ActivityLog::record('deleted', $staff, "Menghapus pengurus: {$staff->name}");
            $this->deleteStaff->execute($staff);
        }

        return redirect()->back()->with('success', \count($ids) . ' pengurus berhasil dihapus.');
    }

    public function truncate()
    {
        // Bersihkan file foto lokal agar tidak meninggalkan orphan di storage.
        // File yang diawali 'http' dianggap URL eksternal — tidak dihapus.
        Staff::whereNotNull('photo')
            ->where('photo', 'not like', 'http%')
            ->pluck('photo')
            ->each(fn ($path) => Storage::disk('public')->delete($path));

        Staff::query()->delete();

        ActivityLog::record('deleted', new Staff(), 'Mereset (menghapus semua) data pengurus.');

        return redirect()->route('dashboard.staffs')->with('success', 'Seluruh data pengurus berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'string'])['ids'];

        foreach ($ids as $order => $id) {
            Staff::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }
}