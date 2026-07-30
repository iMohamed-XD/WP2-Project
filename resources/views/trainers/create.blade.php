<x-layout>
    <x-user-badge :name="auth()->user()->name"></x-user-badge>

    <style>
        .form-section {
            margin-bottom: 36px;
        }

        .form-section h4 {
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #3b82f6;
            padding-left: 12px;
            margin-bottom: 20px;
        }

        .form-section h4 i { color: #60a5fa; }

        .required-mark { color: #f87171; }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card auth-card border-0 text-light">
                    <div class="card-body p-5">

                        <div class="text-center mb-5">
                            <h1 class="fw-bold">Create Trainer</h1>
                            <p class="text-secondary">Add a new trainer to the sports staff</p>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('trainers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-section">
                                <h4><i class="bi bi-person-vcard-fill"></i> Personal Information</h4>
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <label class="form-label">First Name <span class="required-mark">*</span></label>
                                        <input type="text" name="firstname" value="{{ old('firstname') }}"
                                               class="form-control @error('firstname') is-invalid @enderror">
                                        @error('firstname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Last Name <span class="required-mark">*</span></label>
                                        <input type="text" name="lastname" value="{{ old('lastname') }}"
                                               class="form-control @error('lastname') is-invalid @enderror">
                                        @error('lastname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Father's Name</label>
                                        <input type="text" name="fathername" value="{{ old('fathername') }}"
                                               class="form-control @error('fathername') is-invalid @enderror">
                                        @error('fathername') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">National ID (SSN) <span class="required-mark">*</span></label>
                                        <input type="text" name="SSN" maxlength="11" value="{{ old('SSN') }}"
                                               class="form-control @error('SSN') is-invalid @enderror">
                                        @error('SSN') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Gender <span class="required-mark">*</span></label>
                                        <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Profile Image</label>
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h4><i class="bi bi-telephone-fill"></i> Contact Information</h4>
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <label class="form-label">Phone <span class="required-mark">*</span></label>
                                        <input type="text" name="phone" value="{{ old('phone') }}"
                                               class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                               class="form-control @error('email') is-invalid @enderror">
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Address</label>
                                        <textarea name="address" rows="3"
                                                  class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h4><i class="bi bi-briefcase-fill"></i> Professional Details</h4>
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <label class="form-label">Specialization <span class="required-mark">*</span></label>
                                        <select name="sports_type_id" class="form-select @error('sports_type_id') is-invalid @enderror">
                                            <option value="">Select Specialty</option>
                                            @foreach($sportsTypes as $type)
                                                <option value="{{ $type->id }}" {{ old('sports_type_id') == $type->id ? 'selected' : '' }}>
                                                    {{ $type->type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('sports_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Certification</label>
                                        <select name="certification" class="form-select @error('certification') is-invalid @enderror">
                                            <option value="level_1" {{ old('certification') == 'level_1' ? 'selected' : '' }}>Level 1 (Basic)</option>
                                            <option value="level_2" {{ old('certification') == 'level_2' ? 'selected' : '' }}>Level 2 (Advanced)</option>
                                            <option value="level_3" {{ old('certification') == 'level_3' ? 'selected' : '' }}>Level 3 (Professional)</option>
                                            <option value="level_4" {{ old('certification') == 'level_4' ? 'selected' : '' }}>Level 4 (Expert)</option>
                                        </select>
                                        @error('certification') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Employment Status <span class="required-mark">*</span></label>
                                        <select name="trainer_status_id" class="form-select @error('trainer_status_id') is-invalid @enderror">
                                            <option value="">Select Status</option>
                                            @foreach($trainerStatuses as $status)
                                                <option value="{{ $status->id }}" {{ old('trainer_status_id') == $status->id ? 'selected' : '' }}>
                                                    {{ $status->status }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('trainer_status_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Years of Experience <span class="required-mark">*</span></label>
                                        <input type="number" name="years_of_experience" min="2" max="50" value="{{ old('years_of_experience') }}"
                                               class="form-control @error('years_of_experience') is-invalid @enderror">
                                        @error('years_of_experience') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Birth Date <span class="required-mark">*</span></label>
                                        <input type="date" name="birthdate" value="{{ old('birthdate') }}"
                                               class="form-control @error('birthdate') is-invalid @enderror">
                                        @error('birthdate') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Hiring Date <span class="required-mark">*</span></label>
                                        <input type="date" name="hiring_date" value="{{ old('hiring_date') }}"
                                               class="form-control @error('hiring_date') is-invalid @enderror">
                                        @error('hiring_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Birth Place</label>
                                        <input type="text" name="birthplace" value="{{ old('birthplace') }}"
                                               class="form-control @error('birthplace') is-invalid @enderror">
                                        @error('birthplace') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-3">
                                <a href="{{ route('trainers.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success px-5">
                                    <i class="bi bi-check-circle-fill me-1"></i> Create Trainer
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>