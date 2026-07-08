<?php

namespace Database\Factories;

use App\Models\Trainer;
use App\Models\SportsType;
use App\Models\TrainerStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trainer>
 */
class TrainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                    'firstname' => $this->faker->firstName(),
                    'lastname' => $this->faker->lastName(),
                    'fathername' => $this->faker->firstNameMale(), // see pitfall #1 below
                    'phone' => '09' . $this->faker->numerify('########'),
                    'address' => $this->faker->optional()->address(),
                    'image' => null, // avoid faking file paths that don't exist on disk
                    'gender' => $this->faker->randomElement(['Male', 'Female']),
                    'sports_type_id' => SportsType::inRandomOrder()->value('id'),
                    'trainer_status_id' => TrainerStatus::inRandomOrder()->value('id'),
                    'birthplace' => $this->faker->optional()->city(),
                    'birthdate' => $this->faker->dateTimeBetween('-59 years', '-19 years'),
                    'years_of_experience' => $this->faker->numberBetween(2, 50),
                    'SSN' => $this->faker->unique()->numerify('###########'), // exactly 11 digits
                    'email' => $this->faker->boolean(70)
                        ? $this->faker->unique()->safeEmail()
                        : null,
                    'hiring_date' => $this->faker->dateTimeBetween('-10 years', 'now'),
                    'certification' => $this->faker->randomElement([
                        'level_1', 'level_2', 'level_3', 'level_4',
                    ]),
                ];
    }
}
