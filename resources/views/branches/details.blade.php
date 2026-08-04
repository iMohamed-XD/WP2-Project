<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل الفروع - الأندية الرياضية</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma; background: #f4f6f9; direction: rtl; }

        .topbar {
            background: #1e293b; color: white; padding: 15px 30px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .topbar .brand { font-size: 20px; font-weight: bold; }
        .topbar a {
            color: white; text-decoration: none; background: #ef4444;
            padding: 8px 16px; border-radius: 8px; font-size: 14px;
        }

        .container { max-width: 1100px; margin: 30px auto; padding: 20px; }
        .page-title { font-size: 28px; margin-bottom: 20px; color: #1e293b; }

        .card {
            background: white; border-radius: 16px; padding: 25px;
            margin-bottom: 25px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .card h3 {
            font-size: 20px; margin-bottom: 15px; color: #1e293b;
            border-bottom: 3px solid #38ef7d; padding-bottom: 10px;
        }
        .card h4 { font-size: 16px; margin-bottom: 10px; color: #1e293b; }

        .info-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px; margin-bottom: 10px;
        }
        .info-item { padding: 10px; background: #f8fafc; border-radius: 8px; }
        .info-item strong { color: #1e293b; }

        table { width: 100%; border-collapse: collapse; margin: 10px 0 20px; }
        th, td { padding: 10px; border-bottom: 1px solid #e2e8f0; text-align: right; }
        th { background: #f1f5f9; color: #1e293b; font-weight: 600; }

        .badge {
            display: inline-block; background: #dbeafe; color: #1e40af;
            padding: 4px 12px; border-radius: 20px; font-size: 13px; margin: 2px;
        }
        .empty-note { color: #64748b; font-size: 14px; margin-bottom: 15px; }

        .btn {
            display: inline-block; text-decoration: none; padding: 8px 18px;
            border-radius: 8px; font-size: 14px; color: white; margin-left: 8px;
        }
        .btn-primary { background: #3b82f6; }
        .btn-warning { background: #f59e0b; color: #000; }

        .pagination-wrap { display: flex; justify-content: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="topbar">
        <span class="brand">🏋️‍♂️ الأندية الرياضية</span>
        <a href="{{ route('branches.dashboard') }}">عودة للوحة التحكم</a>
    </div>

    <div class="container">
        <h1 class="page-title">🔍 تفاصيل الفروع ({{ $branches->total() }})</h1>

        @if($branches->isEmpty())
            <div class="card"><p class="empty-note">لا توجد فروع مسجلة حالياً.</p></div>
        @endif

        @foreach($branches as $branch)
            <div class="card">
                <h3>{{ $branch->name }}</h3>

                <div class="info-grid">
                    <div class="info-item"><strong>المحافظة:</strong> {{ $branch->governorate ?? '-' }}</div>
                    <div class="info-item"><strong>الدولة:</strong> {{ $branch->country->name ?? '-' }}</div>
                    <div class="info-item"><strong>الهاتف:</strong> {{ $branch->phone ?? '-' }}</div>
                    <div class="info-item"><strong>الموقع:</strong> {{ $branch->location ?? '-' }}</div>
                    <div class="info-item"><strong>السعة:</strong> {{ $branch->capacity }}</div>
                </div>

                <h4>🏃 المدربون ({{ $branch->trainers->count() }})</h4>
                @if($branch->trainers->isEmpty())
                    <p class="empty-note">لا يوجد مدربون معينون لهذا الفرع.</p>
                @else
                    <table>
                        <tr><th>الاسم</th><th>التخصص</th><th>سنوات الخبرة</th></tr>
                        @foreach($branch->trainers as $trainer)
                            <tr>
                                <td>{{ $trainer->firstname }} {{ $trainer->lastname }}</td>
                                <td>{{ $trainer->sportsType->type ?? '-' }}</td>
                                <td>{{ $trainer->years_of_experience }}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif

                <h4>🏋️ الحصص التدريبية ({{ $branch->workouts->count() }})</h4>
                @if($branch->workouts->isEmpty())
                    <p class="empty-note">لا توجد حصص مرتبطة بهذا الفرع.</p>
                @else
                    <div style="margin-bottom: 15px;">
                        @foreach($branch->workouts as $workout)
                            <span class="badge">{{ $workout->name }}</span>
                        @endforeach
                    </div>
                @endif

                <div>
                    <a href="{{ route('branches.show', $branch) }}" class="btn btn-primary">عرض الملف الكامل</a>
                    <a href="{{ route('branches.edit', $branch) }}" class="btn btn-warning">تعديل / تعيين مدربين</a>
                </div>
            </div>
        @endforeach

        <div class="pagination-wrap">
            {{ $branches->links('pagination::bootstrap-5') }}
        </div>
    </div>
</body>
</html>