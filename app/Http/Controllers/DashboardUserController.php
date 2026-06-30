<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\BulkDestroyUserRequest;
use App\Http\Requests\Dashboard\StoreUserRequest;
use App\Http\Requests\Dashboard\UpdateUserRequest;
use App\Models\ActivityLog;
use App\Models\Staff;
use App\Models\User;
use App\Services\Mail\MailService;
use App\Services\User\CreateUserService;
use App\Services\User\DeleteUserService;
use App\Services\User\GetUsersDashboardService;
use App\Services\User\UpdateUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $staffOptions = Staff::orderBy('name', 'asc')->get()->mapWithKeys(fn ($s) => [$s->id => $s->name])->toArray();
        $roleOptions  = User::ROLES;
        return view('dashboard.users.create', compact('staffOptions', 'roleOptions'));
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt(Str::random(32));

        $user = $this->createUser->execute($validated);

        // Send setup-password email so the new user can set their own password
        try {
            $token    = Str::random(64);
            $setupUrl = route('setup-password', $token) . '?email=' . urlencode($user->email);

            \DB::table('password_reset_tokens')->upsert(
                [['email' => $user->email, 'token' => bcrypt($token), 'created_at' => now()]],
                ['email']
            );

            if (app()->isLocal()) {
                \Log::info("[DEV] Setup password URL for {$user->email}: {$setupUrl}");
            }

            app(MailService::class)->sendPasswordSetupLink($user->email, $setupUrl);
        } catch (\Throwable $e) {
            \Log::error('Gagal mengirim email setup password: ' . $e->getMessage());
        }

        ActivityLog::record('created', $user, "Menambahkan pengguna: {$user->email}");

        return redirect()->route('dashboard.users')->with('success', 'Pengguna berhasil ditambahkan. Email pengaturan password telah dikirim.');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $staffOptions = Staff::orderBy('name', 'asc')->get()->mapWithKeys(fn ($s) => [$s->id => $s->name])->toArray();
        $roleOptions  = User::ROLES;
        return view('dashboard.users.edit', compact('user', 'staffOptions', 'roleOptions'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $this->updateUser->execute($user, $request->validated());

        ActivityLog::record('updated', $user, "Memperbarui pengguna: {$user->email}");

        return redirect()->route('dashboard.users')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $email = $user->email;
        ActivityLog::record('deleted', $user, "Menghapus pengguna: {$email}");

        $this->deleteUser->execute($user);

        return redirect()->route('dashboard.users')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function bulkDestroy(BulkDestroyUserRequest $request)
    {
        $users = User::whereIn('id', $request->validated('ids'))->get();

        foreach ($users as $user) {
            $this->authorize('delete', $user);
        }

        foreach ($users as $user) {
            ActivityLog::record('deleted', $user, "Menghapus pengguna: {$user->email}");
            $this->deleteUser->execute($user);
        }

        return redirect()->back()->with('success', count($users) . ' pengguna berhasil dihapus.');
    }
}
