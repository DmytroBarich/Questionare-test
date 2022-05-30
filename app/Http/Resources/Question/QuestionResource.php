<?php

declare(strict_types=1);

namespace App\Http\Resources\Question;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'required' => $this->required,
            'type' => $this->type,
            'max' => $this->max,
            'min' => $this->min
        ];
    }
}
