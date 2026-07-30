<x-layout>
    <x-user-badge :name="auth()->user()->name"></x-user-badge>
    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card auth-card border-0 text-light">

                    <div class="card-body p-5">


                        {{-- Header --}}
                        <div class="text-center mb-5">

                            @if ($trainer->image)

                                <img
                                    src="{{ asset('storage/'.$trainer->image) }}"
                                    alt="{{ $trainer->firstname }} {{ $trainer->lastname }}"
                                    class="rounded-circle shadow mb-4"
                                    style="width:180px;height:180px;object-fit:cover;">

                            @else

                                <img src="{{ asset('images/avatar-default.jpg') }}"
                                class="card-img-top"
                                style="width:180px;height:180px;object-fit:cover;"
                                alt="{{ $trainer->firstname }}">

                            @endif


                            <h1 class="fw-bold">

                                {{ $trainer->firstname }}
                                {{ $trainer->lastname }}

                            </h1>

                            <p class="text-body">

                                {{ $trainer->sportsType?->type ?? 'No specialization assigned' }}

                            </p>
                            @can('editStatus', $trainer)
                                <div class="mb-6">
                                    <strong>Status:</strong>
                                    <form action="{{ route('trainers.updateStatus', ['trainer' => $trainer->id]) }}" method="POST" id="statusForm" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="trainer_status_id"
                                                class="form-select form-select-sm d-inline-block w-auto border-success bg-success text-white"
                                                onchange="this.form.submit()">
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}"
                                                    {{ $trainer->trainer_status_id == $status->id ? 'selected' : '' }}>
                                                    {{ $status->status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            @else
                                <div class="mb-3">
                                    <strong>Status:</strong>
                                    <span class="badge bg-success">
                                        {{ $trainer->trainerStatus->status }}
                                    </span>
                                </div>
                            @endcan



                        {{-- Personal Information --}}
                        <div class="my-5">

                            <h4 class="fw-bold mb-4">
                                Personal Information
                            </h4>


                            <div class="row g-3">


                                <div class="col-md-6">

                                    <div class="p-3 rounded"
                                        style="background:#111827;">

                                        <small class="text-body">
                                            Father's Name
                                        </small>

                                        <div>
                                            {{ $trainer->fathername ?? 'Not provided' }}
                                        </div>

                                    </div>

                                </div>



                                <div class="col-md-6">

                                    <div class="p-3 rounded"
                                        style="background:#111827;">

                                        <small class="text-body">
                                            Gender
                                        </small>

                                        <div>
                                            {{ $trainer->gender }}
                                        </div>

                                    </div>

                                </div>



                                <div class="col-md-6">

                                    <div class="p-3 rounded"
                                        style="background:#111827;">

                                        <small class="text-body">
                                            Phone
                                        </small>

                                        <div>
                                            {{ $trainer->phone }}
                                        </div>

                                    </div>

                                </div>



                                <div class="col-md-6">

                                    <div class="p-3 rounded"
                                        style="background:#111827;">

                                        <small class="text-body">
                                            Email
                                        </small>

                                        <div>
                                            {{ $trainer->email ?? 'Not provided' }}
                                        </div>

                                    </div>

                                </div>



                                <div class="col-12">

                                    <div class="p-3 rounded"
                                        style="background:#111827;">

                                        <small class="text-body">
                                            Address
                                        </small>

                                        <div>
                                            {{ $trainer->address ?? 'Not provided' }}
                                        </div>

                                    </div>

                                </div>


                            </div>

                        </div>




                        {{-- Professional Information --}}
                        <div class="mb-5">

                            <h4 class="fw-bold mb-4">
                                Professional Details
                            </h4>


                            <div class="row g-3">


                                <div class="col-md-6">

                                    <div class="p-3 rounded"
                                        style="background:#111827;">

                                        <small class="text-body">
                                            Specialization
                                        </small>

                                        <div>
                                            {{ $trainer->sportsType?->type ?? 'Not assigned' }}
                                        </div>

                                    </div>

                                </div>



                                <div class="col-md-6">

                                    <div class="p-3 rounded"
                                        style="background:#111827;">

                                        <small class="text-body">
                                            Certification
                                        </small>

                                        <div>

                                            {{ str_replace('_',' ', ucfirst($trainer->certification)) }}

                                        </div>

                                    </div>

                                </div>



                                <div class="col-md-6">

                                    <div class="p-3 rounded"
                                        style="background:#111827;">

                                        <small class="text-body">
                                            Experience
                                        </small>

                                        <div>

                                            {{ $trainer->years_of_experience }}
                                            Years

                                        </div>

                                    </div>

                                </div>



                                <div class="col-md-6">

                                    <div class="p-3 rounded"
                                        style="background:#111827;">

                                        <small class="text-body">
                                            Hiring Date
                                        </small>

                                        <div>

                                            {{ $trainer->hiring_date?->format('Y-m-d') }}

                                        </div>

                                    </div>

                                </div>


                            </div>

                        </div>




                        {{-- Identity --}}
                        <div class="mb-5">

                            <h4 class="fw-bold mb-4">
                                Identity Information
                            </h4>


                            <div class="row g-3">


                                <div class="col-md-4">

                                    <div class="p-3 rounded"
                                        style="background:#111827;">

                                        <small class="text-body">
                                            Birth Date
                                        </small>

                                        <div>
                                            {{ $trainer->birthdate?->format('Y-m-d') }}
                                        </div>

                                    </div>

                                </div>


                                <div class="col-md-4">

                                    <div class="p-3 rounded"
                                        style="background:#111827;">

                                        <small class="text-body">
                                            Birth Place
                                        </small>

                                        <div>
                                            {{ $trainer->birthplace ?? 'Not provided' }}
                                        </div>

                                    </div>

                                </div>


                                <div class="col-md-4">

                                    <div class="p-3 rounded"
                                        style="background:#111827;">

                                        <small class="text-body">
                                            SSN
                                        </small>

                                        <div>
                                            {{ $trainer->SSN }}
                                        </div>

                                    </div>

                                </div>


                            </div>

                        </div>
                        {{-- Assigned Workouts --}}
                        <div class="mb-5">

                            <h4 class="fw-bold mb-4">
                                Assigned Workouts
                            </h4>

                            @if ($trainer->workouts->isEmpty())

                                <div class="p-3 rounded text-body" style="background:#111827;">
                                    No workouts assigned.
                                </div>

                            @else

                                <div class="row g-3">

                                    @foreach ($trainer->workouts as $workout)

                                        <div class="col-md-6">

                                            <div class="p-3 rounded" style="background:#111827;">

                                                <div class="d-flex justify-content-between align-items-start">

                                                    <strong>{{ $workout->name }}</strong>

                                                    <span class="badge bg-secondary text-capitalize">
                                                        {{ $workout->workoutLevel?->level ?? 'N/A' }}
                                                    </span>

                                                </div>

                                                <small class="text-body d-block mt-1">
                                                    {{ $workout->sportsType?->type ?? 'No sport type' }}
                                                </small>

                                                <div class="mt-2 d-flex justify-content-between">

                                                    <span>{{ $workout->duration }} min</span>
                                                    <span>${{ number_format($workout->price, 2) }}</span>

                                                </div>

                                                <small class="text-body d-block mt-1">
                                                    Starts {{ $workout->start_date?->format('Y-m-d') }}
                                                </small>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            @endif

                        </div>



                        {{-- Actions --}}
                        <div class="d-flex gap-3 justify-content-center">


                            <a href="{{ route('trainers.index') }}"
                            class="btn btn-secondary px-4">

                                Back

                            </a>

                            @can('edit', $trainer)
                            <a href="{{ route('trainers.edit',$trainer->id) }}"
                            class="btn btn-primary px-4">
                                Edit
                            </a>
                            @endcan


                            @can('delete', $trainer)
                            <form action="{{ route('trainers.destroy',$trainer->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger px-4"
                                        onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                            @endcan


                        </div>



                    </div>

                </div>

            </div>

        </div>

    </div>

</x-layout>
