<?php

namespace Database\Seeders;

use App\Models\SportsType;
use Illuminate\Database\Seeder;

class SportsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Football', 'Swimming', 'Bodybuilding', 'Yoga', 'Karate'];

        foreach ($types as $type) {
            SportsType::create(['type' => $type]);
        }
    }
}
