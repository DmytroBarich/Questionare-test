<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\City;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CityCollection extends ResourceCollection
{
    public $collection = City::class;
}
