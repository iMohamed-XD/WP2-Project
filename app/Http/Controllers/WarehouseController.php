<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Country;
use App\Models\Branch;  // <-- تأكد من وجود هذا السطر
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class WarehouseController extends Controller
{

public function index(Request $request)
{
    $warehouses = Warehouse::with('country' , 'branches')

        ->when($request->search, function ($query) use ($request) {

            $query->where('name', 'like', '%' . $request->search . '%');

        })

         ->when($request->governorate, function ($query) use ($request) {
            $query->where('governorate', $request->governorate);
        }) 

        ->when($request->capacity, function ($query) use ($request) {
            $query->where('capacity', '>=', $request->capacity);
        })

        ->when($request->country_id, function ($query) use ($request) {

            $query->where('country_id', $request->country_id);

        })

        ->paginate(10);


    $countries = Country::all();

    $branches = Branch::all();

    $totalWarehouses = Warehouse::count();

    $totalCountries = Country::count();

    $totalBrochures = Warehouse::whereNotNull('brochure')->count();

    $governorates = [
            'Damascus', 'Rural Damascus', 'Aleppo', 'Homs', 'Hama',
            'Latakia', 'Tartus', 'As-Suwayda', 'Daraa', 'Al-Hasakah',
            'Deir ez-Zor', 'Raqqa', 'Idlib', 'Quneitra'
        ];

        return view('Warehouse.warehouses.index', compact(
            'warehouses',
            'countries',
            'branches',
            'governorates',
            'totalWarehouses',
            'totalCountries',
            'totalBrochures'
        ));

   
}

    public function create()
    {
        $countries = Country::all();
        $branches = Branch::all();
        $governorates = [
            'Damascus', 'Rural Damascus', 'Aleppo', 'Homs', 'Hama',
            'Latakia', 'Tartus', 'As-Suwayda', 'Daraa', 'Al-Hasakah',
            'Deir ez-Zor', 'Raqqa', 'Idlib', 'Quneitra'
        ];

        return view('Warehouse.warehouses.create', compact('countries', 'branches', 'governorates'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:warehouses,name',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:20',
            'country_id' => 'required|exists:countries,id',
            'governorate' => 'required|string|in:Damascus,Rural Damascus,Aleppo,Homs,Hama,Latakia,Tartus,As-Suwayda,Daraa,Al-Hasakah,Deir ez-Zor,Raqqa,Idlib,Quneitra',
            'capacity' => 'nullable|integer|min:1',
            'brochure' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB
            'branches' => 'nullable|array',
            'branches.*' => 'exists:branches,id',
        ]);

        if ($request->hasFile('brochure')) {
            $file = $request->file('brochure');
            $filename = time() . '_' . $file->getClientOriginalName();
            $validated['brochure'] = $file->storeAs('brochures', $filename, 'public');
        }

        $warehouse = Warehouse::create($validated);

        if ($request->has('branches')) {
            $warehouse->branches()->sync($request->branches);
        }

        return redirect()
            ->route('warehouses.index')
            ->with('success', 'Warehouse added successfully.');
    }

    public function edit(Warehouse $warehouse)
    {
        $countries = Country::all();
        $branches = Branch::all();
        $governorates = [
            'Damascus', 'Rural Damascus', 'Aleppo', 'Homs', 'Hama',
            'Latakia', 'Tartus', 'As-Suwayda', 'Daraa', 'Al-Hasakah',
            'Deir ez-Zor', 'Raqqa', 'Idlib', 'Quneitra'
        ];

        return view('Warehouse.warehouses.edit', compact('warehouse', 'countries', 'branches', 'governorates'));
    }




public function update(Request $request, Warehouse $warehouse)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255', Rule::unique('warehouses')->ignore($warehouse->id)],
        'location' => 'required|string|max:255',
        'phone' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:20',
        'country_id' => 'required|exists:countries,id',
        'governorate' => 'required|string|in:Damascus,Rural Damascus,Aleppo,Homs,Hama,Latakia,Tartus,As-Suwayda,Daraa,Al-Hasakah,Deir ez-Zor,Raqqa,Idlib,Quneitra',
        'capacity' => 'nullable|integer|min:1',
        'brochure' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'branches' => 'nullable|array',
        'branches.*' => 'exists:branches,id',
    ]);

    if ($request->hasFile('brochure')) {
        if ($warehouse->brochure) {
            Storage::disk('public')->delete($warehouse->brochure);
        }

        $file = $request->file('brochure');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('brochures', $filename, 'public');
        
        // سجل المسار للتأكد
        Log::info('File saved at: ' . $path);
        
        $validated['brochure'] = $path;
    }

    $warehouse->update($validated);

    if ($request->has('branches')) {
        $warehouse->branches()->sync($request->branches);
    } else {
        $warehouse->branches()->detach();
    }

    return redirect()
        ->route('warehouses.index')
        ->with('success', 'Warehouse updated successfully.');
}

        public function downloadBrochure(Warehouse $warehouse)
        {
            if (!$warehouse->brochure) {
                abort(404, 'Brochure not found.');
            }

            return response()->download(
                storage_path('app/public/' . $warehouse->brochure)
            );
        }

public function destroy(Warehouse $warehouse)
{
    if ($warehouse->brochure) {

        Storage::disk('public')->delete($warehouse->brochure);

    }


    $warehouse->delete();


    return redirect('/warehouses')
        ->with('success', 'Warehouse deleted successfully.');
}

} 