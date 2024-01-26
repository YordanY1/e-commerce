<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin Panel</title>

        <!-- Vite CSS for Laravel Mix -->
    @vite(['resources/scss/admin/app.scss'])
</head>
<body>
    <x-admin-navigation/>

    @yield('content')

    <!-- Vite JS for Laravel Mix -->
    @vite(['resources/js/admin/app.js'])

     @stack('scripts')
</body>
</html>
