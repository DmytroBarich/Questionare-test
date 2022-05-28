<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, AuthService $authService): JsonResponse
    {
        return response()->json(
            [
                'success' => $authService->register($request->validated(), $request->header('user-agent'))
            ], Response::HTTP_OK);
    }

    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        $response = $authService->login($request->validated(), $request->header('user-agent'));

        if (empty($response)) {
            return response()->json(['error' => 'Login invalid'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['success' => $response], Response::HTTP_OK);
    }

    public function logout(Request $request, AuthService $authService): JsonResponse
    {
        return response()->json([
            'success' => $authService->logout($request->user())
        ], Response::HTTP_OK);
    }
}
