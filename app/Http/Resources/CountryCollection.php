<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Country;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryCollection extends ResourceCollection
{
    public $collection = Country::class;
}
