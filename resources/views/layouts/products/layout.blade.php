<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Разгледайте нашия асортимент от висококачествени газови уреди за готвене, отопление и индустриални нужди. Открийте продукти, които съчетават безопасност и ефективност. Предлагаме газови бутилки за бита, композитни газови бутилки, туристически газови бутилки, бутилкови инсталации, газови проточни бойлери, кемпери и каравани, нивомери за газови бутилки, кранове на газ, професионални газови уреди, газови котлони за вграждане, единични газови котлони, двойни газови котлони, тройни газови котлони, туристически газови котлони и принадлежности, котлони-саджаци високи налягане, пълнители, флакони с газ, газови горелки, редуцир калорифери, газови печки, резервни части за битови газови уреди, лампи и фенери, аксесоари за газопълначни станции и бензсионстации, пистолети и глави за зареждане на газ, резервни части за газстанции, части за газови уредби втора употреба, малки готварски печки, мини ел. фурни от производители като Колос, Велико Търново, Vitkovice, Meva.">
    <meta name="keywords" content="газови уреди, готвене, отопление, индустриални газови устройства, безопасност, ефективност, сертифицирани газови продукти, газови бутилки за бита, композитни газови бутилки, туристически газови бутилки, бутилкови инсталации, газови проточни бойлери, кемпери и каравани, нивомери за газови бутилки, кранове на газ, професионални газови уреди, газови котлони за вграждане, единични газови котлони, двойни газови котлони, тройни газови котлони, туристически газови котлони и принадлежности, котлони-саджаци високи налягане, пълнители, флакони с газ, газови горелки, редуцир калорифери, газови печки, резервни части за битови газови уреди, лампи и фенери, аксесоари за газопълначни станции и бензсионстации, пистолети и глави за зареждане на газ, резервни части за газстанции, части за газови уредби втора употреба, малки готварски печки, мини ел. фурни, Колос, Велико Търново, Vitkovice, Meva">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Джеронимо">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Разгледайте нашите газови уреди | Джеронимо">
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

    <title>Разгледайте нашите газови уреди | Джеронимо</title>

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
