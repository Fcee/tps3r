@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row flex-nowrap">
        {{-- Sidebar --}}
        <nav id="sidebar" class="col-12 col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse show">
            <div class="position-sticky pt-3">
               <ul class="nav flex-column text-white p-3">
                {{-- Sidebar untuk semua user --}}
                @if(Auth::user()->role == 'admin')
                    <li class="nav-item border-bottom pb-2 mb-2">
                        <a class="nav-link text-white {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-house-user me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item border-bottom pb-2 mb-2">
                        <a class="nav-link text-white {{ request()->is('stocks*') ? 'active' : '' }}" href="{{ route('stocks.index') }}">
                            <i class="fa-solid fa-box-archive me-2"></i> Stock
                        </a>
                    </li>
                    <li class="nav-item border-bottom pb-2 mb-2">
                        <a class="nav-link text-white {{ request()->is('categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            <i class="fa-solid fa-list me-2"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item border-bottom pb-2 mb-2">
                        <a class="nav-link text-white {{ request()->is('recaps*') ? 'active' : '' }}" href="{{ route('recaps.index') }}">
                            <i class="fa-solid fa-file me-2"></i> Recap
                        </a>
                    </li>
                    <li class="nav-item border-bottom pb-2 mb-2">
                        <a class="nav-link text-white {{ request()->is('kegiatans*') ? 'active' : '' }}" href="{{ route('kegiatans.index') }}">
                            <i class="fa-solid fa-person-running me-2"></i> Kegiatan
                        </a>
                    </li>
                    <li class="nav-item border-bottom pb-2 mb-2">
                        <a class="nav-link text-white {{ request()->is('penjualan*') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">
                            <i class="fa-solid fa-cart-shopping me-2"></i> Penjualan
                        </a>
                    </li>
                    <li class="nav-item border-bottom pb-2 mb-2">
                        <a class="nav-link text-white {{ request()->is('rekappenjualan*') ? 'active' : '' }}" href="{{ route('rekappenjualan.index') }}">
                            <i class="fa-solid fa-download me-2"></i> Rekap Penjualan
                        </a>
                    </li>
                @elseif(Auth::user()->role == 'karyawan')
                    {{-- Sidebar untuk karyawan --}}
                    <li class="nav-item border-bottom pb-2 mb-2">
                        <a class="nav-link text-white {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-house-user me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item border-bottom pb-2 mb-2">
                        <a class="nav-link text-white {{ request()->is('stocks*') ? 'active' : '' }}" href="{{ route('stocks.index') }}">
                            <i class="fa-solid fa-box-archive me-2"></i> Stock
                        </a>
                    </li>
                    <li class="nav-item border-bottom pb-2 mb-2">
                        <a class="nav-link text-white {{ request()->is('kegiatans*') ? 'active' : '' }}" href="{{ route('kegiatans.index') }}">
                            <i class="fa-solid fa-person-running me-2"></i> Kegiatan
                        </a>
                    </li>
                    <li class="nav-item border-bottom pb-2 mb-2">
                        <a class="nav-link text-white {{ request()->is('penjualan*') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">
                            <i class="fa-solid fa-cart-shopping me-2"></i> Penjualan
                        </a>
                    </li>
                @endif
                    @if(Auth::user()->role == 'admin')
                    <li class="nav-item border-bottom pb-2 mb-2">
                        <a class="nav-link text-white {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="fa-solid fa-users me-2"></i> Pengguna
                        </a>
                    </li>
                    @endif
                    <li class="nav-item mt-3">
                        <a class="nav-link text-white" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt me-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        {{-- Main content --}}
        <main class="col-12 col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex align-items-center justify-content-between p-3 rounded mb-4"
                 style="background: linear-gradient(to right, #4CAF50, #81C784); box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo TPS 3R" height="60" class="me-3 rounded-circle">
                    <h1 class="h4 mb-0 text-white">TPS 3R Sido Makmur</h1>
                </div>
                <div class="text-end text-white small">
                    <div>Selamat datang, <strong>{{ Auth::user()->name }}</strong></div>
                    <div class="fst-italic">Login terakhir: {{ Auth::user()->updated_at }}</div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-success mb-3">INFORMASI PENGGUNA</h3>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Role:</strong> {{ Auth::user()->role }}</p>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    #sidebar {
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        overflow-y: auto;
        border-right: 1px solid #444;
        z-index: 1030;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
    }

    .nav-link.active {
        font-weight: bold;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 6px;
    }

    @media (max-width: 768px) {
        #sidebar {
            position: static;
            height: auto;
        }
    }

    body::after {
        content: "";
        background: url('{{ asset('images/leaf-corner1.png') }}') no-repeat bottom right;
        background-size: 80px;
        position: fixed;
        bottom: 10px;
        right: 10px;
        width: 200px;
        height: 200px;
        pointer-events: none;
        opacity: 1;
        z-index: 999;
    }
</style>
@endsection