@extends('layouts.auth')

@section('title', 'Mot de passe oublié')

@section('content')
    <div class="mb-8">
        <h1 class="font-extrabold text-4xl mb-2">Mot de passe oublié</h1>
        <p class="text-gray-600">
            Vous avez oublié votre mot de passe ? Indiquez-nous votre adresse mail pour recevoir un lien de réinitialisation du mot de passe.
        </p>
    </div>

    @if(session('status'))
        <span class="mb-2 text-green-600">{{ session('status') }}</span>
    @endif

    <form method="POST" action="{{ route('password.email') }}" id="forgot-password-form" class="mb-4">
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
                       autofocus>
            </div>

            @error('email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" id="forgot-password-button" class="w-full text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5 my-2">
            <span class="indicator-label">
                Envoyer le mail de réinitialisation
            </span>
            <span class="hidden flex justify-center items-center indicator-progress">
                Veuillez patienter... <x-lucide-loader-circle class="w-6 h-6 ms-2 animate-spin" />
            </span>
        </button>
    </form>

    <script>
        const forgotPasswordForm = document.querySelector('#forgot-password-form')
        const forgotPasswordButton = document.querySelector('#forgot-password-button')

        forgotPasswordForm.addEventListener('submit', function(e) {
            e.preventDefault()

            // Bouton anti spam
            activateButtonIndicator(forgotPasswordButton)

            forgotPasswordForm.submit()
        });
    </script>
@endsection
