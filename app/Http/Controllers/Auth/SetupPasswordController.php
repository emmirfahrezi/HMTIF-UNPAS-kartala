<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SetupPasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SetupPasswordController extends Controller
{
    /**
     * Tampilkan form pengaturan password pertama kali (dari link email).
     */
    public function show(string $token): View
    {
        return view('mail.setup-password-form', ['token' => $token]);
    }

    /**
     * Proses pengaturan password baru dari form.
     */
    public function store(SetupPasswordRequest $request): RedirectResponse
    {
        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        $expired = ! $record
            || ! Hash::check($request->token, $record->token)
            || now()->diffInMinutes($record->created_at) > 60;

        if ($expired) {
            return back()->withErrors(['token' => 'Tautan tidak valid atau sudah kadaluarsa.']);
        }

        $user = User::where('email', $request->email)->first();
        if (! $user) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('setup-password.success', ['email' => $request->email]);
    }

    /**
     * Tampilkan halaman sukses setelah password berhasil diatur.
     */
    public function success(): View
    {
        return view('mail.setup-password-success', ['email' => request('email')]);
    }
}
