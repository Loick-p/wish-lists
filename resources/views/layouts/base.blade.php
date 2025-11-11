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
    <div class="container mx-auto">
        <!-- Navbar -->
        <div class="flex justify-between p-4">
            <!-- Logo -->
            <a href="{{ route('wish_lists.index') }}" class="bg-gray-200 p-2 rounded-full flex items-center">
                <x-lucide-gift class="w-7 h-7 text-red-500"/>
                <h1 class="mx-1 font-bold">WishLists</h1>
            </a>

            @guest
                <a href="{{ route('login') }}" class="bg-red-500 hover:bg-red-700 rounded-full p-3 text-white">
                    Connexion
                </a>
            @endguest

            @auth
                <div class="flex gap-2">
                    <div class="bg-gray-200 p-3 rounded-full ">
                        <x-lucide-bell class="w-6 h-6"/>
                    </div>

                    <div class="hs-dropdown relative inline-flex z-10">
                        <button id="hs-dropdown-with-title" type="button" class="hs-dropdown-toggle bg-gray-200 p-3 rounded-full">
                            <x-lucide-user class="w-6 h-6"/>
                        </button>

                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 divide-y divide-gray-200" role="menu">
                            <div class="py-3 px-4">
                                <p class="font-bold text-gray-800">{{ Auth::user()->name }}</p>
                            </div>

                            <div class="p-1 space-y-0.5">
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                   href="{{ route('profile.edit') }}"
                                >
                                    Mon compte
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                       class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                        Déconnexion
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth
        </div>

        <!-- Content -->
        <div class="p-4">
            @yield('content')
        </div>
    </div>
</body>
</html>
