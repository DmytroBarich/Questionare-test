<?php

declare(strict_types=1);

namespace App\Actions\Answer;

use App\Exceptions\BaseException;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class AnswerDeleteAction
{
    /**
     * @throws BaseException
     */
    public function handle(Answer $answer): ?bool
    {
        try {
            DB::beginTransaction();

            $answer->delete();

            DB::commit();

            return true;
        } catch (BaseException $exception) {
            DB::rollBack();
            throw new BaseException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
