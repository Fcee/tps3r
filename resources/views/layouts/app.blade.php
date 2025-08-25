<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <title>@yield('title', 'TPS 3R Sido Makmur')</title>
    {{-- Bootstrap dan Font --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background-color: #e8f5e9;
        }

        .card {
            border: 2px solid #4CAF50;
            border-radius: 15px;

        }

        .card-header {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        .form-control {
            border: 2px solid #4CAF50;
            border-radius: 10px;

        }

        .btn-primary {
            background-color: #4CAF50;
            border: none;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .invalid-feedback {
            color: #d32f2f;
        }
    </style>
</head>
    @stack('scripts')
<body>
    <div id="app">

        <main class="py-0">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

