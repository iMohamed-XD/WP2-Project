<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SportsType;
use App\Models\Workout;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private const WORKOUTS_BY_TYPE = [
        'Football' => [
            'Football Agility & Speed Drills',
            'Football Endurance Conditioning',
            'Football Tactical Fitness',
            'Football Strength & Power',
        ],
        'Swimming' => [
            'Freestyle Technique Training',
            'Swimming Endurance Program',
            'Aqua Interval Training',
            'Swim Sprint Conditioning',
        ],
        'Bodybuilding' => [
            'Hypertrophy Training Block',
            'Powerlifting Fundamentals',
            'Muscle Building Circuit',
            'Advanced Split Training',
        ],
        'Yoga' => [
            'Vinyasa Flow',
            'Restorative Yoga',
            'Power Yoga Conditioning',
            'Yoga for Flexibility',
        ],
        'Karate' => [
            'Karate Kata Practice',
            'Karate Sparring Conditioning',
            'Karate Belt Preparation',
            'Karate Strength & Discipline',
        ],
    ];
    public function run(): void
    {
        SportsType::all()->each(function (SportsType $sportsType) {
            Workout::factory()
                ->count(3)
                ->create(['sportstype_id' => $sportsType->id]);
        });
    }
}
