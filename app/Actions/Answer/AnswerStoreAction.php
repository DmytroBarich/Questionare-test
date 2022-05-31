<?php

declare(strict_types=1);

namespace App\Actions\Answer;

use App\Exceptions\BaseException;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnswerStoreAction
{
    /**
     * @throws BaseException
     */
    public function handle(array $data): ?Answer
    {
        try {
            DB::beginTransaction();

            $answer = new Answer($data);
            $answer->user()->associate(Auth::user());
            $answer->save();

            DB::commit();

            return $answer;
        } catch (BaseException $exception) {
            DB::rollBack();
            throw new BaseException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
