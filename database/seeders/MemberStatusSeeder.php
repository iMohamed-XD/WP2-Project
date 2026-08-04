<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MemberStatus;

class MemberStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['Active', 'Ended', 'Suspended'];

        foreach ($statuses as $status) {
            MemberStatus::create(['name' => $status]);
        }
    }
}
