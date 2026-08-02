<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;
use App\Models\Country;
use App\Models\Branch;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        $syriaId = Country::where('name', 'Syria')->first()->id;

        $warehouses = [
            ['name' => 'Damascus Central Warehouse', 'location' => 'Industrial Area - Damascus', 'phone' => '011-5550001', 'country_id' => $syriaId, 'governorate' => 'Damascus', 'capacity' => 500],
            ['name' => 'Aleppo Central Warehouse', 'location' => 'Industrial Area - Aleppo', 'phone' => '021-5550001', 'country_id' => $syriaId, 'governorate' => 'Aleppo', 'capacity' => 400],
            ['name' => 'Homs Central Warehouse', 'location' => 'Industrial Area - Homs', 'phone' => '031-5550001', 'country_id' => $syriaId, 'governorate' => 'Homs', 'capacity' => 350],
            ['name' => 'Hama Central Warehouse', 'location' => 'Industrial Area - Hama', 'phone' => '033-5550001', 'country_id' => $syriaId, 'governorate' => 'Hama', 'capacity' => 300],
            ['name' => 'Latakia Central Warehouse', 'location' => 'Industrial Area - Latakia', 'phone' => '041-5550001', 'country_id' => $syriaId, 'governorate' => 'Latakia', 'capacity' => 350],
            ['name' => 'Tartus Central Warehouse', 'location' => 'Industrial Area - Tartus', 'phone' => '043-5550001', 'country_id' => $syriaId, 'governorate' => 'Tartus', 'capacity' => 250],
            ['name' => 'Suwayda Central Warehouse', 'location' => 'Industrial Area - Suwayda', 'phone' => '016-5550001', 'country_id' => $syriaId, 'governorate' => 'As-Suwayda', 'capacity' => 150],
            ['name' => 'Daraa Central Warehouse', 'location' => 'Industrial Area - Daraa', 'phone' => '015-5550001', 'country_id' => $syriaId, 'governorate' => 'Daraa', 'capacity' => 150],
        ];

        foreach ($warehouses as $warehouseData) {

            $warehouse = Warehouse::create($warehouseData);

            $branch = Branch::where('governorate', $warehouseData['governorate'])
                            ->first();

            if ($branch) {
                $warehouse->branches()->attach($branch->id);
            }
        }
    }
}