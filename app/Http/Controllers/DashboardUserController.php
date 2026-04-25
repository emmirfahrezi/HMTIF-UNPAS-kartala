<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use App\Services\User\CreateUserService;
use App\Services\User\DeleteUserService;
use App\Services\User\GetUsersDashboardService;
use App\Services\User\UpdateUserService;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function __construct(
        private GetUsersDashboardService $getUsers,
        private CreateUserService $createUser,
        private UpdateUserService $updateUser,
        private DeleteUserService $deleteUser,
    ) {}

    public function index(Request $request)
    {
        $users = $this->getUsers->execute($request);

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        $staffOptions = Staff::orderBy('name')->get()->mapWithKeys(fn ($staff) => [$staff->id => $staff->name])->toArray();

        return view('dashboard.users.create', compact('staffOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,bph,koordinator,staff',
            'staff_id' => 'nullable|exists:staffs,id',
        ]);

        $this->createUser->execute($validated);

        return redirect()->route('dashboard.users')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $staffOptions = Staff::orderBy('name')->get()->mapWithKeys(fn ($staff) => [$staff->id => $staff->name])->toArray();

        return view('dashboard.users.edit', compact('user', 'staffOptions'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|max:255|unique:users,email,{$user->id}",
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,bph,koordinator,staff',
            'staff_id' => 'nullable|exists:staffs,id',
        ]);

        $this->updateUser->execute($user, $validated);

        return redirect()->route('dashboard.users')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $this->deleteUser->execute($user);

        return redirect()->route('dashboard.users')->with('success', 'Pengguna berhasil dihapus.');
    }
}
