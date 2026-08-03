@extends('workouts.layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
<h2 class="mb-4"><i class="bi bi-speedometer2"></i> لوحة التحكم</h2>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">عدد الحصص</h6>
                        <h3 class="mb-0">{{ $stats['workouts_count'] }}</h3>
                    </div>
                    <i class="bi bi-clipboard2-pulse fs-1 text-primary"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">التخصصات الرياضية</h6>
                        <h3 class="mb-0">{{ $stats['sports_types_count'] }}</h3>
                    </div>
                    <i class="bi bi-trophy fs-1 text-warning"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">مستويات الحصص</h6>
                        <h3 class="mb-0">{{ $stats['workout_levels_count'] }}</h3>
                    </div>
                    <i class="bi bi-bar-chart-steps fs-1 text-success"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">عدد المدربين</h6>
                        <h3 class="mb-0">{{ $stats['trainers_count'] }}</h3>
                    </div>
                    <i class="bi bi-person-badge fs-1 text-info"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('workouts.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> إضافة حصة جديدة
    </a>
    <a href="{{ route('workouts.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-list-ul"></i> عرض جميع الحصص
    </a>
</div>
@endsection
