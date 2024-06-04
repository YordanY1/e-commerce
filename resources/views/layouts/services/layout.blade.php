<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Професионални услуги за ремонтиране и инсталиране на газови печки и уреди. Гаранция за качество и безопасност.">
    <meta name="keywords" content="газта, ремонтиране на газови печки, газови уреди, сервиз и поддръжка, газови инсталации">
    <meta property="og:title" content="Газови Услуги и Ремонти | Джеронимо">
    <meta property="og:description" content="Предлагаме ремонт и инсталация на газови уреди с високо ниво на професионализъм и надеждност.">
    <meta property="og:image" content="{{ asset('images/jeronimo-logo-color.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="bg_BG">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Джеронимо">
    <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- PNG favicon for all browsers -->
   <link rel="icon" type="image/png" href="{{ asset('images/jeronimo-logo-color.png') }}">
   <!-- PNG for Apple touch icon -->
   <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/jeronimo-logo-color.png') }}">
   <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/jeronimo-logo-color.png') }}">
   <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('images/jeronimo-logo-color.png') }}">
   <!-- PNG shortcut icon -->
   <link rel="shortcut icon" href="{{ asset('images/jeronimo-logo-color.png') }}" type="image/png">

   <title>Джеронимо | Услуги</title>

    <!-- Vite CSS for Laravel Mix -->
    @vite(['resources/scss/frontend/app.scss'])

</head>
<body class="antialiased d-flex flex-column">

    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content Area -->
    <div class="page-content flex-grow-1">
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
