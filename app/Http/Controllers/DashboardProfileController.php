<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DashboardProfileController extends Controller
{
    /**
     * Tampilkan halaman profil user yang sedang login.
     *
     * Variabel yang dikirim ke view:
     * - $user  : Auth user (memiliki accessor name, role_label, initial, avatar_url)
     * - $staff : Relasi Staff milik user ini (nullable)
     */
    public function index(): View
    {
        $user  = auth()->user();
        $staff = $user->staff;

        return view('dashboard.profile.index', compact('user', 'staff'));
    }

    /**
     * Perbarui data profil (email, bio, instagram, linkedin, github, foto).
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email'     => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'bio'       => 'nullable|string|max:500',
            'instagram' => 'nullable|string|max:255',
            'linkedin'  => 'nullable|string|max:1024',
            'photo'     => 'nullable|file|image|max:2048',
        ]);

        $user = auth()->user();
        $user->update(['email' => $validated['email']]);

        $staff = $user->staff;

        if ($staff) {
            $staffData = [
                'bio'       => $validated['bio']       ?? $staff->bio,
                'instagram' => $validated['instagram'] ?? $staff->instagram,
                'linkedin'  => $validated['linkedin']  ?? $staff->linkedin,
            ];

            if ($request->hasFile('photo')) {
                // Hapus foto lama dari storage (jika bukan URL eksternal)
                if ($staff->photo && ! str_starts_with($staff->photo, 'http')) {
                    Storage::disk('public')->delete($staff->photo);
                }
                $staffData['photo'] = $request->file('photo')->store('staffs/photos', 'public');
            }

            $staff->update($staffData);
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Perbarui password user.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'old_password'          => 'required|string',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string',
        ]);

        $user = auth()->user();

        if (! Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password saat ini tidak sesuai.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }
}
