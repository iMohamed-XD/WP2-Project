<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>إضافة فرع جديد - الأندية الرياضية</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma;
        background: #f4f6f9;
        direction: rtl;
    }

    .topbar {
        background: #1e293b;
        color: white;
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .topbar .brand {
        font-size: 20px;
        font-weight: bold;
    }

    .topbar a {
        color: white;
        text-decoration: none;
        background: #ef4444;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
    }

    .container {
        max-width: 700px;
        margin: 30px auto;
        padding: 20px;
    }

    .page-title {
        font-size: 28px;
        margin-bottom: 25px;
        color: #1e293b;
    }

    .form-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #333;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-size: 14px;
        background: #fafafa;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    .btn {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
        text-decoration: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-size: 16px;
        margin-right: 10px;
    }

    .alert {
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background: #ffe3e3;
        color: #c62828;
    }

    .error {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }
    </style>
</head>

<body>
    <div class="topbar">
        <span class="brand">🏋️‍♂️ الأندية الرياضية</span>
        <a href="{{ route('branches.dashboard') }}">عودة للوحة التحكم</a>
    </div>

    <div class="container">
        <h1 class="page-title">➕ إضافة فرع جديد</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <div class="form-card">
            <form method="POST" action="{{ route('branches.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>اسم الفرع *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                    @error('name') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>المحافظة *</label>
                    <select name="country_id" required>
                        <option value="">اختر المحافظة</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('country_id') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>الموقع *</label>
                    <textarea name="location" required>{{ old('location') }}</textarea>
                    @error('location') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>رقم الهاتف *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required>
                    @error('phone') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>السعة *</label>
                    <input type="number" name="capacity" value="{{ old('capacity') }}" min="1" required>
                    @error('capacity') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>ملف البروشور (PDF أو صورة)</label>
                    <input type="file" name="brochure" accept=".pdf,.jpg,.jpeg,.png">
                    @error('brochure') <div class="error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn">💾 حفظ الفرع</button>
                <a href="{{ route('branches.index') }}" class="btn-secondary">❌ إلغاء</a>
            </form>
        </div>
    </div>
</body>

</html>