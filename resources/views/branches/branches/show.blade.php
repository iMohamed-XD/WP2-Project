<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>تفاصيل الفرع</title>
    <style>
    body {
        font-family: Arial;
        direction: rtl;
        background: #f4f6f9;
        padding: 30px;
    }

    .container {
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
    }

    .topbar {
        background: #1e293b;
        color: white;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .topbar a {
        color: white;
        text-decoration: none;
        background: #ef4444;
        padding: 8px 16px;
        border-radius: 8px;
    }

    p {
        margin: 10px 0;
    }
    </style>
</head>

<body>
    <div class="topbar">
        <span>🏋️‍♂️ تفاصيل الفرع</span>
        <a href="{{ route('branches.index') }}">عودة للقائمة</a>
    </div>
    <div class="container">
        <h2>{{ $branch->name }}</h2>
        <p><strong>المحافظة:</strong> {{ $branch->country->name }}</p>
        <p><strong>الموقع:</strong> {{ $branch->location }}</p>
        <p><strong>الهاتف:</strong> {{ $branch->phone }}</p>
        <p><strong>السعة:</strong> {{ $branch->capacity }}</p>
    </div>
</body>

</html>