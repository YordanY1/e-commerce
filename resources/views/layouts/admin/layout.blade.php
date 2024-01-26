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

     <!-- Stack for additional scripts -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

     @stack('scripts')
</body>
</html>
