@extends('mails.layout')

@section('content')
    <h1 class="font-bold mb-2">Bonjour {{ $user->name }},</h1>
    <p>
        Vous avez été ajouté à la liste <span class="font-semibold">{{ $wishList->title }}</span>, cliquez sur le bouton ci-dessous pour y accéder !
    </p>

    <div class="py-6 text-center">
        <a href="{{ $url }}" target="_blank" class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5">
            Accéder à la liste
        </a>
    </div>

    <p class="text-sm mb-4">
        Vous pourrez ajouter des cadeaux à votre liste, voir ceux des autres !
    </p>

    <hr class="mb-4">

    <p class="text-gray-600">
        Si vous n'arrivez pas à cliquer sur le bouton « Accéder à la liste », copiez et collez l'URL ci-dessous dans votre navigateur web :
        <a href="{{ $url }}" target="_blank" class="text-red-500 break-words">
            {{ $url }}
        </a>
    </p>
@endsection
