<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Country;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;

class WarehouseDashboardController extends Controller
{
    public function index()
    {
        $totalWarehouses = Warehouse::count();
        $totalCountries = Country::count();
        $totalBranches = Branch::count();
        $totalBrochures = Warehouse::whereNotNull('brochure')->count();
        
        // المستودعات حسب المحافظة
        $warehousesByGovernorate = Warehouse::select([
                'governorate',
                DB::raw('count(*) as total')
            ])
            ->groupBy('governorate')
            ->get();
        $warehousesByCapacity = Warehouse::select([
            DB::raw("CASE 
                WHEN capacity IS NULL THEN 'غير محدد'
                WHEN capacity < 100 THEN 'صغير (أقل من 100)'
                WHEN capacity < 300 THEN 'متوسط (100-300)'
                ELSE 'كبير (أكثر من 300)'
            END as capacity_level"),
            DB::raw('count(*) as total')
        ])
        ->groupBy('capacity_level')
        ->get();
        
        // آخر 5 مستودعات مضافة
        $recentWarehouses = Warehouse::with('country', 'branches')
            ->latest()
            ->limit(5)
            ->get();

        return view('warehouse-dashboard.index', compact(
            'totalWarehouses',
            'totalCountries',
            'totalBranches',
            'totalBrochures',
            'warehousesByGovernorate',
            'warehousesByCapacity',
            'recentWarehouses'
        ));
    }
}