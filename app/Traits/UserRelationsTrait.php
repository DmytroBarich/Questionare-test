<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\City;
use App\Models\Country;
use App\Models\Role;
use App\Models\State;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserRelationsTrait
{
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
