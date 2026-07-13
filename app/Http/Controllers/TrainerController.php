<?php

namespace App\Http\Controllers;

use App\Models\SportsType;
use App\Models\Trainer;
use App\Models\TrainerStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['specialty', 'experience', 'status']);

        // Apply filters and paginate (Project Requirement: Pagination)
        $trainers = Trainer::filter($filters)
            ->with(['sportsType', 'trainerStatus'])
            ->paginate(9);

        //  AJAX
        if ($request->ajax()) {
            return view('trainers._trainer_grid', compact('trainers'))->render();
        }

        // Normal load
        $sportsTypes = SportsType::all();
        $trainerStatuses = TrainerStatus::all();

        return view('trainers.index', compact('trainers', 'sportsTypes', 'trainerStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sportsTypes = SportsType::all();
        $trainerStatuses = TrainerStatus::all();

        return view('trainers.create', compact('sportsTypes', 'trainerStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'fathername' => 'nullable|string|max:255',
            'SSN' => 'required|digits:11|unique:trainers,SSN',
            'phone' => 'required|string|starts_with:09|digits:10',
            'address' => 'nullable|string|max:1000',
            'email' => 'nullable|email|unique:trainers,email',
            'gender' => 'required|in:Male,Female',
            'birthplace' => 'nullable|string|max:255',
            'birthdate' => 'required|date|before:-18 years|after:-60 years',
            'years_of_experience' => 'required|integer|between:2,50',
            'hiring_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sports_type_id' => 'required|exists:sports_types,id',
            'trainer_status_id' => 'required|exists:trainer_statuses,id',
            'certification' => 'required|in:level_1,level_2,level_3,level_4',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('trainers', 'public');
        }

        Trainer::create($validatedData);

        return redirect()->route('trainers.index')->with('success', 'Trainer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $statuses = TrainerStatus::all();
        $trainer = Trainer::with(['sportsType', 'trainerStatus'])->findOrFail($id);

        return view('trainers.show', compact('trainer', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $trainer = Trainer::findOrFail($id);
        $sportsTypes = SportsType::all();
        $trainerStatuses = TrainerStatus::all();

        return view('trainers.edit', compact('trainer', 'sportsTypes', 'trainerStatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $trainer = Trainer::findOrFail($id);
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'fathername' => 'nullable|string|max:255',
            'SSN' => ['required', 'digits:11', Rule::unique('trainers', 'SSN')->ignore($trainer)],
            'phone' => 'required|string|starts_with:09|digits:10',
            'address' => 'nullable|string|max:1000',
            'email' => ['nullable', 'email', Rule::unique('trainers', 'email')->ignore($trainer)],
            'gender' => 'required|in:Male,Female',
            'birthplace' => 'nullable|string|max:255',
            'birthdate' => 'required|date|before:-18 years|after:-60 years',
            'years_of_experience' => 'required|integer|between:2,50',
            'hiring_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sports_type_id' => 'required|exists:sports_types,id',
            'trainer_status_id' => 'required|exists:trainer_statuses,id',
            'certification' => 'required|in:level_1,level_2,level_3,level_4',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $trainer->image);
            $validatedData['image'] = $request->file('image')->store('trainers', 'public');
        }

        $trainer->update($validatedData);

        return redirect()->route('trainers.index')->with('success', 'Trainer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $trainer = Trainer::findOrFail($id);
        $trainer->delete();

        return redirect()->route('trainers.index')->with('success', 'Trainer deleted successfully.');
    }

    public function updateStatus(Request $request, string $id): RedirectResponse
    {
        $trainer = Trainer::findOrFail($id);
        $validatedData = $request->validate([
            'trainer_status_id' => 'required|exists:trainer_statuses,id',
        ]);

        $trainer->update($validatedData);

        return redirect()->route('trainers.show', $trainer->id)->with('success', 'Trainer status updated successfully.');
    }
}
