<?php

declare(strict_types=1);

namespace App\Actions\Question;

use App\Exceptions\BaseException;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionDeleteAction
{
    /**
     * @throws BaseException
     */
    public function handle(Question $question): ?bool
    {
        try {
            DB::beginTransaction();

            $question->delete();

            DB::commit();

            return true;
        } catch (BaseException $exception) {
            DB::rollBack();
            throw new BaseException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
