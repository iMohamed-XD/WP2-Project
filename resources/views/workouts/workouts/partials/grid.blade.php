@forelse($workouts as $workout)
    <div class="col-md-4 mb-4">
        <div class="card h-100 card-hover shadow-sm">
            @if($workout->image)
                <img src="{{ asset('storage/' . $workout->image) }}" class="card-img-top" style="height:180px; object-fit:cover;" alt="{{ $workout->name }}">
            @else
                <div class="bg-light text-center d-flex align-items-center justify-content-center" style="height:180px;">
                    <i class="bi bi-image text-muted" style="font-size:3rem;"></i>
                </div>
            @endif
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $workout->name }}</h5>
                <p class="mb-1">
                    <span class="badge bg-primary">{{ $workout->sportsType->name ?? '-' }}</span>
                    <span class="badge bg-secondary">{{ $workout->workoutLevel->name ?? '-' }}</span>
                </p>
                <p class="text-muted small mb-2">
                    <i class="bi bi-clock"></i> {{ $workout->duration }} دقيقة
                    &nbsp;|&nbsp;
                    <i class="bi bi-cash-coin"></i> {{ number_format($workout->price, 2) }} ريال
                </p>
                <p class="card-text text-truncate">{{ $workout->description }}</p>

                <div class="mt-auto d-flex gap-2">
                    <a href="{{ route('workouts.show', $workout) }}" class="btn btn-sm btn-outline-primary flex-fill">
                        <i class="bi bi-eye"></i> عرض
                    </a>
                    <a href="{{ route('workouts.edit', $workout) }}" class="btn btn-sm btn-outline-warning flex-fill">
                        <i class="bi bi-pencil"></i> تعديل
                    </a>
                    <form action="{{ route('workouts.destroy', $workout) }}" method="POST" class="flex-fill"
                          onsubmit="return confirm('هل أنت متأكد من حذف هذه الحصة؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                            <i class="bi bi-trash"></i> حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> لا توجد حصص مطابقة.
        </div>
    </div>
@endforelse
