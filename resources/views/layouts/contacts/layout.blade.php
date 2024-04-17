<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Свържете се с нас за информация относно нашите газови уреди и услуги. Нашият екип е на разположение да отговори на всички ваши въпроси.">
    <meta name="keywords" content="контакт, адрес, телефон, обслужване на клиенти, помощ">
    <meta name="author" content="Джеронимо">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Контакти | Джеронимо">
    <meta property="og:description" content="Свържете се с нас за подробности относно нашите продукти и услуги.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon for all devices -->
    <link rel="icon" href="{{ asset('svg/jeronimo-logo-color.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('svg/jeronimo-logo-color.svg') }}">
    <link rel="shortcut icon" href="{{ asset('svg/jeronimo-logo-color.svg') }}" type="image/svg+xml">

    <title>Джеронимо | Контакти</title>

    <!-- Vite CSS for Laravel Mix -->
    @vite(['resources/scss/frontend/app.scss'])
</head>
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
    @vite(['resources/js/app.js', 'resources/js/main.js'])

    <!-- Stack for additional scripts -->
    @stack('scripts')
</body>
</html>
