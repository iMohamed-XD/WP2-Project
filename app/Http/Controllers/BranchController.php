<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Country;
use App\Models\Trainer;
use App\Models\Workout;
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
        $trainers = Trainer::with('sportsType')->orderBy('firstname')->get();
        $selectedTrainers = $branch->trainers->pluck('id')->toArray();
        $workouts = Workout::all();
        $selectedWorkouts = $branch->workouts->pluck('id')->toArray();

        return view('branches.branches.edit', compact('branch', 'countries', 'trainers', 'selectedTrainers', 'workouts', 'selectedWorkouts'));
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

        $branch->trainers()->sync($request->input('trainers', []));
        $branch->workouts()->sync($request->input('workouts', []));
        return redirect()->route('branches.index')->with('success', 'تم تحديث الفرع بنجاح');
    }

    public function destroy(Branch $branch)
    {
        if ($branch->trainers()->exists()) {
            return back()->with('error', 'Cannot delete a branch that has trainers.');
        }
        if ($branch->workouts()->exists()) {
            return back()->with('error', 'Cannot delete a branch that has workouts.');
        }
        $branch->delete();
        return redirect()->route('branches.index')->with('success', 'تم حذف الفرع');
    }
    public function create()
    {
        $countries = Country::all();
        return view('branches.branches.create', compact('countries'));
    }
    public function details()
    {
        $branches = Branch::with(['country', 'trainers.sportsType', 'workouts'])
            ->paginate(6);

        return view('branches.details', compact('branches'));
    }
}