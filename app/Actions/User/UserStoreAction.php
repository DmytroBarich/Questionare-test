<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\BaseException;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserStoreAction
{
    /**
     * @throws BaseException
     */
    public function handle(array $data, Role $role): ?User
    {
        try {
            DB::beginTransaction();
            $user = new User($data);
            $user->role()->associate($role);
            $user->save();
            DB::commit();

            return $user;
        } catch (BaseException $exception) {
            DB::rollBack();
            throw new BaseException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
