<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkoutLevel;

class WorkoutLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['beginner', 'intermediate', 'advanced'] as $level) {
            WorkoutLevel::firstOrCreate(['level' => $level]);
        }
    }
}
