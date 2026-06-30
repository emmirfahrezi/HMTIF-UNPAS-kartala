<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\ResponseResource;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct(
        private LoginService $loginService,
        private LogoutService $logoutService,
    ) {}

    // -----------------------------------------------------------------------
    // Web (Blade)
    // -----------------------------------------------------------------------

    /** Tampilkan form login (GET /login). */
    public function showLoginForm(): View
    {
        return view('pages.login');
    }

    /** Proses login via form (POST /login). */
    public function loginWeb(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        try {
            $this->loginService->execute($credentials);
        } catch (AuthenticationException $e) {
            return back()->withInput()->withErrors(['email' => $e->getMessage()]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    /** Proses logout via form (POST /logout). */
    public function logoutWeb(Request $request): RedirectResponse
    {
        $this->logoutService->logout($request);

        return redirect()->route('login');
    }

    // -----------------------------------------------------------------------
    // API (JSON)
    // -----------------------------------------------------------------------

    /** Login via API — mengembalikan token. */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        try {
            $result = $this->loginService->execute($credentials);
        } catch (AuthenticationException $e) {
            return ResponseResource::error($e->getMessage(), 401);
        }

        return ResponseResource::success($result, 'Login berhasil');
    }

    /** Logout via API. */
    public function logout(Request $request): JsonResponse
    {
        $this->logoutService->logout($request);

        return ResponseResource::success(null, 'Logout berhasil');
    }
}
