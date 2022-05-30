<?php

declare(strict_types=1);

namespace App\Http\Requests\Answer;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;

class AnswerStore extends FormRequest
{
    public function rules(): array
    {
        return $this->makeRulesArray();
    }

    public function makeRulesArray(): array
    {
        //q_id => answer
        $data = [
            'answers' => [
                'array',
                'required'
            ]
        ];
        foreach (Question::all() as $question) {
            $answer = [
                $question->required ? 'required' : 'sometimes',
                $question->type,
            ];
            if ($question->min) {
                $answer = array_merge($answer, ['min:' . $question->min]);
            }
            if ($question->max) {
                $answer = array_merge($answer, ['max:' . $question->max]);
            }
            $data = array_merge($data, ['answers.' . $question->id => $answer]);
        }

        return $data;
    }
}
