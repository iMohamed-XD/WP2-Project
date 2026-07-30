<?php

namespace Database\Seeders;

use App\Models\Trainer;
use App\Models\Workout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SportsTypeSeeder::class,
            TrainerStatusSeeder::class,
            RoleSeeder::class,
            DepartmetSeeder::class,
            UserSeeder::class,
            TrainerSeeder::class,      
            WorkoutLevelSeeder::class,
            WorkoutSeeder::class,
            TrainerWorkoutSeeder::class,
        ]);
    }
}
