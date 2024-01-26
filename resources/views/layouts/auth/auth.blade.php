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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

</html>
