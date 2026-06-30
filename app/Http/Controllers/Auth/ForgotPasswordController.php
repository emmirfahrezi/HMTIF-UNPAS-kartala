<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function show(): View
    {
        return view('auth.forgot-password');
    }

    public function send(ForgotPasswordRequest $request): RedirectResponse
    {
        // Selalu kirim pesan generik agar tidak bocorkan apakah email terdaftar
        Password::sendResetLink(['email' => $request->validated('email')]);

        return back()->with('status', 'Jika email terdaftar, link reset password akan dikirim ke inbox Anda.');
    }
}
