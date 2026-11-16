
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Bhaja Gouranga Kripa Sangha</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #263238;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #173c32;
            color: white;
            padding: 25px 16px;
            overflow-y: auto;
        }

        .brand {
            font-size: 18px;
            font-weight: bold;
            line-height: 1.5;
            padding: 0 10px 25px;
            border-bottom: 1px solid #ffffff30;
        }

        .brand small {
            display: block;
            font-size: 12px;
            font-weight: normal;
            color: #c8ddd3;
        }

        .menu-label {
            margin: 25px 10px 10px;
            color: #a9c5b9;
            font-size: 11px;
            text-transform: uppercase;
        }

        .sidebar a {
            display: block;
            color: #e5eee9;
            text-decoration: none;
            padding: 12px 14px;
            margin: 4px 0;
            border-radius: 7px;
            font-size: 14px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2c594a;
            color: white;
        }

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 2px 8px #00000008;
        }

        .topbar strong { font-size: 15px; }

        .content { padding: 30px; }

        .page-title {
            font-size: 24px;
            margin-bottom: 7px;
        }

        .subtitle {
            color: #7b858c;
            font-size: 14px;
            margin-bottom: 25px;
        }


        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e8eee9;
            border-left: 5px solid #27845e;
            box-shadow: 0 3px 12px rgba(23, 60, 50, 0.06);
            transition: all 0.25s ease;
            min-width: 0;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(23, 60, 50, 0.12);
        }

        .stat-card .label {
            color: #77838a;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 14px;
        }

        .stat-card .number {
            font-size: 29px;
            font-weight: 700;
            color: #173c32;
            line-height: 1.3;
            overflow-wrap: anywhere;
        }

        /* Individual Card Colors */
        .stat-card:nth-child(2) {
            border-left-color: #0d9488;
        }

        .stat-card:nth-child(3) {
            border-left-color: #2563eb;
        }

        .stat-card:nth-child(4) {
            border-left-color: #9333ea;
        }

        .stat-card:nth-child(5) {
            border-left-color: #ca8a04;
        }

        .stat-card:nth-child(6) {
            border-left-color: #dc2626;
        }


        .stat-card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            box-shadow: 0 2px 10px #00000008;
            border-left: 4px solid #27845e;
        }

        .stat-card .label {
            color: #77838a;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .stat-card .number {
            font-size: 27px;
            font-weight: bold;
            color: #263c35;
        }

        .panel {
            background: white;
            border-radius: 10px;
            padding: 22px;
            box-shadow: 0 2px 10px #00000008;
            margin-bottom: 22px;
        }

        .panel h3 {
            font-size: 17px;
            margin-bottom: 18px;
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 500px;
        }

        th, td {
            text-align: left;
            padding: 13px 10px;
            border-bottom: 1px solid #edf0f1;
            font-size: 13px;
        }

        th {
            color: #68777d;
            background: #f8faf9;
        }

        .status {
            background: #e3f5eb;
            color: #23754d;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
        }

        .logout-form { margin-top: 25px; }

        .logout-button {
            width: 100%;
            padding: 12px;
            border: 1px solid #ffffff55;
            background: transparent;
            color: white;
            border-radius: 7px;
            cursor: pointer;
            text-align: left;
        }

        
        @media (max-width: 1000px) {
            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                padding: 0 18px;
            }

            .content {
                padding: 20px 15px;
            }

            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .stat-card {
                padding: 17px;
            }

            .stat-card .number {
                font-size: 23px;
            }
        }

        @media (max-width: 380px) {
            .cards {
                grid-template-columns: 1fr;
            }
        }

        
    </style>
</head>

<body>

    
    <aside class="sidebar">
        <div class="brand">
            Bhaja Gouranga Kripa Sangha
            <small>Management System</small>
        </div>

        <div class="menu-label">Main Menu</div>

        @can('dashboard.view')
            <a href="{{ route('admin.dashboard') }}"
            @class(['active' => request()->routeIs('admin.dashboard')])>
                ▦ Dashboard
            </a>
        @endcan

        <div class="menu-label">Management</div>

        @can('members.view')
            <a href="{{ route('admin.members.index') }}"
            @class(['active' => request()->routeIs('admin.members.*')])>
                ▙ Members
            </a>
        @endcan

        @can('donations.view')
            <a href="{{ route('admin.donations.index') }}"
            @class(['active' => request()->routeIs('admin.donations.*')])>
                ৳ Donations / Pranami
            </a>
        @endcan

            <a href="{{ route('admin.donors.index') }}"
            @class(['active' => request()->routeIs('admin.donors.*')])>
                ▙ Donors
            </a>

        @can('donation-categories.manage')
            <a href="{{ route('admin.donation-categories.index') }}"
            @class(['active' => request()->routeIs('admin.donation-categories.*')])>
                Donation Categories
            </a>
        @endcan

        @can('finance.view')
            <a href="#">▤ Income & Expenses</a>
        @endcan

        <div class="menu-label">Activities</div>

        @can('events.manage')
            <a href="#">✿ Puja & Events</a>
        @endcan

        @can('seva.manage')
            <a href="#">♧ Bhakta Seva</a>
            <a href="#">▣ Social Initiatives</a>
        @endcan

        @can('events.manage')
            <a href="#">◉ Gita Education</a>
        @endcan

        <div class="menu-label">System</div>

        @can('reports.view')
            <a href="#">▤ Reports</a>
        @endcan

        @can('settings.manage')
            <a href="#">⚙ Settings</a>
        @endcan

        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-button">
                ↪ Logout
            </button>
        </form>
    </aside>


    <main class="main">

        <header class="topbar">
            <strong>Admin Panel</strong>
            <span>{{ auth()->user()->name ?? 'Administrator' }}</span>
        </header>

        <section class="content">
            @yield('content')
        </section>

    </main>

</body>
</html>
