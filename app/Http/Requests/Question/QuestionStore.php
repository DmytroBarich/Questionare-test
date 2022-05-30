<?php

declare(strict_types=1);

namespace App\Http\Requests\Question;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionStore extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'unique:questions,title',
                'min:3'
            ],
            'slug' => [
                'sometimes',
                'alpha_dash',
                'unique:questions,slug',
                'min:3'
            ],
            'description' => [
                'required',
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
