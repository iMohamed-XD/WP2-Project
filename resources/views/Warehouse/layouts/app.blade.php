<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'GYMS')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>

        :root{
            --bg: #342d2d;
            --sidebar: #0d184e;
            --primary: #4fc1ee;
            --primary-hover: #3ae0ff;
            --secondary: #FF8C00;
            --text: #FFFFFF;
            --text-muted: #A3A3A3;
            --text-secondary: #A3A3A3;
            --card: #181818;
            --surface: #111111;
            --border: #262626;
            --divider: #262626;
            --background: #342d2d;
            --success: #22b5c5;
            --danger: #EF4444;
            --info: #38bdf8;
        }


        body{
            margin:0;
            background:var(--bg);
            color:var(--text);
            font-family:'Segoe UI',sans-serif;
        }

        /* ===== LOGIN PAGE ===== */
        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--background);
            position: relative;
            padding: 20px;
        }

        .login-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(141, 255, 0, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(255, 122, 0, 0.05) 0%, transparent 50%),
                var(--background);
            z-index: 0;
        }

        .login-card {
            background: var(--card);
            padding: 40px;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6), 0 0 40px rgba(141, 255, 0, 0.03);
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-logo-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            background: rgba(19, 74, 77, 0.08);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--primary);
            transition: all 0.3s;
        }

        .login-logo-wrapper:hover {
            background: rgba(20, 78, 78, 0.15);
            box-shadow: 0 0 30px rgba(18, 80, 80, 0.15);
            transform: scale(1.05);
        }

        .login-logo-icon {
            font-size: 40px;
            color: var(--primary);
        }

        .login-card h1 {
            color: var(--text);
            font-size: 28px;
            letter-spacing: 2px;
        }

        .login-card h1::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: var(--primary);
            margin: 8px auto 0;
            border-radius: 2px;
        }

        .login-card p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 8px;
        }

        .login-card .form-label {
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
        }

        .login-card .form-label i {
            color: var(--primary);
            margin-right: 6px;
        }

        .login-card .form-control {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            padding: 12px 16px;
            transition: all 0.3s;
        }

        .login-card .form-control::placeholder {
            color: var(--text-secondary);
            opacity: 0.6;
        }

        .login-card .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(13, 69, 79, 0.15);
            background: var(--surface);
            color: var(--text);
        }

        .login-card .form-control:focus ~ .form-label {
            color: var(--primary);
        }

        .login-btn {
            background: var(--primary);
            color: #000000;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s;
            letter-spacing: 0.5px;
        }

        .login-btn:hover {
            background: var(--primary-hover);
            color: #000000;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(20, 84, 94, 0.25);
        }

        .login-btn i {
            color: #000000;
        }

        .login-card .alert-danger {
            background: rgba(255, 59, 48, 0.12);
            border: 1px solid rgba(255, 59, 48, 0.25);
            color: var(--danger);
            border-radius: 8px;
            font-size: 14px;
        }

        .login-card .alert-danger i {
            color: var(--danger);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .login-card {
                padding: 25px 20px;
            }
        }
        .wrapper{
            display:flex;
            min-height:100vh;
        }

        .content{
            flex:1;
            margin-left:260px;
            padding:25px;
            min-width:0;
        }


        /* Pagination Style */

        .pagination{
            justify-content:center;
        }


        .pagination .page-link{

            width:35px;
            height:35px;
            padding:0;

            display:flex;
            align-items:center;
            justify-content:center;

            font-size:14px;

        }


        .pagination .page-item{

            margin:0 3px;

        }

        .warehouse-pagination .page-link{
            width:32px;
            height:32px;
            padding:0;

            display:flex;
            align-items:center;
            justify-content:center;

            font-size:13px;
        }


        .warehouse-pagination .page-item{
            margin:0 2px;
        }

        /* Warehouse UI */

        .warehouse-add-btn{

            background:var(--primary);
            border:none;
            color:#000;
            font-weight:600;

        }


        .warehouse-add-btn:hover{

            background: #2bbccc;
            color: #000;

        }


        .card{

            background: #181818;
            border:1px solid #262626;
            color:var(--text);

        }


        .form-control,
        .form-select{

            background: #111;
            border:1px solid #333;
            color:white;

        }


        .form-control:focus,
        .form-select:focus{

            background:#111;
            color:white;
            border-color:var(--primary);
            box-shadow:0 0 0 .25rem rgba(124,252,0,.15);

        }

        .sidebar{

            width:260px;
            min-height:100vh;

            background:var(--sidebar);

            position:fixed;
            left:0;
            top:0;

            padding:25px 15px;

            z-index:1000;

        }


        .sidebar-logo{

            color:var(--primary);
            font-size:32px;
            font-weight:800;

            text-align:center;

            margin-bottom:40px;

        }


        .sidebar-menu{

            list-style:none;
            padding:0;
            margin:0;

        }


        .sidebar-menu li{

            margin-bottom:10px;

        }


        .sidebar-menu a{

            display:flex;
            align-items:center;
            gap:12px;

            padding:12px 15px;

            color:var(--text-muted);

            text-decoration:none;

            border-radius:10px;

            transition:.3s;

        }


        .sidebar-menu a:hover{

            background: #252525;
            color:var(--primary);

        }


        .sidebar-menu i{

            font-size:18px;

        }

        /* Navbar */
        .navbar-custom{

            min-height:70px;
            background: #1e1460;
            border:1px solid #a9a3a3;
            border-radius:15px;

            display:flex;
            align-items:center;
            justify-content:space-between;

            padding:0 25px;
            margin-bottom:25px;

        }


        .navbar-user{

            display:flex;
            align-items:center;
            gap:20px;

        }


        .user-box{

            display:flex;
            align-items:center;
            gap:8px;

            color:var(--primary);
            font-weight:600;

            white-space:nowrap;

        }

        .stat-card{
            background: #181818;
            border:1px solid #262626;
            border-radius:15px;
        }


        .stat-card h6{
            color:var(--text-muted);
        }


        .stat-card h2{
            color:var(--primary);
            font-weight:800;
        }


        .stat-icon{
            font-size:40px;
            color:var(--primary);
        }

        .search-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.4);
            overflow: hidden;
        }

        .search-card .card-header {
            background: var(--surface) !important;
            color: var(--text);
            border-bottom: 1px solid var(--border);
            font-size: 16px;
            font-weight: 600;
            padding: 14px 20px;
        }

        .search-card .form-label {
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .search-card .form-control,
        .search-card .form-select {
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            padding: 10px 14px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .search-card .form-control::placeholder {
            color: var(--text-secondary);
            opacity: 0.6;
        }

        .search-card .form-control:focus,
        .search-card .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 238, 255, 0.12);
            background: var(--surface);
            color: var(--text);
        }

        .search-card .btn-success {
            background: var(--primary);
            color: var(--background);
            border: none;
            padding: 10px;
            font-weight: 700;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .search-card .btn-success:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 225, 255, 0.2);
        }

        .warehouse-add-btn{

            background:var(--primary);

            color: #000;

            font-weight:700;

            border-radius:12px;

            padding:10px 18px;

            border:none;

            transition:.3s;

        }

        .warehouse-add-btn:hover{

            background: #3285a1;

            color: #000;

            transform:translateY(-2px);

        }


        .warehouse-add-btn i{

            margin-right:6px;

        }

        .country-badge{

            background: #262626;

            color:var(--primary);

            padding:6px 12px;

            border-radius:20px;

            font-size:13px;

            font-weight:600;

            display:inline-block;

        }

        .table .btn-sm{

            border-radius:8px;

            padding:5px 10px;

            font-size:13px;

        }

        .table {
            background: var(--card);
            border-radius: 12px;
            overflow: hidden;
            color: var(--text);
        }

        .table thead {
            background: var(--surface);
            color: var(--primary);
            border-bottom: 2px solid var(--border);
        }

        .table tbody tr {
            border-bottom: 1px solid var(--divider);
            transition: all 0.2s;
        }

        .table tbody tr:hover {
            background: var(--surface);
        }

        .warehouse-grid-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
        }

        .warehouse-grid-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(0, 213, 255, 0.08);
            border-color: var(--primary);
        }

        .warehouse-grid-card .card-title {
            color: var(--text);
            font-weight: 600;
        }

        .warehouse-grid-card .card-text {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
        }

        .stat-card h6 {
            color: var(--text-secondary);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card h2 {
            color: var(--text);
            font-weight: bold;
            margin: 5px 0 0 0;
        }

        .stat-card .stat-icon {
            color: var(--primary);
            opacity: 0.6;
        }
        .warehouse-form-card{

            background: #181818;

            border:1px solid #262626;

            border-radius:15px;

        }


        .warehouse-form-card label{

            color: #FFFFFF;

            font-weight:600;

        }


        .warehouse-form-card .form-control,
        .warehouse-form-card .form-select{

            background:#111;

            border:1px solid #333;

            color:white;

            border-radius:10px;

        }


        .warehouse-form-card .form-control::placeholder{

            color: #777;

        }


        .warehouse-form-card .form-control:focus,
        .warehouse-form-card .form-select:focus{

            border-color:var(--primary);

            box-shadow:0 0 0 .2rem rgba(124,252,0,.15);

        }


        .warehouse-form-card .btn-success{

            background:var(--primary);

            color:#000;

            border:none;

            font-weight:700;

        }


        .warehouse-form-card .btn-secondary{

            border-radius:10px;

        }

        .warehouse-form-card input[type="file"]{

            background:#111;

            border:1px solid #333;

            color:#A3A3A3;

            border-radius:10px;

            padding:10px;

        }


        .warehouse-form-card input[type="file"]::file-selector-button{

            background:var(--primary);

            color:#000;

            border:none;

            border-radius:8px;

            padding:8px 14px;

            margin-right:10px;

            font-weight:700;

            cursor:pointer;

        }


        .warehouse-form-card input[type="file"]::file-selector-button:hover{

            background: #1da3ad;

        }

        .badge-info {
            background: rgba(0, 225, 255, 0.12);
            color: var(--primary);
        }

        .badge-primary {
            background: rgba(56, 189, 248, 0.12);
            color: var(--info);
        }

        .badge-secondary {
            background: var(--surface);
            color: var(--text-secondary);
        }

        .badge-success {
            background: rgba(34, 181, 197, 0.12);
            color: var(--success);
        }

        .btn-outline-success {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-outline-success:hover {
            background: var(--primary);
            color: var(--background);
        }

        /* ===== BUTTONS ===== */
        .btn-success {
            background: #04b9fb !important;
            color: #090909 !important;
            font-weight: 700 !important;
            padding: 10px 24px !important;
            border-radius: 8px !important;
            border: none !important;
            transition: all 0.3s !important;
        }

        .btn-success:hover {
            background: #3ae8ff !important;
            color: #090909 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 20px rgba(141, 255, 0, 0.25) !important;
        }

        .btn-success i {
            color: #090909 !important;
        }
        
        .form-error{

            color: #EF4444;

            font-size:13px;

            margin-top:6px;

        }

        .view-table .grid-view { display: none; }
        .view-grid .table-view { display: none; }
        
    </style>


    @stack('styles')

</head>


<body>


<div class="wrapper">


    @include('Warehouse.partials.sidebar')


    <div class="content">


        @include('Warehouse.partials.navbar')


        @yield('content')


        @include('Warehouse.partials.footer')


    </div>


</div>





@stack('scripts')


</body>
</html>