<x-layout>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-5">

        <div>

            <h1 class="fw-bold mb-1">
                Trainers
            </h1>

            <p class="text-secondary mb-0">
                Sports Staff Management
            </p>

        </div>

        <a href="{{ route('trainers.create') }}"
           class="btn btn-success">
            + Add Trainer
        </a>

    </div>

    <div class="row g-4">

        @forelse($trainers as $trainer)

            <div class="col-lg-4 col-md-6">

                <div class="card auth-card h-100 border-0">

                    @if($trainer->image)

                        <img
                            src="{{ asset('storage/'.$trainer->image) }}"
                            class="card-img-top"
                            style="height:300px;object-fit:cover;"
                            alt="{{ $trainer->firstname }}">

                    @else

                        <div
                            class="d-flex justify-content-center align-items-center"
                            style="height:300px;background:#1f2937;">


                        </div>

                    @endif

                    <div class="card-body d-flex flex-column">

                        <h4 class="fw-bold">

                            {{ $trainer->firstname }}
                            {{ $trainer->lastname }}

                        </h4>

                        <hr>

                        <p>

                            <strong>Specialization</strong><br>

                            <span class="text-secondary">

                                {{ $trainer->sportsType?->type ?? 'Not Assigned' }}

                            </span>

                        </p>

                        <p>

                            <strong>Status</strong><br>

                            <span class="badge bg-success">

                                {{ $trainer->trainerStatus?->status ?? 'Unknown' }}

                            </span>

                        </p>

                        <p>

                            <strong>Experience</strong><br>

                            {{ $trainer->years_of_experience }}
                            Years

                        </p>

                        <p>

                            <strong>Phone</strong><br>

                            {{ $trainer->phone }}

                        </p>

                        <div class="mt-auto">

                            <a
                                href="{{ route('trainers.show',$trainer->id) }}"
                                class="btn btn-primary w-100">

                                View Profile

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="card auth-card">

                    <div class="card-body text-center p-5">

                        <h3>No Trainers Found</h3>

                        <p class="text-secondary">
                            Click the button above to create one.
                        </p>

                    </div>

                </div>

            </div>

        @endforelse

    </div>

</div>

</x-layout>
