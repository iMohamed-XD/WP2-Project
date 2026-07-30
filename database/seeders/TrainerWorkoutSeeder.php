<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trainer;
use App\Models\Workout;

class TrainerWorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trainer::all()->each(function (Trainer $trainer) {
            $matchingWorkoutIds = Workout::where('sportstype_id', $trainer->sports_type_id)
                ->pluck('id');

            if ($matchingWorkoutIds->isEmpty()) {
                return; // no workouts exist for this trainer's sport yet
            }

            $count = min(random_int(1, 4), $matchingWorkoutIds->count());

            $trainer->workouts()->attach(
                $matchingWorkoutIds->random($count)
            );
        });
    }
}
