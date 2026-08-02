<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Profile - {{ $member->first_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background: #f4f7f6; padding: 40px; }
        .profile-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; }
        .card-header-custom { 
            background: linear-gradient(rgba(26, 42, 108, 0.8), rgba(178, 31, 31, 0.8)); 
            color: white; 
            padding: 30px; 
            text-align: center; 
        }
        .info-label { color: #6c757d; font-size: 0.85rem; text-transform: uppercase; font-weight: bold; }
        .info-value { font-size: 1.1rem; color: #243b55; margin-bottom: 20px; font-weight: 500; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card profile-card">
                <!-- Header مع صورة العضو -->
                <div class="card-header-custom">
                    @if(!empty($member->photo))
                        <img src="{{ asset('storage/' . $member->photo) }}" 
                             class="rounded-circle border border-white shadow mb-3" 
                             style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <i class="fa-solid fa-user-circle fa-5x mb-3"></i>
                    @endif
                    
                    <h2 class="mt-2">{{ $member->first_name }} {{ $member->father_name }} {{ $member->last_name }}</h2>
                    <span class="badge bg-light text-dark">ID: {{ $member->national_id }}</span>
                </div>
                
                <div class="card-body p-4">
                    <div class="row">
                        <!-- القسم الأول: معلومات شخصية -->
                        <div class="col-md-6">
                            <h5 class="mb-3 text-primary"><i class="fa-solid fa-id-card"></i> Personal Info</h5>
                            <p class="info-label">Email</p><p class="info-value">{{ $member->email }}</p>
                            <p class="info-label">Phone</p><p class="info-value">{{ $member->phone }}</p>
                            <p class="info-label">Date of Birth</p><p class="info-value">{{ $member->birth_date }}</p>
                        </div>
                        
                        <!-- القسم الثاني: معلومات الاشتراك -->
                        <div class="col-md-6">
                            <h5 class="mb-3 text-primary"><i class="fa-solid fa-dumbbell"></i> Subscription</h5>
                            <p class="info-label">Package</p><p class="info-value">{{ $member->membershipType->name ?? 'N/A' }}</p>
                            <p class="info-label">Start Date</p><p class="info-value">{{ $member->created_at->format('Y-m-d') }}</p>
                            <p class="info-label">Expiry Date</p>
                            <p class="info-value text-danger fw-bold">
                                {{ $member->created_at->addMonths($member->membership_duration ?? 0)->format('Y-m-d') }}
                            </p>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="/members" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-2"></i>Back</a>
                        <a href="/members/{{ $member->id }}/edit" class="btn btn-warning"><i class="fa-solid fa-edit me-2"></i>Edit Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>