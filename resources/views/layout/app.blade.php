<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <title>@yield('title', 'TPS 3R Sido Makmur')</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #e8f5e9, #d0f0e8);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 999;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 20px;
            font-weight: bold;
            color: #2e7d32;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-right: 20px;
        }

        .nav a {
            text-decoration: none;
            color: #2e7d32;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .nav a:hover {
            background-color: #c8e6c9;
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            font-size: 26px;
            color: #2e7d32;
            cursor: pointer;
        }

        .footer {
            background-color: #2e7d32;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        .social-icons img {
            width: 30px;
            margin: 0 8px;
        }

        @media (max-width: 768px) {
            .nav {
                display: none;
                flex-direction: column;
                background-color: white;
                position: absolute;
                top: 65px;
                right: 20px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                z-index: 998;
            }

            .nav.show {
                display: flex;
            }

            .hamburger {
                display: block;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="header">
        <a href="{{ route('dashboard') }}" class="logo" style="text-decoration: none;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span class="logo-text">TPS 3R SIDO MAKMUR</span>
        </a>

        <!-- Tombol Hamburger -->
        <button class="hamburger" onclick="toggleMenu()" id="hamburgerBtn">
            <i class="fas fa-bars"></i>
        </button>

        <div class="nav" id="navMenu">
            <a href="{{ route('kegiatan.publik') }}">KEGIATAN</a>
            <a href="{{ route('about') }}">ABOUT US</a>
            <a href="{{ route('galleries.index') }}">PRODUK</a>
            <a href="https://www.google.com/maps/place/TPS+Sidomakmur+Sidoharjo+pacitan/@-8.2072587,111.0797874,17z/data=!4m14..."
                target="_blank">LOKASI</a>

            @guest
                @if (Route::has('login'))
                    <a href="{{ route('login') }}">{{ __('LOGIN') }}</a>
                @endif
            @else
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('LOGOUT') }} ({{ Auth::user()->name }})
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>
    </div>

    <div style="margin-top: 60px;">
        @yield('content')
    </div>

    <div class="footer">
        <p>Kontak Person</p>
        <div class="social-icons">
            <a href="https://wa.me/6282231297245" target="_blank"><img
                    src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp"></a>
            <a href="https://www.instagram.com/tps3r_sidomakmur" target="_blank"><img
                    src="https://cdn-icons-png.flaticon.com/512/733/733558.png" alt="Instagram"></a>
            <a href="mailto:tpsrsidomakmurpacitan@gmail.com"><img
                    src="https://cdn-icons-png.flaticon.com/512/281/281769.png" alt="Gmail"></a>
            <a href="https://www.youtube.com/@TPSSidoMakmur" target="_blank"><img
                    src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" alt="YouTube"></a>
        </div>
        <p class="small">© 2025 TPS 3R Sido Makmur. All rights reserved.</p>
    </div>

    <script>
        function toggleMenu() {
            const nav = document.getElementById('navMenu');
            nav.classList.toggle('show');
        }

        // Menutup menu jika klik di luar
        document.addEventListener('click', function (e) {
            const nav = document.getElementById('navMenu');
            const button = document.getElementById('hamburgerBtn');

            if (!nav.contains(e.target) && !button.contains(e.target)) {
                nav.classList.remove('show');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>

</html>
