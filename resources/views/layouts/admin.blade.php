<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'BlueHaven Admin' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: linear-gradient(135deg, #c7e1ff, #eef6ff, #e7d9ff);
            background-size: 400% 400%;
            animation: gradientMove 12s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .sidebar-link:hover {
            background: rgba(59,130,246,0.18);
            transform: translateX(6px);
        }

        .active-link {
            background: rgba(59,130,246,0.25);
            font-weight: 700;
            color: #1e3a8a !important;
        }
    </style>
</head>

<body class="min-h-screen flex">

@if(Auth::check())
<aside class="w-64 glass fixed left-0 top-0 h-screen p-6 shadow-xl border-r border-white/30">

    <div class="flex items-center gap-3 mb-10">
        <div class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center text-white text-xl font-bold">
            AD
        </div>
        <h1 class="text-xl font-extrabold text-blue-700 tracking-wide">
            Admin Panel
        </h1>
    </div>

    <nav class="space-y-2">

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link block p-3 rounded-xl font-medium transition-all
           {{ request()->routeIs('admin.dashboard') ? 'active-link' : 'text-gray-800' }}">
            📊 Dashboard
        </a>

        <!-- Verifikasi Pembayaran -->
        <a href="{{ route('admin.payment.index') }}"
           class="sidebar-link block p-3 rounded-xl font-medium transition-all
           {{ request()->routeIs('admin.payment.*') ? 'active-link' : 'text-gray-800' }}">
            💳 Verifikasi Pembayaran
        </a>

        <!-- Kelola Admin -->
        <a href="{{ route('admin.users.index') }}"
           class="sidebar-link block p-3 rounded-xl font-medium transition-all
           {{ request()->routeIs('admin.users.*') ? 'active-link' : 'text-gray-800' }}">
            👤 Kelola Admin
        </a>

        <!-- Kelola Kamar -->
        <a href="{{ route('admin.kamar.index') }}"
           class="sidebar-link block p-3 rounded-xl font-medium transition-all
           {{ request()->routeIs('admin.kamar.*') ? 'active-link' : 'text-gray-800' }}">
            🏨 Kelola Kamar
        </a>

        <!-- Data Pemesanan -->
        <a href="{{ route('admin.orders.index') }}"
           class="sidebar-link block p-3 rounded-xl font-medium transition-all
           {{ request()->routeIs('admin.orders.*') ? 'active-link' : 'text-gray-800' }}">
            📑 Data Pemesanan
        </a>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST" class="pt-6">
            @csrf
            <button class="w-full bg-red-500 text-white py-3 rounded-xl shadow hover:bg-red-600 transition-all">
                Logout
            </button>
        </form>

    </nav>
</aside>
@endif


<main class="flex-1 ml-64 p-10">
    @yield('content')
</main>

</body>
</html>
