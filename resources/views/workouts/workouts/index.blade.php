@extends('workouts.layouts.app')

@section('title', 'قائمة الحصص التدريبية')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-list-ul"></i> قائمة الحصص التدريبية</h2>
    <a href="{{ route('workouts.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> إضافة حصة جديدة
    </a>
</div>

<div class="row">
    @include('workouts.workouts.partials.grid', ['workouts' => $workouts])
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $workouts->links() }}
</div>
@endsection
