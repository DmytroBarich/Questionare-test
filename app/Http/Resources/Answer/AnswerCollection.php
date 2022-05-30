<?php

declare(strict_types=1);

namespace App\Http\Resources\Answer;

use App\Models\Answer;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AnswerCollection extends ResourceCollection
{
    public $collection = Answer::class;
}
