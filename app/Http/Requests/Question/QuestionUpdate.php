<?php

declare(strict_types=1);

namespace App\Http\Requests\Question;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionUpdate extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'sometimes',
                Rule::unique('questions', 'title')->ignore($this->question),
                'min:3'
            ],
            'description' => [
                'sometimes',
                'min:3'
            ],
            'type' => [
                'required',
                Rule::in(Question::TYPES),
            ],
            'required' => [
                'required',
                'boolean',
            ],
            'min' => [
                'sometimes',
                'integer'
            ],
            'max' => [
                'sometimes',
                'integer',
                'gte:min'
            ]
        ];
    }
}
