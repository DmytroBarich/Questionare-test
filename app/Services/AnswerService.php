<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\User\UserUpdateAction;
use App\Dto\User\UserStoreDto;
use App\Exceptions\BaseException;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnswerService
{
    public function storeAnswer(array $data): Answer
    {
        try {
            DB::beginTransaction();

            $answer = new Answer(['answer' => $this->generateAnswer($data)]);
            $answer->user()->associate(Auth::user());
            $answer->save();

            $userDto = UserStoreDto::fromArray($this->generateAnswerForUser($data));
            $userUpdateAction = app()->make(UserUpdateAction::class);
            $userUpdateAction->handle($userDto, Auth::user());

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
