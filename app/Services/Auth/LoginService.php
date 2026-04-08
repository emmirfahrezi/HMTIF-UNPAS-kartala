<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function execute(array $credentials): array
    {
        if (! Auth::attempt($credentials)) {
            throw new AuthenticationException('Email atau password salah.');
        }

        $user  = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }
}
