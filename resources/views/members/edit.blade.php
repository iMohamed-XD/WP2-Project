<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            background: linear-gradient(rgba(20, 30, 48, 0.8), rgba(36, 59, 85, 0.8)), url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            padding: 40px;
            font-family: 'Segoe UI', sans-serif;
        }
        .card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); background: rgba(255, 255, 255, 0.95); }
        .btn-primary { background: #0d6efd; border-radius: 10px; font-weight: bold; }
    </style>
</head>
<body>

<div class="container" style="max-width: 600px;">
    <div class="card p-4">
        <h4 class="mb-4"><i class="fa-solid fa-pen-to-square"></i> Edit Member Information</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- إضافة enctype للتمكن من رفع الصور -->
        <form action="/members/{{ $member->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 

            <!-- قسم الصورة -->
            <div class="mb-3 text-center">
                @if(!empty($member->image))
                    <img src="{{ asset('storage/' . $member->image) }}" width="120" height="120" class="mb-2" style="border-radius:50%; object-fit: cover; border: 3px solid #eee;">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($member->first_name . ' ' . $member->last_name) }}&background=random&size=128" 
                         width="120" height="120" class="mb-2" style="border-radius:50%; border: 3px solid #eee;">
                @endif
                <div class="mt-2">
                    <label class="form-label">Change Profile Picture</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $member->first_name) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Father's Name</label>
                    <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $member->father_name) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $member->last_name) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">National ID</label>
                <input type="text" name="national_id" class="form-control" value="{{ old('national_id', $member->national_id) }}" maxlength="11" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="phone" class="form-control" value="{{ old('phone', $member->phone) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Membership Package</label>
                <select name="membership_type" class="form-select">
                    <option value="Regular" {{ (old('membership_type', $member->membership_type) == 'Regular') ? 'selected' : '' }}>Regular</option>
                    <option value="VIP" {{ (old('membership_type', $member->membership_type) == 'VIP') ? 'selected' : '' }}>VIP</option>
                    <option value="Annual" {{ (old('membership_type', $member->membership_type) == 'Annual') ? 'selected' : '' }}>Annual</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Subscription Duration (Months)</label>
                <select name="membership_duration" class="form-select" required>
                    <option value="1" {{ old('membership_duration', $member->membership_duration) == '1' ? 'selected' : '' }}>1 Month</option>
                    <option value="2" {{ old('membership_duration', $member->membership_duration) == '2' ? 'selected' : '' }}>2 Months</option>
                    <option value="3" {{ old('membership_duration', $member->membership_duration) == '3' ? 'selected' : '' }}>3 Months</option>
                    <option value="6" {{ old('membership_duration', $member->membership_duration) == '6' ? 'selected' : '' }}>6 Months</option>
                    <option value="12" {{ old('membership_duration', $member->membership_duration) == '12' ? 'selected' : '' }}>1 Year</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Membership Status</label>
                <select name="status" class="form-select" required>
                    <option value="Active" {{ old('status', $member->status) == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Expired" {{ old('status', $member->status) == 'Expired' ? 'selected' : '' }}>Expired</option>
                    <option value="Frozen" {{ old('status', $member->status) == 'Frozen' ? 'selected' : '' }}>Frozen</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
            <a href="/members" class="btn btn-secondary w-100 mt-2"><i class="fa-solid fa-arrow-left"></i> Cancel</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>