<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Dto\User\UserStoreDto;
use App\Exceptions\BaseException;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserUpdateAction
{
    /**
     * @throws BaseException
     */
    public function handle(UserStoreDto $dto, User $user): ?User
    {
        try {
            DB::beginTransaction();
            $user = $user->fill($dto->toArrayForStore());
            $user->country()->associate($dto->country);
            $user->state()->associate($dto->state);
            $user->city()->associate($dto->city);
            $user->save();
            DB::commit();

            return $user;
        } catch (BaseException $exception) {
            DB::rollBack();
            throw new BaseException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
