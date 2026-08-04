<div class="mb-3">
    <label class="form-label">
        Warehouse Name <span class="text-danger">*</span>
    </label>
    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        placeholder="Enter warehouse name"
        value="{{ old('name', $warehouse->name ?? '') }}"
    >
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">
        Location <span class="text-danger">*</span>
    </label>
    <input
        type="text"
        name="location"
        class="form-control @error('location') is-invalid @enderror"
        placeholder="Enter location"
        value="{{ old('location', $warehouse->location ?? '') }}"
    >
    @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">
        Phone <span class="text-danger">*</span>
    </label>
    <input
        type="text"
        name="phone"
        class="form-control @error('phone') is-invalid @enderror"
        placeholder="Enter phone number"
        value="{{ old('phone', $warehouse->phone ?? '') }}"
    >
    @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">
        Country <span class="text-danger">*</span>
    </label>
    <select name="country_id" class="form-select @error('country_id') is-invalid @enderror">
        <option value="">Select Country</option>
        @foreach($countries as $country)
            <option
                value="{{ $country->id }}"
                {{ old('country_id', $warehouse->country_id ?? '') == $country->id ? 'selected' : '' }}
            >
                {{ $country->name }}
            </option>
        @endforeach
    </select>
    @error('country_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">
        Governorate <span class="text-danger">*</span>
    </label>
    <select name="governorate" class="form-select @error('governorate') is-invalid @enderror">
        <option value="">Select Governorate</option>
        @foreach($governorates as $governorate)
            <option
                value="{{ $governorate }}"
                {{ old('governorate', $warehouse->governorate ?? '') == $governorate ? 'selected' : '' }}
            >
                {{ $governorate }}
            </option>
        @endforeach
    </select>
    @error('governorate')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">
        Capacity
    </label>
    <input
        type="number"
        name="capacity"
        class="form-control @error('capacity') is-invalid @enderror"
        placeholder="Enter capacity"
        value="{{ old('capacity', $warehouse->capacity ?? '') }}"
        min="1"
    >
    @error('capacity')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">
        Branches
    </label>
    <select
        name="branches[]"
        class="form-select @error('branches') is-invalid @enderror"
        multiple
        style="height: 120px;"
    >
        @foreach($branches as $branch)
            <option
                value="{{ $branch->id }}"
                {{ (isset($warehouse) && $warehouse->branches->contains($branch->id)) ? 'selected' : '' }}
            >
                {{ $branch->name }}
            </option>
        @endforeach
    </select>
    <small class="text-muted">Hold Ctrl/Cmd to select multiple branches</small>
    @error('branches')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">
        Machines
    </label>
    <select
        name="machines[]"
        class="form-select @error('machines') is-invalid @enderror"
        multiple
        style="height: 120px;"
    >
        @foreach($machines as $machine)
            <option
                value="{{ $machine->id }}"
                {{ (isset($warehouse) && $warehouse->machines->contains($machine->id)) ? 'selected' : '' }}
            >
                {{ $machine->name }}
            </option>
        @endforeach
    </select>
    <small class="text-muted">Hold Ctrl/Cmd to select multiple machines</small>
    @error('machines')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">
        Brochure (PDF / JPG / PNG)
    </label>
    <input
        type="file"
        name="brochure"
        class="form-control @error('brochure') is-invalid @enderror"
        accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png"
    >
    <small class="text-muted">
        <i class="bi bi-info-circle"></i> 
        Max size: 5MB. Allowed: PDF, JPG, JPEG, PNG
    </small>

    @if(isset($warehouse) && $warehouse->brochure)
        <div class="mt-2">
            <a href="{{ route('warehouses.download', $warehouse->id) }}" 
               class="btn btn-outline-success btn-sm">
                <i class="bi bi-download"></i> Download Current Brochure
            </a>
            <span class="text-muted ms-2">
                ({{ pathinfo($warehouse->brochure, PATHINFO_EXTENSION) }})
            </span>
        </div>
    @endif

    @error('brochure')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button class="btn btn-success">
        <i class="bi bi-check-circle"></i>
        {{ $button }}
    </button>
    <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">
        Cancel
    </a>
</div>