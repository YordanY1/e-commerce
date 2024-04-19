<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Научете повече за Джеронимо, вашия надежден доставчик на висококачествени газови уреди. Открийте нашата мисия, ценности и история на иновации.">
    <meta name="keywords" content="за Джеронимо, компания за газови уреди, нашата история, ценности на компанията, мисия на фирмата">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Джеронимо">
    <meta property="og:title" content="За Джеронимо - Вашият надежден доставчик на газови уреди">
    <meta property="og:description" content="Научете за ангажимента на Джеронимо към сигурността и качеството при предоставянето на водещи газови уреди.">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon for all devices -->
    <link rel="icon" href="{{ asset('svg/jeronimo-logo-color.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('svg/jeronimo-logo-color.svg') }}">
    <link rel="shortcut icon" href="{{ asset('svg/jeronimo-logo-color.svg') }}" type="image/svg+xml">

    <title>Джеронимо | За Нас</title>

      <!-- Vite CSS за Laravel Mix -->
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

      @stack('scripts')
</body>
</html>
