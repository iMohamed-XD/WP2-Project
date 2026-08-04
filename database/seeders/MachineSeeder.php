<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Machine;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $machines = [
            ['name' => 'Treadmill'],
            ['name' => 'Elliptical Trainer'],
            ['name' => 'Stationary Bike'],
            ['name' => 'Rowing Machine'],
            ['name' => 'Stair Climber'],
            ['name' => 'Leg Press Machine'],
            ['name' => 'Chest Press Machine'],
            ['name' => 'Lat Pulldown Machine'],
            ['name' => 'Cable Crossover Machine'],
            ['name' => 'Smith Machine'],
        ];

        foreach ($machines as $machine) {
            Machine::create($machine);
        }
    }
}
