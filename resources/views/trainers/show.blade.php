<x-layout>
    <x-user-badge :name="auth()->user()->name"></x-user-badge>

    <style>
        .profile-header {
            display: flex;
            align-items: center;
            gap: 28px;
            flex-wrap: wrap;
            padding-bottom: 28px;
            margin-bottom: 28px;
            border-bottom: 1px solid #1e293b;
        }

        .profile-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #334155;
            box-shadow: 0 10px 25px rgba(0,0,0,.35);
        }

        .profile-name {
            font-size: 1.9rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .profile-sub {
            color: #94a3b8;
            font-size: .95rem;
            margin-bottom: 12px;
        }

        .profile-badges {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .badge-soft {
            font-weight: 600;
            font-size: .78rem;
            padding: 6px 12px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-soft-blue {
            background: rgba(59, 130, 246, .12);
            color: #93c5fd;
            border: 1px solid rgba(59, 130, 246, .35);
        }

        .badge-soft-green {
            background: rgba(34, 197, 94, .12);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, .35);
        }

        .status-select-wrap select {
            font-weight: 600;
            font-size: .78rem;
            border-radius: 999px !important;
            padding: 6px 30px 6px 14px;
        }

        .section-block {
            margin-bottom: 40px;
        }

        .section-block h4 {
            font-size: 1.1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #3b82f6;
            padding-left: 12px;
            margin-bottom: 18px;
        }

        .section-block h4 i {
            color: #60a5fa;
        }

        .info-tile {
            background: #020617;
            border: 1px solid #1e293b;
            border-radius: 12px;
            padding: 14px 16px;
            height: 100%;
        }

        .info-tile small {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #cbd5e1;
            text-transform: uppercase;
            letter-spacing: .04em;
            font-size: .7rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .info-tile .value {
            color: #e2e8f0;
            font-weight: 500;
            word-break: break-word;
        }

        .workout-card {
            background: #020617;
            border: 1px solid #1e293b;
            border-radius: 14px;
            padding: 16px 18px;
            height: 100%;
            transition: .2s;
        }

        .workout-card:hover {
            border-color: rgba(59, 130, 246, .4);
            transform: translateY(-2px);
        }

        .empty-box {
            background: #020617;
            border: 1px dashed #334155;
            border-radius: 12px;
            padding: 28px;
            text-align: center;
            color: #64748b;
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card auth-card border-0 text-light">
                    <div class="card-body p-5">

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        {{-- Header --}}
                        <div class="profile-header">

                            <img src="{{ $trainer->profile_picture_url }}" class="profile-avatar">

                            <div>
                                <div class="profile-name">
                                    {{ $trainer->firstname }} {{ $trainer->lastname }}
                                </div>
                                <div class="profile-sub">
                                    <i class="bi bi-award-fill me-1"></i>
                                    {{ $trainer->sportsType?->type ?? 'No specialization assigned' }}
                                </div>

                                <div class="profile-badges">
                                    <span class="badge-soft badge-soft-blue">
                                        <i class="bi bi-mortarboard-fill"></i>
                                        {{ str_replace('_',' ', ucfirst($trainer->certification)) }}
                                    </span>
                                    <span class="badge-soft badge-soft-green">
                                        <i class="bi bi-briefcase-fill"></i>
                                        {{ $trainer->years_of_experience }} yrs experience
                                    </span>

                                    @can('editStatus', $trainer)
                                        <form action="{{ route('trainers.updateStatus', ['trainer' => $trainer->id]) }}" method="POST" id="statusForm" class="status-select-wrap d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="trainer_status_id"
                                                    class="form-select form-select-sm d-inline-block w-auto"
                                                    onchange="this.form.submit()">
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status->id }}"
                                                        {{ $trainer->trainer_status_id == $status->id ? 'selected' : '' }}>
                                                        {{ $status->status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    @else
                                        <span class="badge-soft badge-soft-green">
                                            <i class="bi bi-check-circle-fill"></i>
                                            {{ $trainer->trainerStatus->status }}
                                        </span>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        {{-- Personal Information --}}
                        <div class="section-block">
                            <h4><i class="bi bi-person-vcard-fill"></i> Personal Information</h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="info-tile">
                                        <small><i class="bi bi-person"></i> Father's Name</small>
                                        <div class="value">{{ $trainer->fathername ?? 'Not provided' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-tile">
                                        <small><i class="bi bi-gender-ambiguous"></i> Gender</small>
                                        <div class="value">{{ $trainer->gender }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-tile">
                                        <small><i class="bi bi-telephone-fill"></i> Phone</small>
                                        <div class="value">{{ $trainer->phone }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-tile">
                                        <small><i class="bi bi-envelope-fill"></i> Email</small>
                                        <div class="value">{{ $trainer->email ?? 'Not provided' }}</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="info-tile">
                                        <small><i class="bi bi-geo-alt-fill"></i> Address</small>
                                        <div class="value">{{ $trainer->address ?? 'Not provided' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Professional Details --}}
                        <div class="section-block">
                            <h4><i class="bi bi-briefcase-fill"></i> Professional Details</h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="info-tile">
                                        <small><i class="bi bi-award"></i> Specialization</small>
                                        <div class="value">{{ $trainer->sportsType?->type ?? 'Not assigned' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-tile">
                                        <small><i class="bi bi-mortarboard"></i> Certification</small>
                                        <div class="value">{{ str_replace('_',' ', ucfirst($trainer->certification)) }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-tile">
                                        <small><i class="bi bi-graph-up"></i> Experience</small>
                                        <div class="value">{{ $trainer->years_of_experience }} Years</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-tile">
                                        <small><i class="bi bi-calendar-check"></i> Hiring Date</small>
                                        <div class="value">{{ $trainer->hiring_date?->format('Y-m-d') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Identity --}}
                        <div class="section-block">
                            <h4><i class="bi bi-fingerprint"></i> Identity Information</h4>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="info-tile">
                                        <small><i class="bi bi-cake2"></i> Birth Date</small>
                                        <div class="value">{{ $trainer->birthdate?->format('Y-m-d') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-tile">
                                        <small><i class="bi bi-signpost-split"></i> Birth Place</small>
                                        <div class="value">{{ $trainer->birthplace ?? 'Not provided' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-tile">
                                        <small><i class="bi bi-shield-lock"></i> SSN</small>
                                        <div class="value">{{ $trainer->SSN }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Assigned Workouts --}}
                        <div class="section-block">
                            <h4>
                                <i class="bi bi-lightning-charge-fill"></i> Assigned Workouts
                                <span class="badge-soft badge-soft-blue">{{ $trainer->workouts->count() }}</span>
                            </h4>

                            @if ($trainer->workouts->isEmpty())
                                <div class="empty-box">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    No workouts assigned.
                                </div>
                            @else
                                @php
                                    $levelColors = [
                                        'beginner' => 'success',
                                        'intermediate' => 'warning',
                                        'advanced' => 'danger',
                                    ];
                                @endphp

                                <div class="row g-3">
                                    @foreach ($trainer->workouts as $workout)
                                        <div class="col-md-6">
                                            <div class="workout-card">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <strong>{{ $workout->name }}</strong>
                                                    <span class="badge bg-{{ $levelColors[$workout->workoutLevel?->level] ?? 'secondary' }} text-capitalize">
                                                        {{ $workout->workoutLevel?->level ?? 'N/A' }}
                                                    </span>
                                                </div>

                                                <small class="text-body d-block mt-1">
                                                    <i class="bi bi-tag"></i>
                                                    {{ $workout->sportsType?->type ?? 'No sport type' }}
                                                </small>

                                                <div class="mt-2 d-flex justify-content-between text-body">
                                                    <span><i class="bi bi-clock"></i> {{ $workout->duration }} min</span>
                                                    <span><i class="bi bi-cash-stack"></i> ${{ number_format($workout->price, 2) }}</span>
                                                </div>

                                                <small class="text-body d-block mt-1">
                                                    <i class="bi bi-calendar-event"></i>
                                                    Starts {{ $workout->start_date?->format('Y-m-d') }}
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex gap-3 justify-content-center pt-4" style="border-top: 1px solid #1e293b;">
                            <a href="{{ route('trainers.index') }}" class="btn btn-secondary px-4">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>

                            @can('edit', $trainer)
                                <a href="{{ route('trainers.edit',$trainer->id) }}" class="btn btn-primary px-4">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            @endcan

                            @can('delete', $trainer)
                                <form action="{{ route('trainers.destroy',$trainer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger px-4" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i> Delete
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