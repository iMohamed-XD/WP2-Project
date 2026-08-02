<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>تعديل فرع</title>
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

    input,
    select,
    textarea {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
    }

    button {
        background: #f59e0b;
        color: black;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
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
    </style>
</head>

<body>
    <div class="topbar">
        <span>🏋️‍♂️ تعديل الفرع</span>
        <a href="{{ route('branches.index') }}">عودة للقائمة</a>
    </div>
    <div class="container">
        <h2>تعديل: {{ $branch->name }}</h2>
        <form method="POST" action="{{ route('branches.update', $branch) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <label>اسم الفرع</label>
            <input type="text" name="name" value="{{ $branch->name }}" required>

            <label>المحافظة</label>
            <select name="country_id" required>
                @foreach($countries as $c)
                <option value="{{ $c->id }}" {{ $branch->country_id == $c->id ? 'selected' : '' }}>{{ $c->name }}
                </option>
                @endforeach
            </select>

            <label>الموقع</label>
            <textarea name="location" required>{{ $branch->location }}</textarea>

            <label>الهاتف</label>
            <input type="text" name="phone" value="{{ $branch->phone }}" required>

            <label>السعة</label>
            <input type="number" name="capacity" value="{{ $branch->capacity }}" required>

            <label>البروشور (اختياري)</label>
            <input type="file" name="brochure">

            <button type="submit">تحديث</button>
        </form>
    </div>
</body>

</html>