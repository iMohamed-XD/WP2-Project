<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\Country;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWarehouses = Warehouse::count();

        $totalCountries = Country::count();

        $totalBrochures = Warehouse::whereNotNull('brochure')->count();


        $latestWarehouses = Warehouse::with('country')
            ->latest()
            ->take(5)
            ->get();


        return view('Warehouse.dashboard.index', compact(

            'totalWarehouses',

            'totalCountries',

            'totalBrochures',

            'latestWarehouses'

        ));
    }
}