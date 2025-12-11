@extends('layouts.welcome')

@section('content')

<style>
    /* Animated Gradient Background */
    body {
        background: linear-gradient(135deg, #3b82f6, #ffffff, #a855f7);
        background-size: 400% 400%;
        animation: gradientFlow 12s ease infinite;
    }

    @keyframes gradientFlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Hero Fade Slide Animation */
    .fade-slide {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeSlideIn 1.2s ease-out forwards;
    }

    @keyframes fadeSlideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Floating Soft Blob Animation */
    .float-blob {
        animation: floatBlob 10s infinite ease-in-out alternate;
    }

    @keyframes floatBlob {
        0% { transform: translateY(0px) translateX(0px); }
        50% { transform: translateY(-25px) translateX(15px); }
        100% { transform: translateY(20px) translateX(-15px); }
    }

    /* Fade-up for feature cards */
    .fade-up {
        opacity: 0;
        transform: translateY(25px);
        animation: fadeUp 1s ease-out forwards;
    }

    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


{{-- HERO SECTION --}}
<div class="relative w-full h-[90vh] flex items-center justify-center overflow-hidden">

    {{-- Background --}}
    <div class="absolute inset-0 bg-cover bg-center brightness-[0.55]"
         style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format');">
    </div>

    {{-- RGB Blue Glass Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-br from-blue-700/30 via-cyan-500/20 to-blue-800/30 backdrop-blur-[3px]"></div>

    {{-- Floating Glows --}}
    <div class="absolute w-80 h-80 bg-blue-400/30 rounded-full blur-[120px] -top-10 -left-10 float-blob"></div>
    <div class="absolute w-[500px] h-[500px] bg-cyan-300/25 rounded-full blur-[140px] bottom-0 right-10 float-blob"></div>
    <div class="absolute w-72 h-72 bg-blue-500/20 rounded-full blur-[100px] top-32 right-1/3 float-blob"></div>

    {{-- CONTENT --}}
    <div class="relative z-10 text-center text-white px-6 drop-shadow-2xl fade-slide">

        <h1 class="text-6xl md:text-7xl font-black tracking-wide leading-tight bg-gradient-to-r
                   from-blue-300 to-cyan-200 bg-clip-text text-transparent">
            Blue Haven Hotel
            <br>
            <span class="text-white drop-shadow-xl">Modern • Premium • Futuristic</span>
        </h1>

        <p class="mt-6 text-xl md:text-2xl font-light max-w-3xl mx-auto text-blue-100 leading-relaxed fade-slide"
           style="animation-delay:0.3s;">
            Rasakan pengalaman menginap modern dengan kenyamanan maksimal,
            suasana tenang, serta desain blue-glass futuristik yang menjadi ciri khas Blue Haven Hotel.
        </p>

        <a href="{{ route('login') }}"
           class="mt-10 inline-block px-12 py-4 neon-glow glass rgb-border
                  rounded-2xl text-xl font-bold shadow-xl hover:scale-110 transition bg-blue-700/60 text-white backdrop-blur-xl fade-slide"
           style="animation-delay:0.6s;">
            Mulai Booking Sekarang
        </a>
    </div>
</div>




{{-- FITUR SECTION --}}
<div id="fitur" class="max-w-7xl mx-auto px-6 py-24 fade-slide" style="animation-delay:1s;">

    <h2 class="text-4xl font-extrabold text-blue-900 text-center mb-20 drop-shadow-sm">
        Keunggulan Blue Haven Hotel
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

        {{-- CARD 1 --}}
        <div class="p-10 glass rgb-border rounded-3xl shadow-xl hover:scale-[1.05]
                    transition-all duration-300 fade-up" style="animation-delay:1.2s;">
            <h3 class="text-2xl font-bold text-blue-900">Kenyamanan Premium</h3>
            <p class="mt-4 text-gray-700">
                Lingkungan hotel yang tenang, elegan, dan dirancang untuk memberikan pengalaman menginap terbaik.
            </p>
        </div>

        {{-- CARD 2 --}}
        <div class="p-10 glass rgb-border rounded-3xl shadow-xl hover:scale-[1.05]
                    transition-all duration-300 fade-up" style="animation-delay:1.4s;">
            <h3 class="text-2xl font-bold text-blue-900">Keamanan Tinggi</h3>
            <p class="mt-4 text-gray-700">
                Smart-lock system, CCTV 24/7, dan layanan responsif untuk memastikan kenyamanan Anda.
            </p>
        </div>

        {{-- CARD 3 --}}
        <div class="p-10 glass rgb-border rounded-3xl shadow-xl hover:scale-[1.05]
                    transition-all duration-300 fade-up" style="animation-delay:1.6s;">
            <h3 class="text-2xl font-bold text-blue-900">Desain Blue Glass</h3>
            <p class="mt-4 text-gray-700">
                Interior futuristik ala hotel modern, menghadirkan estetika biru yang elegan dan menenangkan.
            </p>
        </div>

    </div>
</div>



{{-- CTA --}}
<div id="cta"
     class="w-full py-20 bg-gradient-to-r from-blue-700 to-blue-900 text-white text-center rounded-t-3xl fade-slide"
     style="animation-delay:1.8s;">

    <h2 class="text-4xl font-extrabold drop-shadow-lg">
        Siap Rasakan Pengalaman Menginap Premium?
    </h2>

    <p class="mt-4 text-xl text-blue-100">
        Booking mudah, cepat, dan aman dalam satu platform.
    </p>

    <a href="{{ route('register') }}"
        class="mt-8 inline-block px-14 py-4 bg-white text-blue-800 font-bold text-xl rounded-3xl
               shadow-xl hover:scale-110 transition neon-glow fade-slide"
        style="animation-delay:2s;">
        Daftar Sekarang
    </a>
</div>



{{-- FOOTER --}}
<footer class="mt-20 glass bg-white/10 backdrop-blur-xl border-t border-white/20">

    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-10 text-gray-800">

        {{-- Brand --}}
        <div>
            <h2 class="text-2xl font-extrabold bg-gradient-to-r from-blue-500 to-cyan-400 bg-clip-text text-transparent">
                Blue Haven Hotel
            </h2>
            <p class="mt-3 text-gray-700 leading-relaxed">
                Hotel modern dengan pengalaman menginap premium, keamanan canggih, dan desain futuristik.
            </p>
        </div>

        {{-- Quick Links --}}
        <div>
            <h3 class="text-xl font-bold text-blue-800 mb-3">Navigasi</h3>
            <ul class="space-y-2 font-medium">
                <li><a href="/" class="hover:text-blue-600 transition">🏠 Home</a></li>
                <li><a href="#fitur" class="hover:text-blue-600 transition">✨ Fitur</a></li>
                <li><a href="#cta" class="hover:text-blue-600 transition">🔔 Booking</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-blue-600 transition">🔐 Login</a></li>
            </ul>
        </div>

        {{-- Social Media --}}
        <div>
            <h3 class="text-xl font-bold text-blue-800 mb-3">Ikuti Kami</h3>

            <div class="flex gap-4 text-2xl text-blue-700">
                <a href="#" class="hover:scale-125 transition-all">🌐</a>
                <a href="#" class="hover:scale-125 transition-all">📘</a>
                <a href="#" class="hover:scale-125 transition-all">📸</a>
                <a href="#" class="hover:scale-125 transition-all">▶️</a>
            </div>
        </div>

    </div>

    <div class="text-center py-4 text-gray-700 text-sm border-t border-white/20">
        © {{ date('Y') }} Blue Haven Hotel — All Rights Reserved.
    </div>

</footer>

@endsection
