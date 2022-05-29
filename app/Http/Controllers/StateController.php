<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StateIndex;
use App\Http\Resources\StateCollection;
use App\Models\State;
use Illuminate\Support\Str;

class StateController extends Controller
{
    public function index(StateIndex $request): StateCollection
    {
        $search = $request->validated()['search'] ?? null;
        return new StateCollection(
            State::whereRaw('LOWER(name) like (?)', ['%' . Str::lower($search) . '%'])->paginate()
        );
    }
}
