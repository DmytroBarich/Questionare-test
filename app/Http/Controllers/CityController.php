<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CityIndex;
use App\Http\Resources\CityCollection;
use App\Models\City;
use Illuminate\Support\Str;

class CityController extends Controller
{
    public function index(CityIndex $request): CityCollection
    {
        $search = $request->validated()['search'] ?? null;
        return new CityCollection(
            City::whereRaw('LOWER(name) like (?)', ['%' . Str::lower($search) . '%'])->paginate()
        );
    }
}
