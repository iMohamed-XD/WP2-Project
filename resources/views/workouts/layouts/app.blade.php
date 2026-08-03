<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'إدارة النادي الرياضي')</title>

    <!-- Bootstrap 5 RTL -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }
        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: #212529;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            padding: 0.75rem 1.25rem;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #343a40;
            border-right: 3px solid #0d6efd;
        }
        .card-hover {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .stat-card {
            border-right: 4px solid #0d6efd;
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- شريط علوي -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('workouts.dashboard') }}">
            <i class="bi bi-heart-pulse-fill"></i> نظام إدارة النادي الرياضي
        </a>
        @auth
        <div class="d-flex align-items-center">
            <span class="text-light me-3">
                <i class="bi bi-person-circle"></i> {{ auth()->user()->name ?? auth()->user()->email }}
            </span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-left"></i> تسجيل الخروج
                </button>
            </form>
        </div>
        @endauth
    </div>
</nav>

<div class="d-flex">
    @auth
    <!-- القائمة الجانبية -->
    <div class="sidebar text-white" style="width: 250px;">
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a href="{{ route('workouts.dashboard') }}" class="nav-link {{ request()->routeIs('workouts.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> لوحة التحكم
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('workouts.index') }}" class="nav-link {{ request()->routeIs('workouts.index') ? 'active' : '' }}">
                    <i class="bi bi-list-ul"></i> قائمة الحصص
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('workouts.create') }}" class="nav-link {{ request()->routeIs('workouts.create') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle"></i> إضافة حصة
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('workouts.search.page') }}" class="nav-link {{ request()->routeIs('workouts.search.page') ? 'active' : '' }}">
                    <i class="bi bi-search"></i> البحث المتقدم
                </a>
            </li>
        </ul>
    </div>
    @endauth

    <!-- المحتوى الرئيسي -->
    <div class="flex-grow-1 p-4">
        <!-- رسائل التنبيه -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>


@stack('scripts')
</body>
</html>
