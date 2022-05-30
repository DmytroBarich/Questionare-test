<?php

declare(strict_types=1);

namespace App\Http\Resources\Question;

use App\Models\Question;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionCollection extends ResourceCollection
{
    public $collection = Question::class;
}
