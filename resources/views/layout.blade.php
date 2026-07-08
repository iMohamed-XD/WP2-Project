<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Laravel Auth' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap -->
    <style>
        body{
            min-height:100vh;
            background:linear-gradient(135deg,#0f172a,#1e293b,#111827);
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .auth-card{
            width:100%;
            max-width:430px;
            border:none;
            border-radius:20px;
            background:rgba(30,41,59,.85);
            backdrop-filter:blur(12px);
            box-shadow:0 0 40px rgba(0,0,0,.5);
        }

        .form-control{
            background:#111827;
            border:1px solid #374151;
            color:#fff;
        }

        .form-control:focus{
            background:#111827;
            color:#fff;
            border-color:#0d6efd;
            box-shadow:none;
        }

        .btn-primary{
            border-radius:10px;
        }

        .card-title{
            font-weight:700;
            letter-spacing:.5px;
        }

        a{
            text-decoration:none;
        }
    </style>
</head>

<body>

    {{ $slot }}
</body>
</html>
