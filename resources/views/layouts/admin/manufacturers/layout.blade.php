<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manufacturers</title>

        <!-- Vite CSS for Laravel Mix -->
     @vite(['resources/scss/frontend/app.scss'])
</head>
<body>
    <x-admin-navigation/>

    @yield('content')

    <!-- Vite JS for Laravel Mix -->
    @vite(['resources/js/admin/manufacturers/app.js'])


     <!-- Stack for additional scripts -->
     @stack('scripts')

</body>
</html>
