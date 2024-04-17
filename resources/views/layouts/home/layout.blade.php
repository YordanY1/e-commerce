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


    <title>Джеронимо | Газови Уреди</title>

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

      <!-- Cookie Banner -->
    <div class="cookie-banner" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #fff; color: #333; padding: 15px; text-align: center; box-shadow: 0 -2px 5px rgba(0,0,0,0.1);">
        <p>Грижим се за Вашите данни и използваме бисквитки, за да подобрим Вашето изживяване. <a href="{{ url('/terms') }}" style="color: #106EE8; text-decoration: underline;">Прочетете нашата политика за бисквитките.</a></p>
        <button onclick="acceptCookies();" style="background-color: #106EE8; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Приемам</button>
        <button onclick="declineCookies();" style="background-color: #e3342f; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-left: 10px;">Отказвам</button>
    </div>

    <!-- Footer Component -->
    <x-footer />

    <!-- Vite JS for Laravel Mix -->
    @vite(['resources/js/app.js'])

    @stack('scripts')

    <script>
        function acceptCookies() {
            localStorage.setItem('cookieConsent', 'true');
            document.querySelector('.cookie-banner').style.display = 'none';
        }

        function declineCookies() {
            localStorage.setItem('cookieConsent', 'false');
            document.querySelector('.cookie-banner').style.display = 'none';
            alert('Вие отказахте използването на бисквитки. Някои функции на сайта може да не работят коректно.');
        }

        document.addEventListener('DOMContentLoaded', function () {
            var cookieConsent = localStorage.getItem('cookieConsent');
            if (cookieConsent === 'true') {
                document.querySelector('.cookie-banner').style.display = 'none';
            } else if (cookieConsent === 'false') {
            } else {
                document.querySelector('.cookie-banner').style.display = 'block';
            }
        });
        </script>

</body>
</html>
