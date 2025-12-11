<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Blue Haven Hotel' }}</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Custom Style --}}
    <style>
        /* BODY BACKGROUND WITH RGB SHIFT */
        body {
            background: radial-gradient(circle at top, #dff4ff, #cfeaff, #d0e9ff);
            animation: rgbShift 8s infinite alternate ease-in-out;
            min-height: 100vh;
            overflow-x: hidden;
        }

        @keyframes rgbShift {
            0% {
                background: linear-gradient(130deg, #dff4ff, #cfeaff, #d0e9ff);
            }
            50% {
                background: linear-gradient(130deg, #e3f1ff, #d0e7ff, #c9dbff);
            }
            100% {
                background: linear-gradient(130deg, #e8f7ff, #d0e8ff, #d4e7ff);
            }
        }

        /* GLASS EFFECT */
        .glass {
            background: rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        /* RGB NEON BORDER */
        .rgb-border {
            border: 2px solid transparent;
            background:
                linear-gradient(#ffffff00, #ffffff00) padding-box,
                linear-gradient(120deg, #00d0ff, #0077ff, #00ffe5, #009dff) border-box;
        }

        /* SOFT GLOW */
        .neon-glow {
            box-shadow: 0px 0px 25px rgba(0, 180, 255, 0.55);
        }
    </style>
</head>

<body class="font-sans text-gray-900">

    {{-- GEN Z NAVBAR | Floating RGB Glass --}}
    <header class="fixed w-full top-0 z-50 glass rgb-border rounded-b-3xl shadow-2xl">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            {{-- LOGO --}}
            <h1 class="text-3xl font-extrabold tracking-wide bg-gradient-to-r
                        from-blue-500 to-cyan-400 bg-clip-text text-transparent drop-shadow-md">
                BlueHaven<span class="text-blue-300">18+</span>
            </h1>

            {{-- NAVBAR MENU --}}
            <nav class="hidden md:flex space-x-10 text-lg font-semibold">
                <a href="/" class="hover:text-blue-600 transition">Home</a>
                <a href="#fitur" class="hover:text-blue-600 transition">Fitur</a>
                <a href="#cta" class="hover:text-blue-600 transition">Booking</a>
            </nav>

            {{-- BUTTON AREA --}}
            <div class="space-x-4 flex">
                {{-- LOGIN --}}
                <a href="{{ route('login') }}"
                   class="px-6 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-500
                          rounded-2xl shadow-lg hover:scale-105 transition font-bold neon-glow">
                    Login
                </a>

                {{-- REGISTER --}}
                <a href="{{ route('register') }}"
                   class="px-6 py-2 glass rgb-border rounded-2xl shadow-lg hover:scale-105
                          transition font-bold text-blue-700">
                    Daftar
                </a>
            </div>

        </div>
    </header>

    {{-- PAGE CONTENT --}}
    <main class="pt-28">
        @yield('content')
    </main>

</body>

</html>
