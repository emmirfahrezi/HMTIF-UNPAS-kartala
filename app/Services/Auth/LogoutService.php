<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LogoutService
{
    public function execute(User $user): void
    {
        // Delete Sanctum token if exists (for API auth)
        if ($user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }

        // Logout from session (for web auth)
        Auth::logout();
    }
}
