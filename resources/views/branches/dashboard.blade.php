<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - الأندية الرياضية</title>
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
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .topbar .brand {
            font-size: 20px;
            font-weight: bold;
            white-space: nowrap;
        }

        .topbar .search-box {
            flex: 1;
            max-width: 500px;
            position: relative;
        }

        .topbar .search-box input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border-radius: 25px;
            border: none;
            font-size: 14px;
            background: #334155;
            color: white;
        }

        .topbar .search-box input::placeholder {
            color: #94a3b8;
        }

        .topbar .search-box button {
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: #38ef7d;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            cursor: pointer;
            font-size: 16px;
        }

        .topbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            white-space: nowrap;
        }

        .topbar .user-info span {
            background: #38ef7d;
            color: #000;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .container {
            display: flex;
            min-height: calc(100vh - 60px);
        }

        .sidebar {
            width: 260px;
            background: #1e293b;
            color: white;
            padding: 20px 0;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            padding: 14px 25px;
            text-decoration: none;
            font-size: 16px;
            border-right: 4px solid transparent;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #334155;
            color: white;
            border-right-color: #38ef7d;
        }

        .sidebar .title {
            padding: 10px 25px 15px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
        }

        .main {
            flex: 1;
            padding: 30px;
        }

        .welcome-card {
            background: linear-gradient(135deg, #11998e, #38ef7d);
            color: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 30px;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card .icon {
            font-size: 40px;
            margin-bottom: 12px;
        }

        .card h3 {
            margin-bottom: 6px;
            color: #1e293b;
        }

        .card p {
            color: #64748b;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="topbar">
        <div class="brand">🏋️‍♂️ الأندية الرياضية</div>

        <div class="search-box">
            <input type="text" id="topSearch" placeholder="🔍 بحث سريع عن فرع...">
            <button onclick="searchBranch()">🔍</button>
        </div>

        <div class="user-info">
            <span>{{ auth()->user()->name ?? 'مستخدم'  }}</span>
            <span>{{ auth()->user()->role->role ?? '' }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">تسجيل خروج</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <div class="title">القائمة الرئيسية</div>
            <a href="{{ route('data.entry') }}">📋 إدخال البيانات</a>
            <a href="{{ route('edit.data') }}">✏️ تعديل البيانات</a>
            <a href="{{ route('details') }}">🔍 تفاصيل</a>
        </div>

        <div class="main">
            <div class="welcome-card">
                <h2>مرحباً، {{ auth()->user()->name ?? 'مستخدم'  }} 👋</h2>
                <p>أنت الآن في لوحة تحكم نظام الأندية الرياضية.</p>
            </div>

            <div class="cards-grid">
                <a href="{{ route('data.entry') }}" class="card">
                    <div class="icon">➕</div>
                    <h3>إدخال البيانات</h3>
                    <p>إضافة فروع جديدة</p>
                </a>
                <a href="{{ route('edit.data') }}" class="card">
                    <div class="icon">✏️</div>
                    <h3>تعديل البيانات</h3>
                    <p>تحديث المعلومات</p>
                </a>
                <a href="{{ route('details') }}" class="card">
                    <div class="icon">🔍</div>
                    <h3>تفاصيل</h3>
                    <p>عرض السجلات</p>
            </div>
        </div>
    </div>

    <script>
    function searchBranch() {
        let query = document.getElementById('topSearch').value.trim();
        if (query.length > 0) {
            window.location.href = "{{ route('branches.index') }}?search=" + encodeURIComponent(query);
        }
    }
    </script>
</body>

</html>