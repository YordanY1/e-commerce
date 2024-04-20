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

    <!-- PNG favicon for all browsers -->
    <link rel="icon" type="image/png" href="{{ asset('images/jeronimo-logo-color.png') }}">
    <!-- PNG for Apple touch icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/jeronimo-logo-color.png') }}">
    <!-- PNG shortcut icon -->
    <link rel="shortcut icon" href="{{ asset('images/jeronimo-logo-color.png') }}" type="image/png">

    <title>Джеронимо - Газови Уреди</title>

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
