<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Карта')</title>

    <!-- Vite CSS for Laravel Mix -->
    @vite(['resources/scss/frontend/app.scss'])

<body>
        <!-- Navbar Component -->
        <x-navbar />

        <!-- Main Content Area -->
        <div class="page-content">
            @yield('content')
        </div>

        <!-- Footer Component -->
        <x-footer />

        <!-- Vite JS for Laravel Mix -->
        @vite(['resources/js/app.js', 'resources/js/cart/cartManager.js'])

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        @stack('scripts')
</body>
</html>
