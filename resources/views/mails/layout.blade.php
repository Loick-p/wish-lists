<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        {{ file_get_contents(public_path('css/mails.css')) }}
    </style>
</head>
<body style="font-family: AlbertSans,sans-serif" class="bg-gray-100">
    <div class="container mx-auto lg:w-1/2 p-4">
        <a href="{{ route('wish_lists.index') }}" class="flex justify-center items-center my-4">
            <x-lucide-gift class="w-7 h-7 text-red-500"/>
            <h1 class="mx-1 font-bold text-2xl">WishLists</h1>
        </a>

        <div class="bg-white p-6 rounded">
            @yield('content')
        </div>

        <div class="text-center text-sm text-gray-400 font-medium my-4">
            &copy; {{ date('Y') }} WishLists. Tous droits réservés.
        </div>
    </div>
</body>
</html>
