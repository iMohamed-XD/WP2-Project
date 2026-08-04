<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>تعديل البيانات - الأندية الرياضية</title>
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
        border-bottom: 3px solid #fbbf24;
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
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: #000;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn:hover {
        opacity: 0.9;
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
        <h1 class="page-title">✏️ تعديل البيانات</h1>

        <!-- تعديل فرع -->
        <div class="form-card">
            <div class="section-title" onclick="toggleSection(this)">🏢 تعديل بيانات فرع ▾</div>
            <div class="collapsible-content show">
                <div class="form-group">
                    <label>اختر الفرع</label>
                    <select>
                        <option>فرع دمشق - المزة</option>
                        <option>فرع حلب - الفرقان</option>
                        <option>فرع حمص - الوعر</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>اسم الفرع</label><input type="text" value="فرع دمشق - المزة"></div>
                    <div class="form-group"><label>المحافظة</label><select>
                            <option>دمشق</option>
                            <option>حلب</option>
                            <option>حمص</option>
                        </select></div>
                    <div class="form-group"><label>السعة</label><input type="number" value="150"></div>
                    <div class="form-group"><label>الهاتف</label><input type="text" value="0113344555"></div>
                </div>
                <div class="form-group"><label>العنوان</label><textarea>شارع الجلاء، المزة</textarea></div>
                <button class="btn">تحديث الفرع</button>
            </div>
        </div>

        <!-- تعديل مدرب -->
        <div class="form-card">
            <div class="section-title" onclick="toggleSection(this)">🏃 تعديل بيانات مدرب ▾</div>
            <div class="collapsible-content">
                <div class="form-group"><label>اختر المدرب</label><select>
                        <option>أحمد علي - كمال أجسام</option>
                        <option>سامر الخطيب - لياقة بدنية</option>
                    </select></div>
                <div class="form-row">
                    <div class="form-group"><label>اسم المدرب</label><input type="text" value="أحمد علي"></div>
                    <div class="form-group"><label>التخصص</label><input type="text" value="كمال أجسام"></div>
                    <div class="form-group"><label>سنوات الخبرة</label><input type="number" value="6"></div>
                    <div class="form-group"><label>رقم الهاتف</label><input type="text" value="0933555666"></div>
                </div>
                <button class="btn">تحديث المدرب</button>
            </div>
        </div>

        <!-- تعديل عضو -->
        <div class="form-card">
            <div class="section-title" onclick="toggleSection(this)">👤 تعديل بيانات عضو ▾</div>
            <div class="collapsible-content">
                <div class="form-group"><label>اختر العضو</label><select>
                        <option>محمد خالد - اشتراك سنوي</option>
                        <option>رامي سعيد - اشتراك شهري</option>
                    </select></div>
                <div class="form-row">
                    <div class="form-group"><label>اسم العضو</label><input type="text" value="محمد خالد"></div>
                    <div class="form-group"><label>تاريخ الميلاد</label><input type="date" value="1990-05-15"></div>
                    <div class="form-group"><label>رقم الهاتف</label><input type="text" value="0944222333"></div>
                    <div class="form-group"><label>نوع الاشتراك</label><select>
                            <option>سنوي</option>
                            <option>شهري</option>
                            <option>ربع سنوي</option>
                        </select></div>
                </div>
                <button class="btn">تحديث العضو</button>
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