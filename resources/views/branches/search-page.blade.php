<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>بحث - الأندية الرياضية</title>
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
        max-width: 1000px;
        margin: 30px auto;
        padding: 20px;
    }

    .page-title {
        font-size: 28px;
        margin-bottom: 25px;
        color: #1e293b;
    }

    .search-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    .search-card h3 {
        font-size: 20px;
        margin-bottom: 15px;
        color: #1e293b;
        border-bottom: 3px solid #3b82f6;
        padding-bottom: 10px;
    }

    .search-box {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-box input {
        flex: 1;
        padding: 12px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 16px;
    }

    .search-box input:focus {
        outline: none;
        border-color: #3b82f6;
    }

    .search-box select {
        padding: 12px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        background: white;
    }

    .btn {
        background: #3b82f6;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 10px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn:hover {
        background: #2563eb;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th,
    td {
        padding: 12px;
        border-bottom: 1px solid #e2e8f0;
        text-align: right;
    }

    th {
        background: #f1f5f9;
        color: #1e293b;
        font-weight: 600;
    }

    .badge {
        background: #dbeafe;
        color: #1e40af;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px;
    }

    .tabs {
        display: flex;
        gap: 5px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .tab {
        padding: 10px 20px;
        background: #e2e8f0;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        border: none;
    }

    .tab.active {
        background: #3b82f6;
        color: white;
    }
    </style>
</head>

<body>
    <div class="topbar">
        <span class="brand">🏋️‍♂️ الأندية الرياضية</span>
        <a href="{{ route('branches.dashboard') }}">عودة للوحة التحكم</a>
    </div>

    <div class="container">
        <h1 class="page-title">📊 بحث متقدم</h1>

        <!-- بحث عن فروع -->
        <div class="search-card">
            <h3>🏢 بحث عن فرع</h3>
            <div class="search-box">
                <input type="text" placeholder="اسم الفرع، المحافظة...">
                <select>
                    <option>كل المحافظات</option>
                    <option>دمشق</option>
                    <option>حلب</option>
                    <option>حمص</option>
                </select>
                <button class="btn">بحث</button>
            </div>
            <table>
                <tr>
                    <th>الاسم</th>
                    <th>المحافظة</th>
                    <th>السعة</th>
                    <th>الهاتف</th>
                </tr>
                <tr>
                    <td>فرع دمشق - المزة</td>
                    <td>دمشق</td>
                    <td>150</td>
                    <td>0113344555</td>
                </tr>
                <tr>
                    <td>فرع حلب - الفرقان</td>
                    <td>حلب</td>
                    <td>200</td>
                    <td>0212233444</td>
                </tr>
                <tr>
                    <td>فرع حمص - الوعر</td>
                    <td>حمص</td>
                    <td>180</td>
                    <td>0314455666</td>
                </tr>
            </table>
        </div>

        <!-- بحث عن مدربين -->
        <div class="search-card">
            <h3>🏃 بحث عن مدرب</h3>
            <div class="search-box">
                <input type="text" placeholder="اسم المدرب، التخصص...">
                <button class="btn">بحث</button>
            </div>
            <table>
                <tr>
                    <th>الاسم</th>
                    <th>التخصص</th>
                    <th>الخبرة</th>
                    <th>الهاتف</th>
                </tr>
                <tr>
                    <td>أحمد علي</td>
                    <td>كمال أجسام</td>
                    <td>6 سنوات</td>
                    <td>0933555666</td>
                </tr>
                <tr>
                    <td>سامر الخطيب</td>
                    <td>لياقة بدنية</td>
                    <td>4 سنوات</td>
                    <td>0933777888</td>
                </tr>
            </table>
        </div>

        <!-- بحث عن أعضاء -->
        <div class="search-card">
            <h3>👤 بحث عن عضو</h3>
            <div class="search-box">
                <input type="text" placeholder="اسم العضو، رقم الهاتف...">
                <select>
                    <option>كل الاشتراكات</option>
                    <option>شهري</option>
                    <option>سنوي</option>
                </select>
                <button class="btn">بحث</button>
            </div>
            <table>
                <tr>
                    <th>الاسم</th>
                    <th>الهاتف</th>
                    <th>الاشتراك</th>
                    <th>تاريخ الانتهاء</th>
                </tr>
                <tr>
                    <td>محمد خالد</td>
                    <td>0944222333</td>
                    <td><span class="badge">سنوي</span></td>
                    <td>2026-01-15</td>
                </tr>
                <tr>
                    <td>رامي سعيد</td>
                    <td>0944555666</td>
                    <td><span class="badge">شهري</span></td>
                    <td>2025-08-01</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>