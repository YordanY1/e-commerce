<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Открийте висококачествени газови уреди за отопление, готвене и индустриални нужди. Сигурност и ефективност с нашите сертифицирани продукти.">
    <meta name="keywords" content="газови уреди, газови системи, домакински газови уреди, промишлени газови системи, безопасни газови уреди">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Джеронимо">
    <meta property="og:title" content="Висококачествени Газови Уреди | Джеронимо">
    <meta property="og:description" content="Открийте висококачествени газови уреди за отопление, готвене и индустриални нужди. Надеждност и иновация с нашите сертифицирани продукти.">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon for all devices -->
    <link rel="icon" href="{{ asset('svg/jeronimo-logo-color.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('svg/jeronimo-logo-color.svg') }}">
    <link rel="shortcut icon" href="{{ asset('svg/jeronimo-logo-color.svg') }}" type="image/svg+xml">

    <title>Джеронимо | Плащане</title>

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
        @vite(['resources/js/app.js'])

        <!-- External JS Libraries -->

        {{-- <script src="https://js.stripe.com/v3/"></script> --}}

        @stack('scripts')
</body>
</html>
