<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>قائمة الفروع - الأندية الرياضية</title>
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
        padding: 20px;
    }

    .container {
        max-width: 1200px;
        margin: auto;
    }

    h1 {
        margin-bottom: 20px;
        color: #1e293b;
    }

    .alert {
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        color: white;
        display: inline-block;
        margin: 5px;
    }

    .btn-primary {
        background: #007bff;
    }

    .btn-success {
        background: #28a745;
    }

    .btn-danger {
        background: #dc3545;
    }

    .btn-warning {
        background: #ffc107;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
    }

    th,
    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        text-align: right;
    }

    th {
        background: #f1f5f9;
    }

    .topbar {
        background: #1e293b;
        color: white;
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-radius: 10px;
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
        <span>🏋️‍♂️ الأندية الرياضية</span>
        <a href="{{ route('branches.dashboard') }}">عودة للوحة التحكم</a>
    </div>

    <div class="container">
        <h1>📋 قائمة الفروع</h1>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('branches.create') }}" class="btn btn-success">➕ إضافة فرع جديد</a>

        <table>
            <tr>
                <th>الاسم</th>
                <th>المحافظة</th>
                <th>الهاتف</th>
                <th>السعة</th>
                <th>خيارات</th>
            </tr>
            @foreach($branches as $branch)
            <tr>
                <td>{{ $branch->name }}</td>
                <td>{{ $branch->country->name }}</td>
                <td>{{ $branch->phone }}</td>
                <td>{{ $branch->capacity }}</td>
                <td>
                    <a href="{{ route('branches.show', $branch) }}" class="btn btn-primary">عرض</a>
                    <a href="{{ route('branches.edit', $branch) }}" class="btn btn-warning">تعديل</a>
                    <form action="{{ route('branches.destroy', $branch) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('متأكد؟')">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        {{ $branches->links() }}
    </div>
</body>

</html>