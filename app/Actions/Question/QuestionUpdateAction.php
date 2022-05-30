<?php

declare(strict_types=1);

namespace App\Actions\Question;

use App\Exceptions\BaseException;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionUpdateAction
{
    /**
     * @throws BaseException
     */
    public function handle(array $data, Question $question): ?Question
    {
        try {
            DB::beginTransaction();

            $question->fill($data);
            $question->save();

            DB::commit();

            return $question;
        } catch (BaseException $exception) {
            DB::rollBack();
            throw new BaseException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
