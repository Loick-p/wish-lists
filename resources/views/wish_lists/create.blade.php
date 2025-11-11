@extends('layouts.base')

@section('title', 'Créer une liste')

@section('content')
    <x-breadcrumb :links="[
        'Mes listes' => route('wish_lists.index'),
        'Création d\'une liste' => ''
    ]" />

    <div class="bg-white p-4 rounded-xl shadow xl:w-1/2 mx-auto">
        <h1 class="font-bold text-2xl mb-4 text-center">Créer une liste</h1>

        @include('wish_lists/form', [
            'action' => route('wish_lists.store'),
            'method' => 'POST',
            'wishList' => null,
            'buttonText' => 'Ajouter',
            'cancelRoute' => route('wish_lists.index'),
        ])
    </div>
@endsection
