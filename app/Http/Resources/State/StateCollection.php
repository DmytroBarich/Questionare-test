<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\State;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StateCollection extends ResourceCollection
{
    public $collection = State::class;
}
