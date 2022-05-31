<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\Answer\AnswerStoreAction;
use App\Actions\User\UserUpdateAction;
use App\Dto\User\QuestionDto;
use App\Exceptions\BaseException;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnswerService
{
    private UserUpdateAction $userAction;
    private AnswerStoreAction $answerAction;

    public function __construct(UserUpdateAction $userAction, AnswerStoreAction $answerAction)
    {
        $this->userAction = $userAction;
        $this->answerAction = $answerAction;
    }

    public function storeAnswer(array $data): Answer
    {
        try {
            DB::beginTransaction();
            $answer = $this->answerAction->handle(['answer' => $this->generateAnswer($data)]);

            $userDto = QuestionDto::fromArray($this->generateAnswerForUser($data));
            $this->userAction->handle($userDto, Auth::user());

            DB::commit();

            return $answer;
        } catch (BaseException $exception) {
            DB::rollBack();
            throw new BaseException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    private function generateAnswer(array $data): array
    {
        $questionsArray = Question::all()->keyBy('id')->toArray();

        $result = [];

        foreach ($data['answers'] as $key => $value) {
            $result[$questionsArray[$key]['description']] = $value;
        }

        return $result;
    }

    private function generateAnswerForUser(array $data): array
    {
        $questionsArray = Question::all()->keyBy('id')->toArray();

        $result = [];

        foreach ($data['answers'] as $key => $value) {
            $result[$questionsArray[$key]['slug']] = $value;
        }

        return $result;
    }
}
