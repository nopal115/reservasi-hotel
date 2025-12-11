<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BlueHaven Hotel</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* ANIMATED BACKGROUND */
        body {
            background: linear-gradient(135deg, #3b82f6, #ffffff, #a855f7);
            background-size: 400% 400%;
            animation: gradientFlow 10s ease infinite;
        }
        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* GLASS EFFECT */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(14px);
        }

        .neon {
            box-shadow: 0 0 15px rgba(0, 180, 255, 0.55);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">

    <!-- REGISTER CARD -->
    <div class="glass neon w-full max-w-md p-10 rounded-3xl shadow-2xl
                transition-all transform hover:scale-[1.02]">

        <h2 class="text-4xl font-extrabold text-center mb-8 bg-gradient-to-r
                   from-blue-600 to-cyan-400 text-transparent bg-clip-text drop-shadow">
            Register
        </h2>

        {{-- SESSION ERROR --}}
        @if (session('error'))
            <div class="bg-red-300/70 text-red-900 p-3 rounded-lg mb-4 text-sm shadow font-semibold">
                {{ session('error') }}
            </div>
        @endif

        {{-- VALIDATION ERROR --}}
        @if ($errors->any())
            <div class="bg-red-400/60 text-white p-3 rounded-lg mb-4 shadow text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-6" autocomplete="off">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-gray-900 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="name" required
                    value="{{ old('name') }}"
                    class="w-full p-3 rounded-xl bg-white/40 border border-white/60
                           focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                    placeholder="Nama lengkap kamu...">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-900 font-semibold mb-2">Email</label>
                <input type="email" name="email" required
                    value="{{ old('email') }}"
                    class="w-full p-3 rounded-xl bg-white/40 border border-white/60
                           focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                    placeholder="you@example.com">
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-gray-900 font-semibold mb-2">Password</label>
                <div class="relative">

                    <input type="password" name="password" id="password"
                        class="w-full p-3 rounded-xl bg-white/40 border border-white/60
                               focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        placeholder="Masukkan password..." required>

                    <button type="button" onclick="togglePasswordReg()"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-800">

                        <!-- SVG
                        Mata terbuka -->
                        <svg id="eyeReg" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                    </button>
                </div>
            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div>
                <label class="block text-gray-900 font-semibold mb-2">Konfirmasi Password</label>

                <div class="relative">

                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full p-3 rounded-xl bg-white/40 border border-white/60
                               focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        placeholder="Ulangi password..." required>

                    <button type="button" onclick="togglePasswordConfirm()"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-800">

                        <svg id="eyeConfirm" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                    </button>
                </div>
            </div>

            <button type="submit"
                class="w-full py-3 rounded-xl text-white font-bold text-lg
                       bg-gradient-to-r from-blue-600 to-blue-700 shadow-md
                       hover:shadow-xl hover:-translate-y-1 transition-all duration-200">
                Daftar
            </button>
        </form>

        <p class="text-center mt-6 text-gray-900 font-medium">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-purple-700 font-bold hover:underline">
                Login sekarang
            </a>
        </p>
    </div>


    <!-- SCRIPT SHOW/HIDE PASSWORD -->
    <script>
        function togglePasswordReg() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeReg');

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 3l18 18M9.88 9.88a3 3 0 104.24 4.24M6.1 6.1L3 3m15.9 15.9L21 21m-3-3a9 9 0 01-9 0" />
                `;
            } else {
                input.type = "password";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                `;
            }
        }

        function togglePasswordConfirm() {
            const input = document.getElementById('password_confirmation');
            const icon = document.getElementById('eyeConfirm');

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 3l18 18M9.88 9.88a3 3 0 104.24 4.24M6.1 6.1L3 3m15.9 15.9L21 21m-3-3a9 9 0 01-9 0" />
                `;
            } else {
                input.type = "password";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                `;
            }
        }
    </script>

</body>
</html>
