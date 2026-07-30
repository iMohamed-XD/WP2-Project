@php
    $statusColors = [
        'Active' => 'green',
        'On Leave' => 'amber',
        'Loaned' => 'blue',
        'Ended Contract' => 'red',
    ];
@endphp

<div class="row g-4">
    @forelse($trainers as $trainer)
        <div class="col-lg-4 col-md-6">
            <div class="trainer-card h-100">
                <div class="trainer-card-photo">
                    <img src="{{ $trainer->profile_picture_url }}" class="profile-avatar">
                    <span class="status-pill status-pill-{{ $statusColors[$trainer->trainerStatus?->status] ?? 'gray' }}">
                        <i class="bi bi-circle-fill"></i>
                        {{ $trainer->trainerStatus?->status ?? 'Unknown' }}
                    </span>
                </div>

                <div class="trainer-card-body">
                    <h4 class="trainer-name">{{ $trainer->firstname }} {{ $trainer->lastname }}</h4>

                    <div class="trainer-specialty">
                        <i class="bi bi-award-fill"></i>
                        {{ $trainer->sportsType?->type ?? 'Not Assigned' }}
                    </div>

                    <div class="trainer-stats">
                        <span><i class="bi bi-briefcase-fill"></i> {{ $trainer->years_of_experience }} yrs</span>
                        <span><i class="bi bi-telephone-fill"></i> {{ $trainer->phone }}</span>
                    </div>

                    <a href="{{ route('trainers.show', $trainer->id) }}" class="btn btn-primary w-100 mt-3">
                        <i class="bi bi-eye-fill me-1"></i> View Profile
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-box">
                <i class="bi bi-people fs-1 d-block mb-2"></i>
                <h5 class="mb-1">No Trainers Found</h5>
                <p class="mb-0">Try adjusting your filters.</p>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $trainers->links('pagination::bootstrap-5') }}
</div>