<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Authentication')</title>

    <!-- Vite CSS -->
    @vite(['resources/scss/frontend/app.scss'])
</head>
<body>

    <div class="container mt-4">
        @yield('content')
    </div>

    @vite(['resources/js/app.js'])
</body>
</html>
