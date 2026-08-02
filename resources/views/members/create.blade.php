<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members Management - Add New Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(rgba(20, 30, 48, 0.75), rgba(36, 59, 85, 0.75)), url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
            font-family: 'Segoe UI', sans-serif;
        }
        .wrapper-container { width: 100%; max-width: 650px; }
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5); background-color: rgba(255, 255, 255, 0.95); }
        .card-header-custom { background: linear-gradient(45deg, #f857a6 0%, #ff5858 100%); color: white; padding: 25px; text-align: center; border-radius: 20px 20px 0 0; }
        .form-label { font-weight: 600; color: #243b55; margin-bottom: 6px; }
        .input-group-text { background-color: #f8f9fa; color: #ff5858; border-right: none; }
        .btn-submit { background: linear-gradient(45deg, #f857a6 0%, #ff5858 100%); border: none; color: white; font-weight: bold; padding: 12px; border-radius: 10px; width: 100%; }
        .btn-back { background-color: #e9ecef; color: #495057; width: 100%; padding: 12px; border-radius: 10px; text-decoration: none; display: block; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>

<div class="wrapper-container">
    <div class="card card-custom">
        <div class="card-header-custom">
            <i class="fa-solid fa-dumbbell fa-2x"></i>
            <h4 class="mt-2">Gym Management System</h4>
            <p class="mb-0 text-white-50 small">Block 2 - Add New Member Portal</p>
        </div>
        
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="/members" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">First Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="e.g. John" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Father's Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-user-tag"></i></span>
                            <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}" placeholder="e.g. Smith" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Last Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-users"></i></span>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="e.g. Doe" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="example@domain.com" required>
                        </div>
                    </div>
                    <!-- حقل تاريخ الميلاد مع قيود 18-70 سنة -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Birth Date <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                            <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}" 
                                   min="{{ date('Y-m-d', strtotime('-70 years')) }}" 
                                   max="{{ date('Y-m-d', strtotime('-18 years')) }}" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">National ID <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-fingerprint"></i></span>
                        <input type="text" name="national_id" class="form-control" value="{{ old('national_id') }}" placeholder="Enter 11 digits" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="09xxxxxxxx" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Membership Package <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-gem"></i></span>
                        <select name="membership_type_id" class="form-select" required>
                            <option value="">Select Package</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subscription Duration <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                        <select name="membership_duration" class="form-select" required>
                            <option value="" disabled selected>Choose Duration...</option>
                            <option value="1">1 Month</option>
                            <option value="2">2 Months</option>
                            <option value="3">3 Months</option>
                            <option value="6">6 Months</option>
                            <option value="12">1 Year</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class="fa-solid fa-camera me-1"></i> Profile Photo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>
                </div>

                <button type="submit" class="btn btn-submit"><i class="fa-solid fa-check-circle me-2"></i> Save New Member</button>
                <a href="/members" class="btn btn-back"><i class="fa-solid fa-xmark me-2"></i> Cancel & Return Home</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>