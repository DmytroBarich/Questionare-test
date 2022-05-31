<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\User\UserStoreAction;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, UserStoreAction $action): JsonResponse
    {
        $user = $action->handle($request->validated(), Role::find(Role::USER_ROLE_ID));
        return response()->json(
            [
                'success' => $user->createToken($request->header('user-agent'))->plainTextToken
            ],
            Response::HTTP_OK
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $response = Hash::check($request->password, User::where('email', $request->email)->first()->password);

        if ($response) {
            return response()->json(['success' => $response], Response::HTTP_OK);
        }
        return response()->json(['error' => 'Login invalid'], Response::HTTP_BAD_REQUEST);
    }

    public function logout(Request $request): JsonResponse
    {
        return response()->json([
            'success' => $request->user->currentAccessToken()->delete()
        ], Response::HTTP_OK);
    }
}
