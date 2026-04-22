<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(
        private LoginService $loginService,
        private LogoutService $logoutService,
    ) {}

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            $result = $this->loginService->execute($credentials);
        } catch (AuthenticationException $e) {
            return ResponseResource::error($e->getMessage(), 401);
        }

        return ResponseResource::success($result, 'Login berhasil');
    }

    public function loginWeb(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            $this->loginService->execute($credentials);
        } catch (AuthenticationException $e) {
            return back()->withInput()->withErrors(['email' => $e->getMessage()]);
        }

        return redirect()->route('home');
    }

    public function logout(Request $request): JsonResponse
    {
        $this->logoutService->execute($request->user());

        return ResponseResource::success(null, 'Logout berhasil');
    }
}
