<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\ResponseResource;
use App\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __construct(
        private RegisterService $registerService,
    ) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->registerService->execute($request->validated());

        return ResponseResource::success($result, 'Registrasi berhasil', 201);
    }
}
