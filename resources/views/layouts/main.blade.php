<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Открийте висококачествени газови уреди за отопление, готвене и индустриални нужди. Сигурност и ефективност с нашите сертифицирани продукти.">
    <meta name="keywords" content="газови уреди, газови системи, домакински газови уреди, промишлени газови системи, безопасни газови уреди">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Джеронимо">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Висококачествени Газови Уреди за Бита и Промишлеността | Джеронимо">
    <meta property="og:description" content="Открийте висококачествени газови уреди за отопление, готвене и индустриални нужди. Надеждност и иновация с нашите сертифицирани продукти.">
    <meta property="og:image" content="{{ asset('images/jeronimo-logo-color.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="bg_BG">

    <!-- General Meta Tags -->
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="format-detection" content="telephone=no">
    <meta name="application-name" content="Джеронимо">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="{{ asset('browserconfig.xml') }}">

    <!-- Favicon and Apple Touch Icons -->
    <link rel="icon" type="image/png" href="{{ asset('images/jeronimo-logo-color.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/jeronimo-logo-color.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/jeronimo-logo-color.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('images/jeronimo-logo-color.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/jeronimo-logo-color.png') }}" type="image/png">

    <title>Висококачествени Газови Уреди за Бита и Промишлеността | Джеронимо</title>

    <!-- Vite CSS for Laravel Mix -->
    @vite(['resources/scss/frontend/app.scss'])
</head>
<body class="antialiased">

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

    <!-- Stack for additional scripts -->
    @stack('scripts')

</body>
</html>
