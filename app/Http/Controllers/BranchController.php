<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Country;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request)
{
    $query = $request->get('search');
    $branches = Branch::with('country')
        ->when($query, function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('location', 'LIKE', "%{$query}%");
        })
        ->paginate(12);

    return view('branches.branches.index', compact('branches', 'query'));
}

    public function store(Request $request)
    {
        $branch = new Branch();
        $branch->name = $request->name;
        $branch->country_id = $request->country_id;
        $branch->location = $request->location;
        $branch->phone = $request->phone;
        $branch->capacity = $request->capacity;
        if ($request->hasFile('brochure')) {
            $branch->brochure_path = $request->file('brochure')->store('brochures', 'public');
        }
        $branch->save();

        return redirect()->route('branches.index')->with('success', 'تم إضافة الفرع بنجاح');
    }

    public function show(Branch $branch)
    {
        return view('branches.branches.show', compact('branch'));
    }

    public function edit(Branch $branch)
    {
        $countries = Country::all();
        return view('branches.branches.edit', compact('branch', 'countries'));
    }

    public function update(Request $request, Branch $branch)
    {
        $branch->name = $request->name;
        $branch->country_id = $request->country_id;
        $branch->location = $request->location;
        $branch->phone = $request->phone;
        $branch->capacity = $request->capacity;
        if ($request->hasFile('brochure')) {
            $branch->brochure_path = $request->file('brochure')->store('brochures', 'public');
        }
        $branch->save();

        return redirect()->route('branches.index')->with('success', 'تم تحديث الفرع بنجاح');
    }

    public function destroy(Branch $branch)
{
    $branch->delete();
    return redirect()->route('branches.index')->with('success', 'تم حذف الفرع');
}
public function create()
{
    $countries = Country::all();
    return view('branches.branches.create', compact('countries'));
}
}