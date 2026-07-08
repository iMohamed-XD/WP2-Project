<?php

namespace Database\Seeders;

use App\Models\TrainerStatus;
use Illuminate\Database\Seeder;

class TrainerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['Active', 'On Leave', 'Loaned', 'Ended Contract'];

        foreach ($statuses as $status) {
            TrainerStatus::create(['status' => $status]);
        }
    }
}
