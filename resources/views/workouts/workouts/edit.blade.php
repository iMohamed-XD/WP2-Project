@extends('workouts.layouts.app')

@section('title', 'تعديل: ' . $workout->name)

@section('content')
<h2 class="mb-4"><i class="bi bi-pencil-square"></i> تعديل الحصة: {{ $workout->name }}</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('workouts.update', $workout) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">اسم الحصة <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $workout->name) }}" required maxlength="255">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label">السعر (ريال) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" min="0" name="price" id="price"
                           class="form-control @error('price') is-invalid @enderror"
                           value="{{ old('price', $workout->price) }}" required>
                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="duration" class="form-label">المدة (بالدقائق) <span class="text-danger">*</span></label>
                    <input type="number" min="1" name="duration" id="duration"
                           class="form-control @error('duration') is-invalid @enderror"
                           value="{{ old('duration', $workout->duration) }}" required>
                    @error('duration') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="start_date" class="form-label">تاريخ بدء التسجيل <span class="text-danger">*</span></label>
                    <input type="date" name="start_date" id="start_date"
                           class="form-control @error('start_date') is-invalid @enderror"
                           value="{{ old('start_date', $workout->start_date->format('Y-m-d')) }}" required>
                    @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="sportstype_id" class="form-label">التخصص الرياضي <span class="text-danger">*</span></label>
                    <select name="sportstype_id" id="sportstype_id"
                            class="form-select @error('sportstype_id') is-invalid @enderror" required>
                        <option value="">-- اختر التخصص --</option>
                        @foreach($sportsTypes as $type)
                            <option value="{{ $type->id }}"
                                {{ old('sportstype_id', $workout->sportstype_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->type }}
                            </option>
                        @endforeach
                    </select>
                    @error('sportstype_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="workoutlevel_id" class="form-label">المستوى <span class="text-danger">*</span></label>
                    <select name="workoutlevel_id" id="workoutlevel_id"
                            class="form-select @error('workoutlevel_id') is-invalid @enderror" required>
                        <option value="">-- اختر المستوى --</option>
                        @foreach($workoutLevels as $level)
                            <option value="{{ $level->id }}"
                                {{ old('workout_level_id', $workout->workoutlevel_id) == $level->id ? 'selected' : '' }}>
                                {{ $level->level }}
                            </option>
                        @endforeach
                    </select>
                    @error('workoutlevel_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">الوصف (اختياري)</label>
                    <textarea name="description" id="description" rows="3"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $workout->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label">صورة الحصة</label>
                    @if($workout->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $workout->image) }}" style="height:80px;" class="rounded">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                           class="form-control @error('image') is-invalid @enderror">
                    <small class="text-muted">اتركه فارغاً للإبقاء على الصورة الحالية.</small>
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">الفروع التي تقدم هذه الحصة</label>
                    <div class="row">
                        @forelse($branches as $branch)
                            <div class="col-md-4 form-check">
                                <input class="form-check-input" type="checkbox" name="branches[]"
                                       value="{{ $branch->id }}" id="branch{{ $branch->id }}"
                                       {{ in_array($branch->id, old('branches', $selectedBranches)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="branch{{ $branch->id }}">
                                    {{ $branch->name }}
                                </label>
                            </div>
                        @empty
                            <p class="text-muted">لا توجد فروع مضافة بعد.</p>
                        @endforelse
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">المخازن والآلات</label>
                    <p class="text-muted small mb-3">اختر المخازن ثم اختر الآلات المتاحة داخل كل مخزن.</p>
                    <div class="row g-3">
                        @isset($warehouses)
                            @foreach($warehouses as $warehouse)
                                <div class="col-md-6">
                                    <div class="border rounded p-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="warehouses[]"
                                                   value="{{ $warehouse->id }}" id="warehouse{{ $warehouse->id }}"
                                                   {{ in_array($warehouse->id, old('warehouses', $selectedWarehouses ?? [])) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="warehouse{{ $warehouse->id }}">
                                                {{ $warehouse->name }}
                                            </label>
                                        </div>

                                        @if($warehouse->machines->count())
                                            <div class="ms-4">
                                                <small class="text-muted d-block mb-2">الآلات داخل هذا المخزن</small>
                                                @foreach($warehouse->machines as $machine)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="warehouse_machines[{{ $warehouse->id }}][]"
                                                               value="{{ $machine->id }}"
                                                               id="machine{{ $warehouse->id }}_{{ $machine->id }}"
                                                               {{ in_array($machine->id, old('warehouse_machines.' . $warehouse->id, $selectedWarehouseMachines[$warehouse->id] ?? [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="machine{{ $warehouse->id }}_{{ $machine->id }}">
                                                            {{ $machine->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted small mb-0">لا توجد آلات في هذا المخزن.</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">لا توجد مخازن مضافة بعد.</p>
                        @endisset
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('workouts.show', $workout) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-right"></i> إلغاء
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> تحديث الحصة
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
