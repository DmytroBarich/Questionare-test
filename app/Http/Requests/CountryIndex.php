<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryIndex extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => [
                'sometimes',
                'min:3'
            ]
        ];
    }
}
