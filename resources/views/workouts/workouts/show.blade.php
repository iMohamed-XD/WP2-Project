@extends('workouts.layouts.app')

@section('title', $workout->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clipboard2-pulse"></i> {{ $workout->name }}</h2>
    <div>
        <a href="{{ route('workouts.edit', $workout) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> تعديل
        </a>
        <a href="{{ route('workouts.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-right"></i> رجوع
        </a>
    </div>
</div>

<div class="row">
    <!-- بطاقة معلومات الحصة -->
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            @if($workout->image)
                <img src="{{ asset('storage/' . $workout->image) }}" class="card-img-top" style="height:220px; object-fit:cover;">
            @else
                <div class="bg-light text-center d-flex align-items-center justify-content-center" style="height:220px;">
                    <i class="bi bi-image text-muted" style="font-size:3rem;"></i>
                </div>
            @endif
            <div class="card-body">
                <p><i class="bi bi-tag"></i> <strong>التخصص:</strong> {{ $workout->sportsType->type ?? '-' }}</p>
                <p><i class="bi bi-bar-chart-steps"></i> <strong>المستوى:</strong> {{ $workout->workoutLevel->level ?? '-' }}</p>
                <p><i class="bi bi-cash-coin"></i> <strong>السعر:</strong> {{ number_format($workout->price, 2) }} ريال</p>
                <p><i class="bi bi-clock"></i> <strong>المدة:</strong> {{ $workout->duration }} دقيقة</p>
                <p><i class="bi bi-calendar-event"></i> <strong>تاريخ بدء التسجيل:</strong> {{ $workout->start_date->format('Y-m-d') }}</p>
                @if($workout->description)
                    <hr>
                    <p class="text-muted">{{ $workout->description }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <!-- الفروع -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <i class="bi bi-building"></i> الفروع المتاحة ({{ $workout->branches->count() }})
            </div>
            <div class="card-body">
                @forelse($workout->branches as $branch)
                    <span class="badge bg-secondary me-1 mb-1">{{ $branch->name }}</span>
                @empty
                    <p class="text-muted mb-0">لا يوجد فروع مرتبطة بهذه الحصة.</p>
                @endforelse
            </div>
        </div>

        <!-- المدربون -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <i class="bi bi-person-badge"></i> المدربون المشرفون ({{ $workout->trainers->count() }})
            </div>
            <div class="card-body">
                @forelse($workout->trainers as $trainer)
                    <span class="badge bg-info text-dark me-1 mb-1">{{ $trainer->name }}</span>
                @empty
                    <p class="text-muted mb-0">لا يوجد مدربون مرتبطون بهذه الحصة.</p>
                @endforelse
            </div>
        </div>

        <!-- الأعضاء المسجلون -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <i class="bi bi-people"></i> الأعضاء المسجلون ({{ $workout->members->count() }})
            </div>
            <div class="card-body p-0">
                @if($workout->members->count() > 0)
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>اسم العضو</th>
                                <th>المدرب</th>
                                <th>تاريخ البدء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($workout->members as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td>
                                        {{ optional(\App\Models\Trainer::find($member->pivot->trainer_id))->name ?? '-' }}
                                    </td>
                                    <td>{{ \Illuminate\Support\Carbon::parse($member->pivot->start_date)->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted p-3 mb-0">لا يوجد أعضاء مسجلين في هذه الحصة بعد.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<form action="{{ route('workouts.destroy', $workout) }}" method="POST"
      onsubmit="return confirm('هل أنت متأكد من حذف هذه الحصة؟ يجب عدم ارتباطها بفرع أو مدرب.');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        <i class="bi bi-trash"></i> حذف الحصة
    </button>
</form>
@endsection
