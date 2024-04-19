<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Разгледайте нашия асортимент от висококачествени газови уреди за готвене, отопление и индустриални нужди. Открийте продукти, които съчетават безопасност и ефективност.">
    <meta name="keywords" content="газови уреди, готвене, отопление, индустриални газови устройства, безопасност, ефективност, сертифицирани газови продукти">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Джеронимо">
    <meta property="og:title" content="Разгледайте нашите газови уреди | Джеронимо">
    <meta property="og:description" content="Открийте нашите сертифицирани и ефективни газови уреди за домашна и индустриална употреба.">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon for all devices -->
    <link rel="icon" href="{{ asset('svg/jeronimo-logo-color.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('svg/jeronimo-logo-color.svg') }}">
    <link rel="shortcut icon" href="{{ asset('svg/jeronimo-logo-color.svg') }}" type="image/svg+xml">

    <title>Джеронимо | Продукти</title>

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

