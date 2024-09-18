<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Открийте водещите производители на газови уреди и оборудване, с които работим: Колос ЕООД, MСМ ГАЗ ООД, Orgaz, Nurgaz, Meva Bulgaria Ltd., Vitkovice Milmet, Cavagna Group, Rotarex, Hybrid Supply, Truma, Eurogas.">
    <meta name="keywords" content="газови производители, газови уреди, Колос ЕООД, MСМ ГАЗ ООД, Orgaz, Nurgaz, Meva Bulgaria, Vitkovice Milmet, Cavagna Group, Rotarex, Hybrid Supply, Truma, Eurogas">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Джеронимо">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Водещи производители на газови уреди, с които работим | Джеронимо">
    <meta property="og:description" content="Запознайте се с производителите, с които работим: Колос ЕООД, MСМ ГАЗ ООД, Orgaz, Nurgaz, Meva Bulgaria Ltd., Vitkovice Milmet, Cavagna Group, Rotarex, Hybrid Supply, Truma, Eurogas.">
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

    <title>Водещи производители на газови уреди, с които работим | Джеронимо</title>

    <!-- Vite CSS за Laravel Mix -->
    @vite(['resources/scss/frontend/app.scss'])
</head>
<body>
    <x-navbar />

    <div class="page-content">
        @yield('content')
    </div>

    <x-footer />

    <!-- Vite JS за Laravel Mix -->
    @vite(['resources/js/app.js'])

    @stack('scripts')
</body>
</html>
