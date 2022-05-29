<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::updateOrCreate([
            'name' => 'California',
            'country_id' => Country::where('name', 'USA')->first()->id
        ]);
    }
}