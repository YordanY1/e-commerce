<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Плащане')</title>

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
        {{-- @vite(['resources/js/app.js', 'resources/js/checkout/checkout.js']) --}}

        <!-- External JS Libraries -->

        {{-- <script src="https://js.stripe.com/v3/"></script> --}}

        @stack('scripts')
</body>
</html>
