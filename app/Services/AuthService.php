<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\UserStoreAction;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data, string $tokenName = 'default')
    {
        $userService = app()->make(UserStoreAction::class);
        $user = $userService->handle($data, Role::find(Role::USER_ROLE_ID));

        return $user->createToken($tokenName)->plainTextToken;
    }

    public function login(array $data, string $tokenName = 'default'): string
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return '';
        }

        return $user->createToken($tokenName, ['user:'.$user->role->slug])->plainTextToken;
    }

    public function logout(User $user): bool
    {
        return $user->currentAccessToken()->delete();
    }
}
