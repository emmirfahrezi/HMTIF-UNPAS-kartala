<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
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
     * Perbarui data profil (email, bio, instagram, linkedin, foto).
     *
     * Foto disimpan di users.photo terlebih dahulu.
     * Jika user punya relasi staff, foto staff ikut disinkronkan.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email'      => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'bio'        => 'nullable|string|max:500',
            'instagram'  => 'nullable|string|max:255',
            'linkedin'   => 'nullable|string|max:1024',
            'photo'      => 'nullable|string|max:1024',
            'photo_file' => 'nullable|file|image|max:2048',
        ]);

        $user      = auth()->user();
        $photoPath = null;

        if ($request->hasFile('photo_file')) {
            // Hapus foto lama user jika bukan URL eksternal
            if ($user->photo && ! str_starts_with($user->photo, 'http')) {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $request->file('photo_file')->store('profile/photos', 'public');
        } elseif (! empty($validated['photo'])) {
            $photoPath = $validated['photo'];
        }

        $userUpdate = ['email' => $validated['email']];
        if ($photoPath !== null) {
            $userUpdate['photo'] = $photoPath;
        }

        $user->update($userUpdate);

        $staff = $user->staff;

        if ($staff) {
            $staffData = [
                'bio'       => $validated['bio']       ?? $staff->bio,
                'instagram' => $validated['instagram'] ?? $staff->instagram,
                'linkedin'  => $validated['linkedin']  ?? $staff->linkedin,
            ];

            // Sinkronkan foto ke staff jika ada foto baru
            if ($photoPath !== null) {
                // Hapus foto lama staff dari storage lokal jika berbeda dengan foto user baru
                if ($staff->photo && $staff->photo !== $photoPath && ! str_starts_with($staff->photo, 'http')) {
                    Storage::disk('public')->delete($staff->photo);
                }
                $staffData['photo'] = $photoPath;
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
            'password'              => ['required', 'confirmed', Password::min(12)->mixedCase()->numbers()->symbols()],
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
