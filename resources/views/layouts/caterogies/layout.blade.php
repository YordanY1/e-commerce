<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Разгледайте нашия асортимент от висококачествени газови уреди за готвене, отопление и индустриални нужди. Включва битови газови бутилки, туристически уреди, газови котлони, лампи, резервни части и още.">
    <meta name="keywords" content="газови уреди, битови газови бутилки, туристически газови бутилки, газови котлони, пълнители с газ, газови печки, резервни части за газови уреди, пистолети за зареждане на газ, газстанции, газови фурни, мини ел. фурни, лампи и фенери">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Джеронимо">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Газови уреди за готвене, отопление и индустрия | Джеронимо">
    <meta property="og:description" content="Открийте нашите сертифицирани и ефективни газови уреди за домашна и индустриална употреба.">
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

    <title>Газови уреди за готвене, отопление и индустрия | Джеронимо</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Vite CSS за Laravel Mix -->
    @vite(['resources/scss/frontend/app.scss'])
</head>
<body>
    <!-- Компонент за навигационната лента -->
    <x-navbar />

    <!-- Основна област за съдържание -->
    <div class="page-content">
        @yield('content')
    </div>

    <!-- Компонент за футъра -->
    <x-footer />

    <!-- Vite JS за Laravel Mix -->
    @vite(['resources/js/app.js'])

    @stack('scripts')
</body>
</html>
