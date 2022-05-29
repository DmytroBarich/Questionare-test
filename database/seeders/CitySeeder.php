<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::updateOrCreate(
            ['name' => 'Kiev', 'country_id' => Country::where('name', 'Ukraine')->first()->id]
        );
        City::updateOrCreate(
            [
                'name' => 'Los Angeles',
                'state_id' => State::whereHas('country', function ($q) {
                    $q->where('name', 'USA');
                })->first()->id,
                'country_id' => Country::where('name', 'USA')->first()->id
            ]
        );
        City::updateOrCreate(
            ['name' => 'Paris', 'country_id' => Country::where('name', 'France')->first()->id]
        );
    }
}
