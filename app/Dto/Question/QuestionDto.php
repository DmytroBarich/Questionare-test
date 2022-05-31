<?php

declare(strict_types=1);

namespace App\Dto\Question;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Carbon\Carbon;

class QuestionDto
{
    public string $type;
    public bool $required;
    public ?string $description;
    public ?string $title;
    public ?string $slug;
    public ?int $min;
    public ?int $max;

    public function __construct(
        string $type,
        bool $required,
        string $description = null,
        string $title = null,
        string $slug = null,
        int $min = null,
        int $max = null,
    ) {
        $this->type = $type;
        $this->required = $required;
        $this->description = $description;
        $this->title = $title;
        $this->slug = $slug;
        $this->min = $min;
        $this->max = $max;
    }

    public function toArrayForStore(): array
    {
        return [
            'type' => $this->type,
            'required' => $this->required,
            'description' => $this->description,
            'title' => $this->title,
            'slug' => $this->slug,
            'min' => $this->min,
            'max' => $this->max,
        ];
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['type'],
            $data['required'],
            $data['description'],
            $data['title'],
            $data['slug'],
            $data['min'],
            $data['max'],
        );
    }
}
