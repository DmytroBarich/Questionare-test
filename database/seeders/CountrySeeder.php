<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::updateOrCreate(
            ['name' => 'Ukraine']
        );
        Country::updateOrCreate(
            ['name' => 'USA']
        );
        Country::updateOrCreate(
            ['name' => 'France']
        );
    }
}
