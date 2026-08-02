<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            ['name' => 'Damascus Main Branch', 'location' => 'Mazzeh - Damascus', 'phone' => '011-1234567', 'governorate' => 'Damascus'],
            ['name' => 'Aleppo Main Branch', 'location' => 'Al-Nil Street - Aleppo', 'phone' => '021-1234567', 'governorate' => 'Aleppo'],
            ['name' => 'Homs Main Branch', 'location' => 'Al-Andalus - Homs', 'phone' => '031-1234567', 'governorate' => 'Homs'],
            ['name' => 'Hama Main Branch', 'location' => 'Baghdad Street - Hama', 'phone' => '033-1234567', 'governorate' => 'Hama'],
            ['name' => 'Latakia Main Branch', 'location' => 'Al-Thawra - Latakia', 'phone' => '041-1234567', 'governorate' => 'Latakia'],
            ['name' => 'Tartus Main Branch', 'location' => 'Al-Maghreb - Tartus', 'phone' => '043-1234567', 'governorate' => 'Tartus'],
            ['name' => 'Suwayda Main Branch', 'location' => 'Al-Jalaa - Suwayda', 'phone' => '016-1234567', 'governorate' => 'As-Suwayda'],
            ['name' => 'Daraa Main Branch', 'location' => 'Al-Thalatheen - Daraa', 'phone' => '015-1234567', 'governorate' => 'Daraa'],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}