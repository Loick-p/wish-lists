<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wish Lists - @yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/css/fonts.css')
    @vite('resources/js/app.js')
</head>
<body style="font-family: AlbertSans,sans-serif">
    <!-- Content -->
    <div class="flex flex-col justify-center h-screen p-4 lg:w-1/2 lg:mx-auto">
        @yield('content')
    </div>
</body>
</html>
