<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    /** Jumlah maksimal percobaan gagal sebelum akun dikunci. */
    private const MAX_ATTEMPTS = 3;

    /** Lama penguncian akun dalam menit. */
    private const LOCKOUT_MINUTES = 15;

    public function execute(#[\SensitiveParameter] array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->isLocked()) {
            $minutes = now()->diffInMinutes($user->locked_until, false);
            throw new AuthenticationException(
                "Akun terkunci karena terlalu banyak percobaan gagal. Coba lagi dalam {$minutes} menit."
            );
        }

        if (! Auth::attempt($credentials)) {
            if ($user) {
                $this->registerFailedAttempt($user);
            }
            throw new AuthenticationException('Email atau password salah.');
        }

        $user = Auth::user();
        if ($user->failed_login_attempts > 0 || $user->locked_until !== null) {
            $user->forceFill(['failed_login_attempts' => 0, 'locked_until' => null])->save();
        }

        return ['user' => $user];
    }

    private function registerFailedAttempt(User $user): void
    {
        $attempts = $user->failed_login_attempts + 1;

        $user->forceFill([
            'failed_login_attempts' => $attempts,
            'locked_until'          => $attempts >= self::MAX_ATTEMPTS
                ? now()->addMinutes(self::LOCKOUT_MINUTES)
                : $user->locked_until,
        ])->save();
    }
}
