<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'AIU GYM' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

                .user-badge {
            display: flex;
            align-items: center;
            gap: 12px;

            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(10px);

            padding: 10px 18px;

            border-radius: 14px;

            border: 1px solid #334155;

            box-shadow:
                0 10px 25px rgba(0,0,0,.25);

            color: white;

            transition: .25s;
        }


        .user-badge:hover {
            transform: translateY(-2px);

            border-color: #3b82f6;

            box-shadow:
                0 10px 30px rgba(59,130,246,.2);
        }


        .user-icon {
            font-size: 2rem;
            color: #60a5fa;
        }


        .user-badge small {
            display: block;
            color: #94a3b8;
            font-size: .75rem;
        }


        .user-badge strong {
            display: block;
            color: white;
            font-size: 1rem;
        }
                .logout-btn {
            background: transparent;
            color: #f87171;

            border: 1px solid #f87171;

            padding: 7px 14px;

            border-radius: 10px;

            font-size: .85rem;

            transition: .25s;

            display: flex;
            align-items: center;
            gap: 6px;
        }


        .logout-btn:hover {
            background: #f87171;
            color: white;

            transform: translateY(-2px);
        }
        .app-content {
            transition: margin-left .2s;
        }

        .has-sidebar .app-content {
            margin-left: 240px;
        }

        @media (max-width: 768px) {
            .has-sidebar .app-content {
                margin-left: 72px;
            }
        }
        .form-floating > label {
            color: #94a3b8;
        }

        .form-floating > .form-control {
            color: white;
        }

        .form-floating > .form-control:not(:placeholder-shown) ~ label,
        .form-floating > .form-control:focus ~ label {
            color: #93c5fd;
            background: transparent;
        }

        .form-floating > .form-control:focus {
            color: white;
        }
    </style>
</head>

<body class="{{ request()->routeIs('login', 'welcome') ? '' : 'has-sidebar' }} 
    ">
    <x-sidebar />
    <div class="app-content">
        {{ $slot }}
    </div>
</body>
</html>
