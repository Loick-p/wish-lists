@extends('layouts.auth')

@section('title', 'Inscription')

@section('content')
    <h1 class="font-extrabold text-4xl mb-8">Inscription</h1>

    <form method="POST" action="{{ route('register') }}" id="register-form" class="mb-4">
        @csrf

        <div class="mb-4">
            <div class="flex items-center mb-2">
                <x-lucide-circle-user-round class="w-6 h-6 text-gray-400 mr-3" />

                <input class="w-full px-0.5 border-0 border-b {{ $errors->has('name') ? 'border-red-500':'border-gray-400' }} focus:ring-0 focus:outline-none focus:border-red-500"
                       type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Pseudo"
                       required
                       autofocus
                       autocomplete="name">
            </div>

            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

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
                           placeholder="Mot de passe"
                           required
                           autocomplete="new-password"
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

        <div class="mb-4">
            <div class="flex items-center mb-2">
                <x-lucide-lock-keyhole class="w-6 h-6 text-gray-400 mr-3" />

                <div class="relative w-full">
                    <input class="w-full px-0.5 border-0 border-b {{ $errors->has('password') ? 'border-red-500':'border-gray-400' }} focus:ring-0 focus:outline-none focus:border-red-500"
                           type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           placeholder="Confirmer votre mot de passe"
                           required
                           autocomplete="new-password"
                    >
                    <button type="button"
                            data-hs-toggle-password='{
                                "target": "#password_confirmation"
                            }'
                            class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-red-600"
                    >
                        <x-lucide-eye-off class="w-4 h-4 hs-password-active:hidden" />
                        <x-lucide-eye class="w-4 h-4 hidden hs-password-active:block" />
                    </button>
                </div>
            </div>

            @error('password_confirmation')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" id="register-button" class="w-full text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5 my-2">
            <span class="indicator-label">
                S'inscrire
            </span>
            <span class="hidden flex justify-center items-center indicator-progress">
                Veuillez patienter... <x-lucide-loader-circle class="w-6 h-6 ms-2 animate-spin" />
            </span>
        </button>
    </form>

    <p class="text-gray-500">
        Vous avez déjà un compte ?
        <a href="{{ route('login') }}" class="text-red-500 hover:text-red-700">Connectez-vous !</a>
    </p>

    <script>
        const registerForm = document.querySelector('#register-form')
        const registerButton = document.querySelector('#register-button')

        registerForm.addEventListener('submit', function(e) {
            e.preventDefault()

            // Bouton anti spam
            activateButtonIndicator(registerButton)

            registerForm.submit()
        });
    </script>
@endsection
