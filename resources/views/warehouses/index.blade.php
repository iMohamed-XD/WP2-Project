@extends('layouts.app')

@section('title', 'Warehouses')

@section('content')

<div class="container-fluid mt-5">

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Total Warehouses</h6>
                        <h2>{{ $totalWarehouses }}</h2>
                    </div>
                    <i class="bi bi-box-seam stat-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Governorates</h6>
                        <h2>{{ $totalCountries }}</h2>
                    </div>
                    <i class="bi bi-geo-alt stat-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Brochures</h6>
                        <h2>{{ $totalBrochures }}</h2>
                    </div>
                    <i class="bi bi-file-earmark-pdf stat-icon"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Warehouses Management</h2>
        <a href="{{ route('warehouses.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add Warehouse
        </a>
    </div>

    {{-- Advanced Search Card --}}
    <div class="card search-card mb-4">
        <div class="card-header bg-success text-white">
            <i class="bi bi-funnel me-2"></i>
            <strong>Advanced Search</strong>
            <span class="badge bg-light text-dark ms-2">Filter Warehouses</span>
        </div>
        <div class="card-body">
            <form action="{{ route('warehouses.index') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-bold text-secondary">
                            <i class="bi bi-search text-success"></i> Search by Name
                        </label>
                        <input type="text" name="search" class="form-control" placeholder="e.g. Damascus" value="{{ request('search') }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold text-secondary">
                            <i class="bi bi-geo-alt text-primary"></i> Governorate
                        </label>
                        <select name="governorate" class="form-select">
                            <option value="">All Governorates</option>
                            @foreach($governorates as $governorate)
                                <option value="{{ $governorate }}" {{ request('governorate') == $governorate ? 'selected' : '' }}>
                                    {{ $governorate }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold text-secondary">
                            <i class="bi bi-speedometer text-warning"></i> Min Capacity
                        </label>
                        <input type="number" name="capacity" class="form-control" placeholder="e.g. 100" value="{{ request('capacity') }}" min="1">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold text-secondary">
                            <i class="bi bi-flag text-danger"></i> Country
                        </label>
                        <select name="country_id" class="form-select">
                            <option value="">All Countries</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ request('country_id') == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-search"></i> Search
                            </button>
                            <a href="{{ route('warehouses.index') }}" class="btn btn-secondary w-100">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- View Toggle --}}
    <div class="d-flex justify-content-end mb-3">
        <div class="btn-group" role="group">
            <a href="{{ request()->fullUrlWithQuery(['view' => 'table']) }}" 
               class="btn btn-outline-primary {{ request('view') != 'grid' ? 'active' : '' }}">
                <i class="bi bi-table"></i> Table
            </a>
            <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}" 
               class="btn btn-outline-primary {{ request('view') == 'grid' ? 'active' : '' }}">
                <i class="bi bi-grid"></i> Grid
            </a>
        </div>
    </div>

    {{-- ===== TABLE VIEW ===== --}}
    <div id="tableView" style="{{ request('view') == 'grid' ? 'display: none;' : 'display: block;' }}">
        <div class="card shadow-sm w-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Governorate</th>
                                <th>Country</th>
                                <th>Location</th>
                                <th>Phone</th>
                                <th>Capacity</th>
                                <th>Branches</th>
                                <th>Brochure</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($warehouses as $warehouse)
                                <tr>
                                    <td>{{ $warehouse->id }}</td>
                                    <td>{{ $warehouse->name }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $warehouse->governorate }}</span>
                                    </td>
                                    <td>{{ $warehouse->country->name ?? 'N/A' }}</td>
                                    <td>{{ $warehouse->location }}</td>
                                    <td>{{ $warehouse->phone }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $warehouse->capacity ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        @if($warehouse->branches->count() > 0)
                                            @foreach($warehouse->branches as $branch)
                                                <span class="badge bg-primary">{{ $branch->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No Branches</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($warehouse->brochure)
                                            <a href="{{ route('warehouses.download', $warehouse->id) }}" 
                                            class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                            <span class="text-muted" style="font-size: 11px; color: #B5B5B5 !important;">
                                                ({{ pathinfo($warehouse->brochure, PATHINFO_EXTENSION) }})
                                            </span>
                                        @else
                                            <span class="text-muted" style="color: #B5B5B5 !important;">No File</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-outline-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this warehouse permanently?')">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <div class="py-4">
                                            <i class="bi bi-box-seam fs-1 text-secondary"></i>
                                            <p class="mt-2">No Warehouses Found</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $warehouses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== GRID VIEW ===== --}}
    <div id="gridView" style="{{ request('view') == 'grid' ? 'display: block;' : 'display: none;' }}">
        <div class="row g-4">
            @forelse($warehouses as $warehouse)
                <div class="col-md-4 col-lg-3">
                    <div class="card warehouse-grid-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $warehouse->name }}</h5>
                            <hr>
                            <p class="card-text">
                                <strong>Governorate:</strong>
                                <span class="badge bg-info">{{ $warehouse->governorate }}</span>
                            </p>
                            <p class="card-text">
                                <strong>Country:</strong> {{ $warehouse->country->name ?? 'N/A' }}
                            </p>
                            <p class="card-text">
                                <strong>Location:</strong> {{ $warehouse->location }}
                            </p>
                            <p class="card-text">
                                <strong>Phone:</strong> {{ $warehouse->phone }}
                            </p>
                            <p class="card-text">
                                <strong>Capacity:</strong>
                                <span class="badge bg-secondary">{{ $warehouse->capacity ?? 'N/A' }}</span>
                            </p>

                            <p class="card-text">
                                <strong>Branches:</strong>
                                @if($warehouse->branches->count() > 0)
                                    @foreach($warehouse->branches as $branch)
                                        <span class="badge bg-primary">{{ $branch->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No Branches</span>
                                @endif
                            </p>

                            @if($warehouse->brochure)
                                <a href="{{ route('warehouses.download', $warehouse->id) }}" 
                                class="btn btn-outline-success btn-sm w-100 mt-2">
                                    <i class="bi bi-download"></i> Download Brochure
                                </a>
                                <small class="text-muted d-block text-center mt-1">
                                    ({{ pathinfo($warehouse->brochure, PATHINFO_EXTENSION) }})
                                </small>
                            @endif                       
                        </div>
                        
                        <div class="card-footer bg-transparent">
                            <div class="d-flex gap-2">
                                <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-outline-warning btn-sm flex-grow-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this warehouse permanently?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-box-seam fs-1 text-secondary"></i>
                    <p class="mt-2">No Warehouses Found</p>
                </div>
            @endforelse
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $warehouses->links() }}
        </div>
    </div>

</div>

@endsection