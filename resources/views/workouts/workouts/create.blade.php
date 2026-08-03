@extends('workouts.layouts.app')

@section('title', 'إضافة حصة جديدة')

@section('content')
<h2 class="mb-4"><i class="bi bi-plus-circle"></i> إضافة حصة جديدة</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('workouts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">اسم الحصة <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" required maxlength="255">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label">السعر (ريال) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" min="0" name="price" id="price"
                           class="form-control @error('price') is-invalid @enderror"
                           value="{{ old('price') }}" required>
                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="duration" class="form-label">المدة (بالدقائق) <span class="text-danger">*</span></label>
                    <input type="number" min="1" name="duration" id="duration"
                           class="form-control @error('duration') is-invalid @enderror"
                           value="{{ old('duration') }}" required>
                    @error('duration') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="start_date" class="form-label">تاريخ بدء التسجيل <span class="text-danger">*</span></label>
                    <input type="date" name="start_date" id="start_date"
                           class="form-control @error('start_date') is-invalid @enderror"
                           value="{{ old('start_date') }}" min="{{ now()->addDay()->toDateString() }}" required>
                    @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="sports_type_id" class="form-label">التخصص الرياضي <span class="text-danger">*</span></label>
                    <select name="sports_type_id" id="sports_type_id"
                            class="form-select @error('sports_type_id') is-invalid @enderror" required>
                        <option value="">-- اختر التخصص --</option>
                        @foreach($sportsTypes as $type)
                            <option value="{{ $type->id }}" {{ old('sports_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('sports_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="workout_level_id" class="form-label">المستوى <span class="text-danger">*</span></label>
                    <select name="workout_level_id" id="workout_level_id"
                            class="form-select @error('workout_level_id') is-invalid @enderror" required>
                        <option value="">-- اختر المستوى --</option>
                        @foreach($workoutLevels as $level)
                            <option value="{{ $level->id }}" {{ old('workout_level_id') == $level->id ? 'selected' : '' }}>
                                {{ $level->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('workout_level_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">الوصف (اختياري)</label>
                    <textarea name="description" id="description" rows="3"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label">صورة الحصة (اختياري)</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="form-control @error('image') is-invalid @enderror">
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">الفروع التي تقدم هذه الحصة (اختياري)</label>
                    <div class="row">
                        @forelse($branches as $branch)
                            <div class="col-md-4 form-check">
                                <input class="form-check-input" type="checkbox" name="branches[]"
                                       value="{{ $branch->id }}" id="branch{{ $branch->id }}"
                                       {{ collect(old('branches'))->contains($branch->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="branch{{ $branch->id }}">
                                    {{ $branch->name }}
                                </label>
                            </div>
                        @empty
                            <p class="text-muted">لا توجد فروع مضافة بعد.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('workouts.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-right"></i> إلغاء
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> حفظ الحصة
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
