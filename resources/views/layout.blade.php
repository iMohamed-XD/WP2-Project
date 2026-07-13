<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'AIU GYM' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap -->
    <style>

    body {
        min-height: 100vh;
        background: linear-gradient(
            135deg,
            #020617,
            #111827,
            #1e293b
        );
        color: white;
    }


    .auth-card {

        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(12px);

        border-radius: 18px;

        box-shadow:
            0 20px 50px rgba(0,0,0,.35);

    }



    .form-control,
    .form-select {

        background:#020617;
        border:1px solid #334155;
        color:white;

    }


    .form-control:focus,
    .form-select:focus {

        background:#020617;
        color:white;

        border-color:#3b82f6;

        box-shadow:
        0 0 0 .25rem rgba(59,130,246,.25);

    }



    .btn {

        border-radius:10px;

    }



    .section-title {

        border-left:4px solid #3b82f6;

        padding-left:12px;

        margin-bottom:20px;

    }


    .info-box {

        background:#020617;

        border-radius:12px;

        padding:15px;

        height:100%;

    }

    .input-group-text{
    background:#0f172a !important;
    color:#fff;
    border:1px solid #334155;
}

.form-label{
    color:#cbd5e1;
    margin-bottom:.5rem;
}

.form-control::placeholder{
    color:#94a3b8;
}

.form-select option{
    background:#111827;
    color:white;
}

#clearFilters{
    transition:.25s;
}

#clearFilters:hover{
    transform:translateY(-2px);
}

.auth-card{
    transition:.25s;
}

.auth-card:hover{
    box-shadow:0 20px 50px rgba(59,130,246,.15);
}


    </style>
</head>

<body>

    {{ $slot }}
</body>
</html>
