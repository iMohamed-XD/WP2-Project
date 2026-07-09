<x-layout>

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

                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4"
                                 style="
                                    width:180px;
                                    height:180px;
                                    background:#111827;
                                 ">

                            </div>

                        @endif


                        <h1 class="fw-bold">

                            {{ $trainer->firstname }}
                            {{ $trainer->lastname }}

                        </h1>

                        <p class="text-secondary">

                            {{ $trainer->sportsType?->type ?? 'No specialization assigned' }}

                        </p>


                        <div class="mb-3">
                            <strong>Status:</strong>
                            <form action="{{ route('trainers.updateStatus', $trainer->id) }}" method="POST" id="statusForm" class="d-inline">
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

                    </div>



                    {{-- Personal Information --}}
                    <div class="mb-5">

                        <h4 class="fw-bold mb-4">
                            Personal Information
                        </h4>


                        <div class="row g-3">


                            <div class="col-md-6">

                                <div class="p-3 rounded"
                                     style="background:#111827;">

                                    <small class="text-secondary">
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

                                    <small class="text-secondary">
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

                                    <small class="text-secondary">
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

                                    <small class="text-secondary">
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

                                    <small class="text-secondary">
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

                                    <small class="text-secondary">
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

                                    <small class="text-secondary">
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

                                    <small class="text-secondary">
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

                                    <small class="text-secondary">
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

                                    <small class="text-secondary">
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

                                    <small class="text-secondary">
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

                                    <small class="text-secondary">
                                        SSN
                                    </small>

                                    <div>
                                        {{ $trainer->SSN }}
                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>




                    {{-- Actions --}}
                    <div class="d-flex gap-3 justify-content-center">


                        <a href="{{ route('trainers.index') }}"
                           class="btn btn-secondary px-4">

                            Back

                        </a>


                        <a href="{{ route('trainers.edit',$trainer->id) }}"
                           class="btn btn-primary px-4">

                            Edit

                        </a>



                        <form action="{{ route('trainers.destroy',$trainer->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')


                            <button class="btn btn-danger px-4"
                                    onclick="return confirm('Are you sure?')">

                                Delete

                            </button>


                        </form>


                    </div>



                </div>

            </div>

        </div>

    </div>

</div>

</x-layout>
