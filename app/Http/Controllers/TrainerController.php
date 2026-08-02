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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | RedirectResponse | string
    {
        $filters = $request->only(['specialty', 'experience', 'status', 'search']);

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

        $totalTrainers = Trainer::query()->count('*');
        $activeStatusId = TrainerStatus::query()
            ->where('status', '=', 'Active', 'and')
            ->value('id');

        $activeTrainers = Trainer::query()
            ->where('trainer_status_id', '=', $activeStatusId, 'and')
            ->count('*');

        return view('trainers.index', compact('trainers', 'sportsTypes', 'trainerStatuses', 'totalTrainers', 'activeTrainers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View | RedirectResponse
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
    public function show(string $id): View | RedirectResponse
    {
        $statuses = TrainerStatus::all();

        $trainer = Trainer::with([
            'sportsType',
            'trainerStatus',
            'workouts.sportsType',
            'workouts.workoutLevel',
        ])->findOrFail($id);

        return view('trainers.show', compact('trainer', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View | RedirectResponse
    {
        $trainer = Trainer::findOrFail($id);
        Gate::authorize('edit', $trainer);
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
        //Gate::authorize('edit', $trainer);
        $rules = [
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
            'certification' => 'required|in:level_1,level_2,level_3,level_4',
        ];

        if (Gate::allows('editStatus', $trainer)) {
            $rules['trainer_status_id'] = 'required|exists:trainer_statuses,id';
        }

        $validatedData = $request->validate($rules);

        if (! Gate::allows('editStatus', $trainer)) {
            unset($validatedData['trainer_status_id']);
        }

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
        Gate::authorize('delete', $trainer);

        if ($trainer->workouts()->exists()) {
            return redirect()
                ->route('trainers.show', $trainer->id)
                ->with('error', 'This trainer cannot be deleted while workouts are still assigned. Unassign the workouts first.');
        }

        $trainer->delete();

        return redirect()->route('trainers.index')->with('success', 'Trainer deleted successfully.');
    }

    public function updateStatus(Request $request, string $id): RedirectResponse
    {
        $trainer = Trainer::findOrFail($id);
        Gate::authorize('editStatus', $trainer);
        $validatedData = $request->validate([
            'trainer_status_id' => 'required|exists:trainer_statuses,id',
        ]);

        $trainer->update($validatedData);

        return redirect()->route('trainers.show', $trainer->id)->with('success', 'Trainer status updated successfully.');
    }
    /*
        Specialties
        Create, Show, edit, and delete
    */
    public function specialties() : View
    {       
        Gate::authorize('viewAny', SportsType::class);
        $specialties = SportsType::query()->paginate(10);
        return view('trainers.specialties', compact('specialties'));
    }

    public function editSpecialties(Request $request, string $id): RedirectResponse
    {
        $specialty = SportsType::findOrFail($id);
        Gate::authorize('update', $specialty);
        $validatedData = $request->validate([
            'type' => 'required|string|min:1|max:255',
        ]);
        $specialty->update($validatedData);
        return redirect()->route('trainers.specialties')->with('success', 'Specialty has been updated successfully!');
    }

    public function deleteSpecialties(string $id): RedirectResponse
    {
        $specialty = SportsType::findOrFail($id);
        Gate::authorize('delete', $specialty);
        $specialty->delete();
        return redirect()->route('trainers.specialties')->with('success', 'Specialty has been deleted successfully!');
    }

    public function createSpecialty(Request $request): RedirectResponse
    {
        Gate::authorize('create', SportsType::class);
        $validatedData = $request->validate([
            'type' => 'required|string|min:1|max:255',
        ]);
        SportsType::create($validatedData);
        return redirect()->route('trainers.specialties')->with('success', 'Specialty has been Created successfully!');
    }
}
