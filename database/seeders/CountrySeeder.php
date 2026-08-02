<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            'Syria',
            'Egypt',
            'Jordan',
            'Lebanon',
            'Saudi Arabia',
            'UAE',
            'Turkey',
            'Iraq',
        ];

        foreach ($countries as $country) {
            Country::create(['name' => $country]);
        }
    }
}