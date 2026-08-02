<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>إدخال البيانات - الأندية الرياضية</title>
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
        max-width: 900px;
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
        margin-bottom: 25px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    .form-card h3 {
        font-size: 20px;
        margin-bottom: 20px;
        color: #1e293b;
        border-bottom: 3px solid #38ef7d;
        padding-bottom: 10px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
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

    .btn-blue {
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
    }

    .btn-orange {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: #000;
    }

    .btn-purple {
        background: linear-gradient(135deg, #8b5cf6, #a78bfa);
    }

    .section-title {
        background: #f1f5f9;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        cursor: pointer;
        font-weight: bold;
        font-size: 18px;
    }

    .collapsible-content {
        display: none;
    }

    .collapsible-content.show {
        display: block;
    }
    </style>
</head>

<body>
    <div class="topbar">
        <span class="brand">🏋️‍♂️ الأندية الرياضية</span>
        <a href="{{ route('branches.dashboard') }}">عودة للوحة التحكم</a>
    </div>

    <div class="container">
        <h1 class="page-title">📋 إدخال البيانات</h1>

        <!-- إضافة فرع -->
        <div class="form-card">
            <div class="section-title" onclick="toggleSection(this)">🏢 إضافة فرع جديد ▾</div>
            <div class="collapsible-content show">
                <div class="form-row">
                    <div class="form-group"><label>اسم الفرع</label><input type="text" placeholder="أدخل اسم الفرع">
                    </div>
                    <div class="form-group">
                        <label>المحافظة</label>
                        <select>
                            <option>اختر المحافظة</option>
                            <option>دمشق</option>
                            <option>حلب</option>
                            <option>حمص</option>
                            <option>اللاذقية</option>
                        </select>
                    </div>
                    <div class="form-group"><label>السعة</label><input type="number" placeholder="عدد الأعضاء"></div>
                    <div class="form-group"><label>الهاتف</label><input type="text" placeholder="رقم الهاتف"></div>
                </div>
                <div class="form-group"><label>العنوان</label><textarea placeholder="العنوان التفصيلي"></textarea></div>
                <button class="btn">حفظ الفرع</button>
            </div>
        </div>

        <!-- إضافة مدرب -->
        <div class="form-card">
            <div class="section-title" onclick="toggleSection(this)">🏃 إضافة مدرب جديد ▾</div>
            <div class="collapsible-content">
                <div class="form-row">
                    <div class="form-group"><label>اسم المدرب</label><input type="text" placeholder="الاسم الكامل">
                    </div>
                    <div class="form-group"><label>التخصص</label><input type="text" placeholder="مثال: كمال أجسام">
                    </div>
                    <div class="form-group"><label>سنوات الخبرة</label><input type="number" placeholder="عدد السنوات">
                    </div>
                    <div class="form-group"><label>رقم الهاتف</label><input type="text" placeholder="رقم الجوال"></div>
                </div>
                <div class="form-group"><label>الشهادات</label><textarea placeholder="الشهادات المهنية"></textarea>
                </div>
                <button class="btn btn-blue">حفظ المدرب</button>
            </div>
        </div>

        <!-- إضافة عضو -->
        <div class="form-card">
            <div class="section-title" onclick="toggleSection(this)">👤 إضافة عضو جديد ▾</div>
            <div class="collapsible-content">
                <div class="form-row">
                    <div class="form-group"><label>اسم العضو</label><input type="text" placeholder="الاسم الكامل"></div>
                    <div class="form-group"><label>تاريخ الميلاد</label><input type="date"></div>
                    <div class="form-group"><label>رقم الهاتف</label><input type="text" placeholder="رقم الجوال"></div>
                    <div class="form-group">
                        <label>نوع الاشتراك</label>
                        <select>
                            <option>شهري</option>
                            <option>ربع سنوي</option>
                            <option>نصف سنوي</option>
                            <option>سنوي</option>
                        </select>
                    </div>
                </div>
                <div class="form-group"><label>العنوان</label><textarea placeholder="عنوان السكن"></textarea></div>
                <button class="btn btn-orange">حفظ العضو</button>
            </div>
        </div>

        <!-- إضافة جهاز -->
        <div class="form-card">
            <div class="section-title" onclick="toggleSection(this)">🔧 إضافة جهاز رياضي ▾</div>
            <div class="collapsible-content">
                <div class="form-row">
                    <div class="form-group"><label>اسم الجهاز</label><input type="text" placeholder="مثال: جهاز مشي">
                    </div>
                    <div class="form-group"><label>الكمية</label><input type="number" placeholder="عدد الأجهزة"></div>
                    <div class="form-group">
                        <label>الحالة</label>
                        <select>
                            <option>جديد</option>
                            <option>ممتاز</option>
                            <option>جيد</option>
                            <option>يحتاج صيانة</option>
                        </select>
                    </div>
                    <div class="form-group"><label>تاريخ آخر صيانة</label><input type="date"></div>
                </div>
                <button class="btn btn-purple">حفظ الجهاز</button>
            </div>
        </div>
    </div>

    <script>
    function toggleSection(el) {
        el.nextElementSibling.classList.toggle('show');
    }
    </script>
</body>

</html>