<?php

namespace Database\Factories;

use App\Models\Workout;
use App\Models\WorkoutLevel;
use App\Models\SportsType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Workout>
 */
class WorkoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->words(3, true)) . ' Workout',
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 15, 150),
            'duration' => $this->faker->randomElement([30, 45, 60, 75, 90]),
            'sportstype_id' => null, // set by caller
            'workoutlevel_id' => WorkoutLevel::inRandomOrder()->value('id'),
            'image' => null,
            'start_date' => $this->faker->dateTimeBetween('now', '+2 months'),
        ];
    }
}
