@extends('layouts.auth')

@section('title', 'Connexion')

@section('content')
    <h1 class="font-extrabold text-4xl mb-8">Connexion</h1>

    @if(session('status'))
        <span class="mb-2 text-green-600">{{ session('status') }}</span>
    @endif

    <form method="POST" action="{{ route('login') }}" id="login-form" class="mb-4">
        @csrf

        <div class="mb-4">
            <div class="flex items-center mb-2">
                <x-lucide-at-sign class="w-6 h-6 text-gray-400 mr-3" />

                <input class="w-full px-0.5 border-0 border-b {{ $errors->has('email') ? 'border-red-500':'border-gray-400' }} focus:ring-0 focus:outline-none focus:border-red-500"
                       type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Adresse mail"
                       required
                       autofocus
                       autocomplete="username">
            </div>

            @error('email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <div class="flex items-center mb-2">
                <x-lucide-lock-keyhole class="w-6 h-6 text-gray-400 mr-3" />

                <div class="relative w-full">
                    <input class="w-full px-0.5 border-0 border-b {{ $errors->has('password') ? 'border-red-500':'border-gray-400' }} focus:ring-0 focus:outline-none focus:border-red-500"
                           type="password"
                           id="password"
                           name="password"
                           value="{{ old('password') }}"
                           placeholder="Mot de passe"
                           required
                           autocomplete="current-password"
                    >
                    <button type="button"
                            data-hs-toggle-password='{
                                "target": "#password"
                            }'
                            class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-red-600"
                    >
                        <x-lucide-eye-off class="w-4 h-4 hs-password-active:hidden" />
                        <x-lucide-eye class="w-4 h-4 hidden hs-password-active:block" />
                    </button>
                </div>
            </div>

            @error('password')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-6 mb-4 mx-1">
            <div class="flex items-center justify-between">
                <div class="">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Se souvenir de moi</span>
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a class="text-sm text-red-500 hover:text-red-700 rounded-md" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
        </div>

        <button type="submit" id="login-button" class="w-full text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5 my-2">
            <span class="indicator-label">
              Se connecter
            </span>
            <span class="hidden flex justify-center items-center indicator-progress">
                Veuillez patienter... <x-lucide-loader-circle class="w-6 h-6 ms-2 animate-spin" />
            </span>
        </button>
    </form>

    <div class="flex items-center mb-4">
        <div class="flex-grow border-b border-gray-200"></div>
        <span class="mx-4 text-gray-400">OU</span>
        <div class="flex-grow border-b border-gray-200"></div>
    </div>

    <p class="text-gray-500">
        Vous n'avez pas de compte ?
        <a href="{{ route('register') }}" class="text-red-500 hover:text-red-700">Créer un compte</a>
    </p>

    <script>
        const loginForm = document.querySelector('#login-form')
        const loginButton = document.querySelector('#login-button')

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault()

            // Bouton anti spam
            activateButtonIndicator(loginButton)

            loginForm.submit()
        });
    </script>
@endsection
