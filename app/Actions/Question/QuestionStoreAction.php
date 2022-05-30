<?php

declare(strict_types=1);

namespace App\Actions\Question;

use App\Exceptions\BaseException;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionStoreAction
{
    /**
     * @throws BaseException
     */
    public function handle(array $data): ?Question
    {
        try {
            DB::beginTransaction();

            $question = new Question($data);
            $question->save();

            DB::commit();

            return $question;
        } catch (BaseException $exception) {
            DB::rollBack();
            throw new BaseException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
