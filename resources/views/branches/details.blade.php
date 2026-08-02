<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>تفاصيل النادي - الأندية الرياضية</title>
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
        max-width: 1100px;
        margin: 30px auto;
        padding: 20px;
    }

    .page-title {
        font-size: 28px;
        margin-bottom: 20px;
        color: #1e293b;
    }

    .card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    .card h3 {
        font-size: 20px;
        margin-bottom: 15px;
        color: #1e293b;
        border-bottom: 3px solid #38ef7d;
        padding-bottom: 10px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .info-item {
        padding: 10px;
        background: #f8fafc;
        border-radius: 8px;
    }

    .info-item strong {
        color: #1e293b;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
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
        background: #38ef7d;
        color: #000;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .badge-yellow {
        background: #fbbf24;
    }

    .badge-red {
        background: #ef4444;
        color: white;
    }

    .week-table {
        margin-top: 15px;
        overflow-x: auto;
    }

    .week-table table {
        min-width: 700px;
    }
    </style>
</head>

<body>
    <div class="topbar">
        <span class="brand">🏋️‍♂️ نادي القوة الرياضي</span>
        <a href="{{ route('branches.dashboard') }}">عودة للوحة التحكم</a>
    </div>

    <div class="container">
        <h1 class="page-title">🔍 تفاصيل النادي</h1>

        <!-- معلومات النادي -->
        <div class="card">
            <h3>📋 معلومات عامة</h3>
            <div class="info-grid">
                <div class="info-item"><strong>الاسم:</strong> نادي القوة الرياضي</div>
                <div class="info-item"><strong>المحافظة:</strong> دمشق</div>
                <div class="info-item"><strong>الهاتف:</strong> 011-1234567</div>
                <div class="info-item"><strong>العنوان:</strong> شارع النصر، المزة</div>
                <div class="info-item"><strong>تاريخ التأسيس:</strong> 2015</div>
                <div class="info-item"><strong>عدد الأعضاء:</strong> 450</div>
            </div>
        </div>

        <!-- المدربين -->
        <div class="card">
            <h3>🏃 المدربين</h3>
            <table>
                <tr>
                    <th>الاسم</th>
                    <th>التخصص</th>
                    <th>الخبرة</th>
                    <th>الحالة</th>
                </tr>
                <tr>
                    <td>أحمد علي</td>
                    <td>كمال أجسام</td>
                    <td>6 سنوات</td>
                    <td><span class="badge">نشط</span></td>
                </tr>
                <tr>
                    <td>سامر الخطيب</td>
                    <td>لياقة بدنية</td>
                    <td>4 سنوات</td>
                    <td><span class="badge">نشط</span></td>
                </tr>
                <tr>
                    <td>نور الهدى</td>
                    <td>يوغا</td>
                    <td>3 سنوات</td>
                    <td><span class="badge badge-yellow">إجازة</span></td>
                </tr>
            </table>
        </div>

        <!-- الحصص التدريبية (5 أسابيع) -->
        <div class="card">
            <h3>📅 جدول الحصص التدريبية (5 أسابيع)</h3>
            <div class="week-table">
                <table>
                    <tr>
                        <th>الأسبوع</th>
                        <th>السبت</th>
                        <th>الأحد</th>
                        <th>الاثنين</th>
                        <th>الثلاثاء</th>
                        <th>الأربعاء</th>
                        <th>الخميس</th>
                    </tr>
                    <tr>
                        <td>الأول (1-7)</td>
                        <td>كمال أجسام<br>أحمد</td>
                        <td>لياقة<br>سامر</td>
                        <td>يوغا<br>نور</td>
                        <td>راحة</td>
                        <td>كارديو<br>أحمد</td>
                        <td>لياقة<br>سامر</td>
                    </tr>
                    <tr>
                        <td>الثاني (8-14)</td>
                        <td>كمال أجسام<br>أحمد</td>
                        <td>راحة</td>
                        <td>يوغا<br>نور</td>
                        <td>لياقة<br>سامر</td>
                        <td>كارديو<br>أحمد</td>
                        <td>يوغا<br>نور</td>
                    </tr>
                    <tr>
                        <td>الثالث (15-21)</td>
                        <td>راحة</td>
                        <td>لياقة<br>سامر</td>
                        <td>كمال أجسام<br>أحمد</td>
                        <td>يوغا<br>نور</td>
                        <td>راحة</td>
                        <td>كارديو<br>أحمد</td>
                    </tr>
                    <tr>
                        <td>الرابع (22-28)</td>
                        <td>كمال أجسام<br>أحمد</td>
                        <td>يوغا<br>نور</td>
                        <td>لياقة<br>سامر</td>
                        <td>كارديو<br>أحمد</td>
                        <td>يوغا<br>نور</td>
                        <td>راحة</td>
                    </tr>
                    <tr>
                        <td>الخامس (29-31)</td>
                        <td>لياقة<br>سامر</td>
                        <td>كمال أجسام<br>أحمد</td>
                        <td>راحة</td>
                        <td>يوغا<br>نور</td>
                        <td>كارديو<br>أحمد</td>
                        <td>لياقة<br>سامر</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- الأجهزة -->
        <div class="card">
            <h3>🔧 الأجهزة الرياضية</h3>
            <table>
                <tr>
                    <th>الجهاز</th>
                    <th>الكمية</th>
                    <th>الحالة</th>
                    <th>آخر صيانة</th>
                </tr>
                <tr>
                    <td>جهاز مشي</td>
                    <td>5</td>
                    <td><span class="badge">ممتاز</span></td>
                    <td>2025-06-01</td>
                </tr>
                <tr>
                    <td>دراجة ثابتة</td>
                    <td>8</td>
                    <td><span class="badge">جيد</span></td>
                    <td>2025-05-15</td>
                </tr>
                <tr>
                    <td>أثقال حرة</td>
                    <td>12</td>
                    <td><span class="badge">جيد</span></td>
                    <td>2025-06-10</td>
                </tr>
                <tr>
                    <td>جهاز تجديف</td>
                    <td>2</td>
                    <td><span class="badge badge-red">معطل</span></td>
                    <td>2025-04-20</td>
                </tr>
            </table>
        </div>

        <!-- المستهلكات -->
        <div class="card">
            <h3>📦 المستهلكات</h3>
            <table>
                <tr>
                    <th>المادة</th>
                    <th>الكمية</th>
                    <th>تاريخ الصلاحية</th>
                    <th>ملاحظات</th>
                </tr>
                <tr>
                    <td>بروتين بودرة</td>
                    <td>30 كغ</td>
                    <td>2025-08-01</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>ماء معدني</td>
                    <td>200 عبوة</td>
                    <td>2025-12-30</td>
                    <td>عبوات 500 مل</td>
                </tr>
                <tr>
                    <td>مناشف ورقية</td>
                    <td>50 لفة</td>
                    <td>غير محدد</td>
                    <td>مخزون كافٍ</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>