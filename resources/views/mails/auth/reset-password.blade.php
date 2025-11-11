@extends('mails.layout')

@section('content')
    <h1 class="font-bold mb-2">Bonjour,</h1>
    <p>
        Vous recevez cet e-mail parce que nous avons reçu une demande de réinitialisation du mot de passe de votre compte.
    </p>

    <div class="py-6 text-center">
        <a href="{{ $url }}" target="_blank" class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5">
            Réinitialiser le mot de passe
        </a>
    </div>

    <p class="mb-1">
        Ce lien de réinitialisation du mot de passe expirera dans 60 minutes.
    </p>
    <p class="mb-4">
        Si vous n'avez pas demandé la réinitialisation de votre mot de passe, aucune autre action n'est requise.
    </p>

    <hr class="mb-4">

    <p class="text-gray-600">
        Si vous n'arrivez pas à cliquer sur le bouton « Réinitialiser le mot de passe », copiez et collez l'URL ci-dessous dans votre navigateur web :
        <a href="{{ $url }}" target="_blank" class="text-red-500 break-words">
            {{ $url }}
        </a>
    </p>
@endsection
