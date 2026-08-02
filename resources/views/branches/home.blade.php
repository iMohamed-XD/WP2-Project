<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>الصفحة الرئيسية</title>
</head>
<body style="direction: rtl; text-align: right">

<h2>مرحباً {{ $user->name }} 👋</h2>

<p>البريد الإلكتروني: {{ $user->email }}</p>

<p>القسم: {{ $user->department->name }}</p>

<a href="/logout">تسجيل خروج</a>

</body>
</html>