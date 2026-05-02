<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Thingy Store</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #F8F9FF;
        }
        .font-fredoka { font-family: 'Fredoka One', cursive; }

        /* Sidebar */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #2D1B69 0%, #11998e 100%);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s;
        }
        .sidebar-logo {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-logo h1 {
            font-family: 'Fredoka One', cursive;
            color: white;
            font-size: 22px;
            margin: 0;
        }
        .sidebar-logo p {
            color: rgba(255,255,255,0.6);
            font-size: 12px;
            margin: 4px 0 0;
        }
        .nav-section {
            padding: 16px 12px 8px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.4);
            font-weight: 700;
        }
        .nav-link-admin {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            border-radius: 12px;
            margin: 2px 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
        }
        .nav-link-admin:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(4px);
        }
        .nav-link-admin.active {
            background: rgba(255,255,255,0.2);
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .nav-emoji {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 16px 28px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .top-bar h4 {
            margin: 0;
            font-family: 'Fredoka One', cursive;
            font-size: 22px;
            color: #2D1B69;
        }
        .admin-badge {
            background: linear-gradient(135deg, #FF6B9D, #C77DFF);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
        }

        /* Cards */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all 0.3s;
            border-left: 5px solid transparent;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }
        .content-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            margin-bottom: 24px;
        }
        .content-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f0f0f0;
        }
        .content-card-header h5 {
            font-family: 'Fredoka One', cursive;
            font-size: 20px;
            color: #2D1B69;
            margin: 0;
        }

        /* Buttons */
        .btn-pink {
            background: linear-gradient(135deg, #FF6B9D, #ff4f8b);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-pink:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255,107,157,0.4);
        }
        .btn-purple {
            background: linear-gradient(135deg, #C77DFF, #a855f7);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-purple:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(199,125,255,0.4);
        }

        /* Table */
        .table { font-size: 14px; }
        .table th {
            background: #F8F9FF;
            font-weight: 700;
            color: #2D1B69;
            border: none;
            padding: 12px 16px;
        }
        .table td {
            padding: 12px 16px;
            vertical-align: middle;
            border-color: #f0f0f0;
        }
        .table tbody tr:hover { background: #FAFBFF; }

        /* Flash Messages */
        .alert-custom {
            border-radius: 16px;
            border: none;
            padding: 16px 20px;
            font-weight: 600;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 10px;
        }
    </style>

    @yield('styles')
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-logo">
        <h1>🛍️ Thingy Store</h1>
        <p>Admin Panel</p>
    </div>

    <nav class="py-3">
        <div class="nav-section">Main</div>

        <a href="{{ route('admin.dashboard') }}"
           class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-emoji">📊</span> Dashboard
        </a>

        <div class="nav-section">Store</div>

        <a href="{{ route('admin.products.index') }}"
           class="nav-link-admin {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <span class="nav-emoji">📦</span> Products
        </a>

        <a href="{{ route('admin.orders.index') }}"
           class="nav-link-admin {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <span class="nav-emoji">🛒</span> Orders
        </a>

        <a href="{{ route('admin.order-items.index') }}"
           class="nav-link-admin {{ request()->routeIs('admin.order-items*') ? 'active' : '' }}">
            <span class="nav-emoji">📋</span> Order Items
        </a>

        <div class="nav-section">People</div>

        <a href="{{ route('admin.users.index') }}"
           class="nav-link-admin {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <span class="nav-emoji">👥</span> Users
        </a>

        <a href="{{ route('admin.admins.index') }}"
           class="nav-link-admin {{ request()->routeIs('admin.admins*') ? 'active' : '' }}">
            <span class="nav-emoji">👑</span> Admins
        </a>

        <a href="{{ route('admin.contacts.index') }}"
           class="nav-link-admin {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
            <span class="nav-emoji">📬</span> Contacts
        </a>

        <div class="nav-section">Other</div>

        <a href="{{ route('home') }}" target="_blank"
           class="nav-link-admin">
            <span class="nav-emoji">🌐</span> View Site
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link-admin w-100 text-start border-0"
                style="background:transparent;cursor:pointer;">
                <span class="nav-emoji">🚪</span> Logout
            </button>
        </form>
    </nav>
</div>

<!-- Main Content -->
<div class="main-content">

    <!-- Top Bar -->
    <div class="top-bar">
        <h4>@yield('page-title', 'Dashboard')</h4>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted" style="font-size:13px;">
                👋 Welcome,
            </span>
            <span class="admin-badge">
                👑 {{ auth()->user()->name ?? 'Admin' }}
            </span>
        </div>
    </div>

    <!-- Content -->
    <div class="p-4">

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="alert alert-success alert-custom alert-dismissible fade show mb-4">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-custom alert-dismissible fade show mb-4">
            ❌ {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

@yield('scripts')
</body>
</html>
