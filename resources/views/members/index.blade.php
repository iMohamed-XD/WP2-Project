<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Members List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            background: linear-gradient(rgba(20, 30, 48, 0.8), rgba(36, 59, 85, 0.8)), url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=2070&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            padding: 40px;
            font-family: 'Segoe UI', sans-serif;
        }
        .card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); background: rgba(255, 255, 255, 0.95); }
        .btn-add { background: #ff5858; color: white; border-radius: 10px; font-weight: bold; }
        .btn-action { padding: 5px 10px; border-radius: 8px; transition: 0.3s; }
    </style>
</head>
<body>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 text-white">
        <h2><i class="fa-solid fa-users"></i> Member Directory</h2>
        <a href="/members/create" class="btn btn-add"><i class="fa-solid fa-user-plus"></i> Add New Member</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- فورم الفلترة -->
    <div class="card p-3 mb-4 bg-light">
        <form action="/members" method="GET" class="row g-2">
            <div class="col-md-2">
                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ request('first_name') }}">
            </div>
            <div class="col-md-2">
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ request('last_name') }}">
            </div>
            <div class="col-md-2">
                <input type="text" name="national_id" class="form-control" placeholder="National ID" value="{{ request('national_id') }}">
            </div>
            <div class="col-md-3">
                <select name="member_status_id" class="form-select">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ request('member_status_id') == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                <a href="/members" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>
    </div>

    <div class="card p-4">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Full Name</th>
                    <th>National ID</th>
                    <th>Package</th>
                    <th>Status</th>
                    <th>Remaining</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                <tr>
                    <td>
                        @if(!empty($member->photo))
                            <img src="{{ asset('storage/' . $member->photo) }}" width="45" height="45" style="border-radius:50%; object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($member->first_name . ' ' . $member->last_name) }}&background=random&size=128" 
                                 width="45" height="45" style="border-radius:50%;">
                        @endif
                    </td>
                    <td><strong>{{ $member->first_name }} {{ $member->father_name }} {{ $member->last_name }}</strong></td>
                    <td>{{ $member->national_id }}</td>
                    
                    <td><span class="badge bg-info text-dark">{{ $member->membershipType->name ?? 'N/A' }}</span></td>
                    
                    <td>
                        @if($member->memberStatus->name == 'Frozen')
                            <span class="text-secondary fw-bold"><i class="fa-solid fa-snowflake"></i> Frozen</span>
                        @elseif($member->memberStatus->name == 'Expired')
                            <span class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> Expired</span>
                        @else
                            <span class="text-success fw-bold"><i class="fa-solid fa-circle-check"></i> Active</span>
                        @endif
                    </td>

                    <td>
                        @php
                            $start = \Carbon\Carbon::parse($member->created_at);
                            $end = $start->copy()->addMonths($member->membership_duration ?? 0);
                            $days_remaining = \Carbon\Carbon::now()->diffInDays($end, false);
                        @endphp
                        @if($days_remaining >= 0)
                            <span class="badge bg-warning text-dark">{{ (int)$days_remaining }} Days</span>
                        @else
                            <span class="text-muted">Expired</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <!-- زر العرض الجديد -->
                        <a href="/members/{{ $member->id }}" class="btn btn-outline-info btn-action" title="View Profile">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="/members/{{ $member->id }}/edit" class="btn btn-outline-primary btn-action" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="/members/{{ $member->id }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-action" onclick="return confirm('Are you sure?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>