<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Dashboard - Mustika Komputer')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/feather-icons"></script>

    @verbatim
    <style>
        /* * ======================================
         * CSS (Semua dalam satu file)
         * ======================================
         */

        /* --- 1. Reset & Global --- */
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa; 
            color: #333;
            overflow-x: hidden;
        }
        .dashboard-container { display: flex; min-height: 100vh; }

        .sidebar {
            width: 260px;
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            position: fixed; top: 0; left: 0; height: 100vh; padding: 1.5rem; display: flex; flex-direction: column;
            transition: width 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            z-index: 100;
        }
        .sidebar.collapsed {
            width: 80px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }
        .sidebar-header { text-align: center; margin-bottom: 2.5rem; padding-top: 1rem; white-space: nowrap; }
        .sidebar-header h2 { font-size: 1.5rem; font-weight: 700; background: linear-gradient(90deg, #4F46E5, #3B82F6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; transition: opacity 0.3s ease; }
        .sidebar.collapsed .sidebar-header h2 { opacity: 0; font-size: 0; }
        .sidebar-nav { flex-grow: 1; }
        .sidebar-nav ul { list-style: none; }
        .sidebar-nav li { margin-bottom: 0.5rem; }
        .sidebar-nav a { display:flex; align-items:center; padding:0.75rem 1rem; text-decoration:none; font-size:0.95rem; font-weight:500; color:#718096; border-radius:8px; transition:background-color 0.3s, color 0.3s; white-space: nowrap; }
        .sidebar-nav a svg{ width:20px; height:20px; margin-right:0.75rem; stroke-width:2.5px; flex-shrink: 0; }
        .sidebar.collapsed .sidebar-nav a { justify-content: center; padding: 0.75rem 0.5rem; }
        .sidebar.collapsed .sidebar-nav a svg { margin-right: 0; }
        .sidebar.collapsed .sidebar-nav a span { display: none; }
        .sidebar-nav a.active, .sidebar-nav a:hover { background-color:#eef2ff; color:#4F46E5; }
        .sidebar-footer { margin-top: auto; }
        .sidebar-footer form { width: 100%; }
        .sidebar-footer button { width: 100%; display: flex; align-items: center; padding: 0.75rem 1rem; background: none; border: none; color: #718096; font-family: 'Poppins', sans-serif; font-size: 0.95rem; font-weight: 500; cursor: pointer; border-radius: 8px; transition: background-color 0.3s, color 0.3s; white-space: nowrap; }
        .sidebar-footer button svg { width: 20px; height: 20px; margin-right: 0.75rem; stroke-width: 2.5px; flex-shrink: 0; }
        .sidebar.collapsed .sidebar-footer button { justify-content: center; padding: 0.75rem 0.5rem; }
        .sidebar.collapsed .sidebar-footer button svg { margin-right: 0; }
        .sidebar.collapsed .sidebar-footer button span { display: none; }
        .sidebar-footer button:hover { background-color: #fee2e2; color: #DC2626; }
        @media (min-width: 768px) {
            .sidebar:hover { width: 260px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); }
            .sidebar:hover.collapsed .sidebar-header h2 { opacity: 1; font-size: 1.5rem; }
            .sidebar:hover.collapsed .sidebar-nav a { justify-content: flex-start; padding: 0.75rem 1rem; }
            .sidebar:hover.collapsed .sidebar-nav a svg { margin-right: 0.75rem; }
            .sidebar:hover.collapsed .sidebar-nav a span { display: inline; }
            .sidebar:hover.collapsed .sidebar-footer button { justify-content: flex-start; padding: 0.75rem 1rem; }
            .sidebar:hover.collapsed .sidebar-footer button svg { margin-right: 0.75rem; }
            .sidebar:hover.collapsed .sidebar-footer button span { display: inline; }
        }

        .main-content { margin-left: 260px; flex:1; padding:2rem; display:flex; flex-direction:column; min-height:100vh; transition: margin-left 0.3s ease; }
        .sidebar.collapsed ~ .main-content { margin-left: 80px; }
        .content-area { flex-grow:1; }

        .main-header { background-color:#ffffff; border-radius:16px; padding:1.25rem 2rem; box-shadow:0 10px 40px rgba(0,0,0,0.05); display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem; animation:fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(-10px);} to { opacity:1; transform:translateY(0);} }
        .header-title h1 { font-size:1.75rem; font-weight:700; color:#1a202c; }
        .search-bar { position: relative; }
        .search-bar svg { position:absolute; top:50%; left:1rem; transform:translateY(-50%); color:#718096; stroke-width:2.5px; }
        .search-bar input { font-family:'Poppins', sans-serif; font-size:0.95rem; font-weight:500; width:350px; padding:0.85rem 1rem 0.85rem 3rem; border:1px solid #e2e8f0; border-radius:8px; background-color:#f8f9fa; transition: border-color 0.3s, box-shadow 0.3s; }
        .search-bar input:focus { outline:none; border-color:#4F46E5; background-color:#ffffff; box-shadow:0 0 0 3px rgba(79,70,229,0.2); }

        .user-profile { display:flex; align-items:center; gap:1rem; }
        .user-profile .avatar { width:40px; height:40px; border-radius:50%; background-image:linear-gradient(45deg,#4F46E5,#3B82F6); color:white; display:flex; align-items:center; justify-content:center; font-weight:600; font-size:1rem; }
        .user-profile .user-info { line-height:1.3; text-align:right; }
        .user-profile .user-info strong { display:block; font-size:0.95rem; font-weight:600; color:#2d3748; }
        .user-profile .user-info span { font-size:0.85rem; color:#718096; }

        /* --- Dashboard specific styles (from Desain/Dashboard/dashboard.html) --- */
        .welcome-banner {
            background-image: linear-gradient(90deg, #4F46E5, #3B82F6);
            color: #ffffff;
            padding: 2.5rem 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
            animation: fadeIn 0.5s ease-out;
        }
        .welcome-banner h1 { font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem; }
        .welcome-banner p { font-size: 1rem; opacity: 0.9; }

        .widget-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .widget-card {
            background-color: #ffffff;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid #eef2f7;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .widget-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.07); }
        .widget-card h4 { font-size: 0.9rem; font-weight: 600; color: #718096; text-transform: uppercase; letter-spacing: 0.5px; }
        .widget-value { font-size: 2.25rem; font-weight: 700; color: #1a2b4d; margin-top: 0.5rem; }
        .widget-change { font-size: 0.875rem; margin-top: 0.5rem; }
        .widget-change.positive { color: #10B981; }
        .widget-change.negative { color: #EF4444; }

        .content-card {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            margin-top: 2rem;
            overflow-x: auto; /* Ensure responsive tables */
        }

        .content-card h3 { font-size: 1.25rem; font-weight: 700; color: #1a202c; margin-bottom: 1.5rem; }

        .activity-feed ul { list-style: none; }
        .activity-feed li { display:flex; align-items:center; gap:1rem; padding:1rem 0; border-bottom:1px solid #eef2f7; }
        .activity-feed li:last-child { border-bottom:none; padding-bottom:0; }
        .activity-icon { flex-shrink:0; width:40px; height:40px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; }
        .activity-text { flex-grow:1; font-size:0.95rem; color:#4a5568; }
        .activity-text strong { color:#1a202c; font-weight:600; }
        .activity-timestamp { flex-shrink:0; font-size:0.875rem; color:#718096; font-weight:500; }

        /* --- Inventory/Page specific styles (from Desain/Page/Inventory.html) --- */
        .cta-button {
            padding: 0.75rem 1.25rem;
            border: none;
            border-radius: 8px;
            background-image: linear-gradient(90deg, #4F46E5, #3B82F6);
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .cta-button:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3); }
        .cta-button.full-width { width:100%; justify-content:center; padding:0.85rem 1rem; font-size:1rem; }

        .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; }
        .page-header h1 { font-size:1.75rem; font-weight:700; color:#1a202c; }

        .modern-table { width:100%; border-collapse: collapse; min-width:700px; }
        .modern-table thead th { text-align:left; font-size:0.875rem; font-weight:600; color:#718096; text-transform:uppercase; letter-spacing:0.5px; background-color:#f8f9fa; padding:1rem 1.25rem; border-bottom:2px solid #e2e8f0; }
        .modern-table tbody td { padding:1rem 1.25rem; font-size:0.95rem; color:#2d3748; border-bottom:1px solid #eef2f7; white-space:nowrap; }
        .modern-table tbody tr:hover { background-color:#fcfdff; }
        .modern-table .stock-level { font-weight:600; }
        .modern-table .stock-level.low { color:#EF4444; }

        .action-buttons a { color:#718096; text-decoration:none; margin-right:0.75rem; }
        .action-buttons a:hover { color:#4F46E5; }

        .form-group { margin-bottom:1.25rem; text-align:left; }
        .form-group label { display:block; font-size:0.875rem; font-weight:600; color:#4a5568; margin-bottom:0.5rem; }
        .form-group input, .form-group select { width:100%; padding:0.75rem 1rem; font-size:1rem; font-family:'Poppins', sans-serif; border:1px solid #e2e8f0; border-radius:8px; background-color:#fdfdfd; transition:border-color 0.3s, box-shadow 0.3s; }
        .form-group select { appearance:none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23718096' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat:no-repeat; background-position: right 1rem center; background-size:1em; padding-right:2.5rem; }
        .form-group input:focus, .form-group select:focus { outline:none; border-color:#4F46E5; box-shadow:0 0 0 3px rgba(79,70,229,0.2); }

        .main-footer { text-align:center; padding:1.5rem; margin-top:2rem; color:#718096; font-size:0.875rem; font-weight:500; }

    /* --- Sales/POS specific styles (from Desain/Page/sales.html) --- */
    .pos-layout { display:flex; gap:1.5rem; align-items:flex-start; }
    .pos-products { flex:2; }
    .pos-cart { flex:1; background-color:#ffffff; border-radius:16px; box-shadow:0 10px 40px rgba(0,0,0,0.05); position:sticky; top:2rem; }
    .pos-cart-header { padding:1.5rem; border-bottom:1px solid #eef2f7; }
    .pos-cart-header h3 { font-size:1.25rem; font-weight:600; color:#1a202c; }
    .product-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(130px,1fr)); gap:1rem; margin-top:1.5rem; }
    .product-card { background-color:#ffffff; border-radius:12px; border:1px solid #eef2f7; padding:1rem; text-align:center; cursor:pointer; transition:transform 0.2s, box-shadow 0.2s; }
    .product-card:hover { transform: translateY(-5px); box-shadow:0 8px 25px rgba(0,0,0,0.07); }
    .product-card h6 { font-size:0.9rem; font-weight:600; margin-bottom:0.25rem; }
    .product-card span { font-size:0.875rem; font-weight:500; color:#4F46E5; }
    .cart-item-list { list-style:none; padding:1rem 1.5rem; max-height:300px; overflow-y:auto; }
    .cart-item { display:flex; justify-content:space-between; align-items:center; padding:1rem 0; border-bottom:1px dashed #e2e8f0; }
    .cart-item:last-child { border-bottom:none; }
    .cart-item-details h5 { font-weight:600; font-size:0.95rem; color:#2d3748; margin-bottom:0.5rem; }
    .cart-item-editable { display:flex; gap:0.5rem; align-items:center; }
    .cart-item-editable label { font-size:0.8rem; font-weight:600; color:#718096; }
    .cart-item-editable input { font-family:'Poppins',sans-serif; font-weight:500; border:1px solid #e2e8f0; background-color:#f8f9fa; border-radius:6px; padding:4px 8px; font-size:0.9rem; width:80px; }
    .cart-item-editable input:focus { outline:none; background-color:#fff; border-color:#4F46E5; box-shadow:0 0 0 3px rgba(79,70,229,0.2); }
    .cart-item-remove button { background:none; border:none; color:#EF4444; cursor:pointer; padding:0.5rem; margin-left:0.5rem; }
    .cart-item-remove button:hover { color:#9B2C2C; }
    .info-box { background-color:#eef2ff; border-left:4px solid #4F46E5; padding:0.75rem 1rem; font-size:0.85rem; color:#4a5568; border-radius:8px; margin:0 1.5rem 1rem 1.5rem; }
    .cart-summary { padding:1.5rem; border-top:1px solid #eef2f7; background-color:#fcfdff; border-radius:0 0 16px 16px; }
    .summary-row { display:flex; justify-content:space-between; margin-bottom:0.75rem; font-size:0.95rem; }
    .summary-row span { color:#4a5568; }
    .summary-row.total { font-size:1.25rem; font-weight:700; color:#1a202c; margin-top:1rem; }

    /* --- Modal Payment styles (from sales-process.html) --- */
    .modal-overlay {
        display: none;
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(8px);
        justify-content: center; align-items: center;
        z-index: 1000;
        animation: fadeInModal 0.3s ease-out;
    }
    @keyframes fadeInModal { from { opacity: 0; } to { opacity: 1; } }

    .modal-content {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 480px;
        animation: popUpModal 0.3s ease-out;
    }
    @keyframes popUpModal { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }

    .modal-header {
        padding: 1.5rem;
        text-align: center;
        border-bottom: 1px solid #eef2f7;
    }
    .modal-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a202c;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .payment-info {
        background-color: #f4f7fa;
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .payment-info label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #718096;
        text-transform: uppercase;
    }
    .payment-info .total-value {
        font-size: 2.25rem;
        font-weight: 700;
        color: #4F46E5;
    }

    .payment-methods {
        margin-bottom: 1.5rem;
    }
    .payment-methods label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.75rem;
    }
    .method-options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }

    .method-options button {
        background-color: #f8f9fa;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1rem 0.5rem;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: #2d3748;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        transition: border-color 0.3s, box-shadow 0.3s, background-color 0.3s;
    }
    .method-options button:hover {
        border-color: #4F46E5;
        background-color: #eef2ff;
    }
    .method-options button.active {
        border-color: #4F46E5;
        background-color: #eef2ff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        color: #4F46E5;
    }

    .cash-calculator {
        display: block;
        border-top: 1px solid #eef2f7;
        padding-top: 1.5rem;
    }
    .cash-calculator.hidden {
        display: none;
    }

    .modal-body .form-group input {
        font-size: 1.25rem;
        padding: 0.85rem 1rem;
        text-align: right;
    }

    .change-display {
        text-align: center;
        margin-top: 1.5rem;
    }
    .change-display label {
        font-size: 1rem;
        font-weight: 600;
        color: #4a5568;
    }
    .change-display .change-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #10B981;
    }

    .modal-footer {
        padding: 1.5rem;
        background-color: #fcfdff;
        border-top: 1px solid #eef2f7;
        border-radius: 0 0 16px 16px;
        display: flex;
        gap: 1rem;
    }

    .secondary-button {
        padding: 0.85rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background-color: #ffffff;
        color: #4a5568;
        font-size: 1rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: background-color 0.2s ease;
        width: 100%;
    }
    .secondary-button:hover { background-color: #f8f9fa; }

    </style>
    @endverbatim

    @stack('styles')

</head>
<body>

    <div class="dashboard-container">
        <aside class="sidebar collapsed" id="appSidebar">
            <div class="sidebar-header">
                <h2>MUSTIKA KOMPUTER</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i data-feather="home"></i> <span>Dashboard</span></a></li>
                    <li><a href="{{ route('inventory') }}" class="{{ request()->routeIs('inventory') ? 'active' : '' }}"><i data-feather="package"></i> <span>Manajemen Produk</span></a></li>
                    <li><a href="{{ route('sales') }}" class="{{ request()->routeIs('sales') ? 'active' : '' }}"><i data-feather="shopping-cart"></i> <span>Kasir (POS)</span></a></li>
                    <li><a href="{{ route('sales.history') }}" class="{{ request()->routeIs('sales.history') || request()->routeIs('sales.detail') ? 'active' : '' }}"><i data-feather="file-text"></i> <span>Riwayat Penjualan</span></a></li>
                    <li><a href="{{ route('reports.profit') }}" class="{{ request()->routeIs('reports.profit') ? 'active' : '' }}"><i data-feather="bar-chart-2"></i> <span>Laporan Profit</span></a></li>
                    <li><a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}"><i data-feather="tool"></i> <span>Manajemen Servis</span></a></li>
                    <li><a href="{{ route('audit-log') }}" class="{{ request()->routeIs('audit-log') ? 'active' : '' }}"><i data-feather="shield"></i> <span>Audit Log System</span></a></li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        <i data-feather="log-out"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">

            <header class="main-header">
                <div class="header-title">
                    <h1>@yield('header-title','Dashboard')</h1>
                </div>
                <div class="user-profile">
                    <div class="user-info">
                        <strong>Admin</strong>
                        <span>Mustika Komputer</span>
                    </div>
                    <div class="avatar">A</div>
                </div>
            </header>

            <div class="content-area">
                @yield('content')
            </div>

            <footer class="main-footer">
                &copy; 2025 Mustika Komputer. Dibuat dengan cinta & kopi.
            </footer>

        </main>
    </div>

    <script>
        feather.replace()
    </script>

</body>
</html>
