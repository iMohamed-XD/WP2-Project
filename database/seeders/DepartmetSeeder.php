<?php

namespace Database\Seeders;

use App\Models\department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = ['trainers', 'members', 'branches', 'warehouses', 'classes'];

        foreach ($departments as $department) {
            department::firstOrCreate(['department' => $department]);
        }
    }
}
