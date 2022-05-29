<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CountryIndex;
use App\Http\Resources\CountryCollection;
use App\Models\Country;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    public function index(CountryIndex $request): CountryCollection
    {
        $search = $request->validated()['search'] ?? null;
        return new CountryCollection(
            Country::whereRaw('LOWER(name) like (?)', ['%' . Str::lower($search) . '%'])->paginate()
        );
    }
}
