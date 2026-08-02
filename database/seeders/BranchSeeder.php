<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Country;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $syria = Country::where('name', 'Syria')->first();

        $branches = [
            ['name' => 'Damascus Main Branch', 'location' => 'Mazzeh - Damascus', 'phone' => '011-1234567', 'governorate' => 'Damascus', 'capacity' => 100, 'country_id' => $syria->id],
            ['name' => 'Aleppo Main Branch', 'location' => 'Al-Nil Street - Aleppo', 'phone' => '021-1234567', 'governorate' => 'Aleppo', 'capacity' => 100, 'country_id' => $syria->id],
            ['name' => 'Homs Main Branch', 'location' => 'Al-Andalus - Homs', 'phone' => '031-1234567', 'governorate' => 'Homs', 'capacity' => 100, 'country_id' => $syria->id],
            ['name' => 'Hama Main Branch', 'location' => 'Baghdad Street - Hama', 'phone' => '033-1234567', 'governorate' => 'Hama', 'capacity' => 100, 'country_id' => $syria->id],
            ['name' => 'Latakia Main Branch', 'location' => 'Al-Thawra - Latakia', 'phone' => '041-1234567', 'governorate' => 'Latakia', 'capacity' => 100, 'country_id' => $syria->id],
            ['name' => 'Tartus Main Branch', 'location' => 'Al-Maghreb - Tartus', 'phone' => '043-1234567', 'governorate' => 'Tartus', 'capacity' => 100, 'country_id' => $syria->id],
            ['name' => 'Suwayda Main Branch', 'location' => 'Al-Jalaa - Suwayda', 'phone' => '016-1234567', 'governorate' => 'As-Suwayda', 'capacity' => 100, 'country_id' => $syria->id],
            ['name' => 'Daraa Main Branch', 'location' => 'Al-Thalatheen - Daraa', 'phone' => '015-1234567', 'governorate' => 'Daraa', 'capacity' => 100, 'country_id' => $syria->id],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}