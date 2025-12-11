<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Reservasi Hotel' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
        }
        .sidebar-link:hover {
            background: rgba(59,130,246,0.15);
            transform: translateX(6px);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-purple-100 min-h-screen flex">

@if(Auth::check())
<aside class="w-64 glass shadow-xl h-screen p-6 fixed left-0 top-0 border-r border-white/20">

    <div class="flex items-center gap-3 mb-8">
        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold">
            HR
        </div>
        <h1 class="text-xl font-extrabold text-blue-700 tracking-wide">
            Reservasi Hotel
        </h1>
    </div>

    <nav class="space-y-2">

        {{-- ADMIN MENU --}}
        @if(Auth::user()->role === 'admin')

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link block p-3 rounded-xl font-medium text-gray-700">
                📊 Dashboard
            </a>

            <a href="{{ route('admin.kamar.index') }}"
               class="sidebar-link block p-3 rounded-xl font-medium text-gray-700">
                🏨 Kelola Kamar
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="sidebar-link block p-3 rounded-xl font-medium text-gray-700">
                📑 Data Pemesanan
            </a>

            <a href="{{ route('admin.payment.index') }}"
               class="sidebar-link block p-3 rounded-xl font-medium text-gray-700">
                💳 Verifikasi Pembayaran
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="sidebar-link block p-3 rounded-xl font-medium text-gray-700">
                👤 Kelola Admin
            </a>

        @endif


        {{-- TAMU MENU --}}
        @if(Auth::user()->role === 'tamu')

            <a href="{{ route('tamu.dashboard') }}"
               class="sidebar-link block p-3 rounded-xl font-medium text-gray-700">
                🏠 Dashboard
            </a>

            <a href="{{ route('tamu.kamar.list') }}"
               class="sidebar-link block p-3 rounded-xl font-medium text-gray-700">
                🛏️ Pilih Kamar
            </a>

            <a href="{{ route('tamu.orders.history') }}"
               class="sidebar-link block p-3 rounded-xl font-medium text-gray-700">
                📜 Riwayat Pesanan
            </a>

        @endif


        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full mt-5 p-3 bg-red-500 text-white rounded-xl shadow hover:bg-red-600 transition">
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
